<?php
class JobsController extends Controller
{
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $seo=CommonClass::getSeoByPage('jobs');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle=$seo['title'];
        
        if($seo['title'] ==''){
            $seo=CommonClass::getSeoByPage('generic');
            $this->metaDesc=$seo['desc'];
            $this->metaKeys=$seo['keys'];
            $this->pageTitle="Jobs - ".$seo['title'];            
        }
        
        $criteria = new CDbCriteria;

        $criteria->with = array('jobs');
        
        if(isset($_GET['keyword']))
        {
            $keyword = $_GET['keyword'];
            $criteria->addSearchCondition('t.title', $keyword, true, 'OR');
            $criteria->addSearchCondition('t.desc', $keyword, true, 'OR');
        }
        
        $criteria->addCondition('visible=1');
        $criteria->order = 't.date_updated DESC,t.id DESC';
            
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['jobs_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['jobs_pers_page'])));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}
    
    public function actionProvince($slug)
    {
        $seo=CommonClass::getSeoByPage('jobs');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle=$seo['title'];
        if($slug!="")
        {
            $prov=Province::model()->find("slug='$slug'");
            $criteria = new CDbCriteria;
            
            $criteria->with = array('jobs');
            $criteria->addCondition("jobs.province=".$prov->id);
            $criteria->addCondition('visible=1');
            $criteria->order = 't.date_updated DESC,t.id DESC';
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['jobs_pers_page'])));
            
            $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'province'=>$prov->name,
            'pages'=>$pages,
            ));
        }
        else
        {
           $this->redirect($this->createUrl('/jobs')); 
        }
    }
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    protected function performAjaxValidation($model,$form_id)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']===$form_id)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}