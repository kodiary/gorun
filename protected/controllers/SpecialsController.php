<?php

class SpecialsController extends Controller
{
	/**
	 * @return array action filters
	 */
 	public $layout='//layouts/column2';
     public $metaKeys;
     public $metaDesc;
     public $pageImage;

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $seo=CommonClass::getSeoByPage('generic');
       $pageseo=CommonClass::getSeoByPage('specials');
       if(!empty($pageseo['title'])){
           $this->pageTitle=$pageseo['title'];        
           $this->metaDesc=$pageseo['desc'];
           $this->metaKeys=$pageseo['keys'];
       }else{
           $this->pageTitle="Specials - ".$seo['title'];        
           $this->metaDesc=$seo['desc'];
           $this->metaKeys=$seo['keys'];
       }
       if(isset($_GET['page']))
       {
            $this->pageTitle="Page ".$_GET['page'].": ".$this->pageTitle;    
            $this->metaDesc="Page ".$_GET['page']." of ".$this->metaDesc;
            $this->metaKeys="Page ".$_GET['page'].', '.$this->metaKeys;
       }
       $criteria = new CDbCriteria;
       $product=$_GET['product'];
       $service=$_GET['service'];
	   if($product)
       {
            $prodId=Products::get_id_by_slug($product);
            $criteria->addInCondition('t.id', CompanySpecials::getSpecialsByProduct($prodId));
       }
       if($service)
       {
           $serviceId=Services::get_id_by_slug($service); 
           $criteria->addInCondition('t.id', CompanySpecials::getSpecialsByService($serviceId));
       }     
       
       $order=$_GET['order'];
       if($order=='')$criteria->order = 't.id DESC';
       if($order=='date')$criteria->order = 't.expiry_date ASC';
       $criteria->join = 'LEFT JOIN tbl_company c on t.company_id=c.id';
       $criteria->addCondition('t.status=1 AND t.expiry_date>=CURDATE()');
       $criteria->addCondition('c.status=1 AND rigger!=1 AND (c.valid_until >= curdate() OR c.never_expire=1)');
       
       $dataProvider= new CActiveDataProvider('Specials', array('criteria'=>$criteria,'pagination' => array('pageSize' =>5)));
	   $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
        
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Specials::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionShowall()
    {
        $criteria = new CDbCriteria;
        $criteria->join = 'LEFT JOIN tbl_company c on t.company_id=c.id';
        $criteria->addCondition('t.status=1 AND t.expiry_date>=CURDATE()');
        $criteria->addCondition('c.status=1 AND rigger!=1 AND (c.valid_until >= curdate() OR c.never_expire=1)');
        $criteria->order = 't.id DESC';
      
	   $dataProvider=new CActiveDataProvider('Specials', array('criteria'=>$criteria, 'pagination'=>false));
       $pages = new CPagination($dataProvider->totalItemCount);
       $pages->pageSize = Yii::app()->params['items_pers_page'];
       $pages->applyLimit($criteria);
	   $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages' => $pages,
	   ));
    }
    
    public function actionSearch()
    {
        $search = $_GET['keyword'];
        $criteria = new CDbCriteria;   
        if($search)
        {
            if($product=$_GET['product'])
            {
                $prodId=Products::get_id_by_slug($product);
                //$criteria->addInCondition('resId', Specials::specials_by_region($regId), "AND");
            }
            $criteria->addSearchCondition('t.title', $search, true, 'OR');
            $criteria->addSearchCondition('t.detail', $search, true, 'OR');
        }
        //$curdate = date('Y-m-d');
        $criteria->join = 'LEFT JOIN tbl_company c on t.company_id=c.id';
        $criteria->addCondition('t.status=1 AND t.expiry_date>=CURDATE()');
        $criteria->addCondition('c.status=1 AND rigger!=1 AND (c.valid_until >= curdate() OR c.never_expire=1)');
        $dataProvider = new CActiveDataProvider('Specials', array('criteria'=>$criteria));
        $search_count = Specials::model()->count($criteria); 
        //print_r($dataProvider->getData());die();
        $this->render('search', array('dataProvider'=>$dataProvider, 'search_count'=>$search_count));
    }
    
}
