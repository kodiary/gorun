<?php

class ContentsController extends Controller
{
    public $metaDesc;
        public $metaKeys;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	 public $layout='admin';
     
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			)
		);
	}

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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $model=new Contents;
        $model->status = 1;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Contents']))
		{
            $model->attributes=$_POST['Contents'];

            $slug=CommonClass::getSlug($model->title);
            if($model->parent!="")
            {
                $display_order=$model->getMaxDisplayOrder($model->parent);
                $model->display_order=$display_order+1;
            }
            
            $meta_title=$model->meta_title;
            if($meta_title=="")
            {
                $meta_title=$model->title; 
            }
            $meta_desc=$model->meta_desc;
            if($meta_desc=="")
            {
                $meta_desc=substr(strip_tags($model->desc),0,160);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_desc = preg_replace($pattern, '', (string) $meta_desc);
                $meta_desc= str_replace("\t",'',$meta_desc);
            }
            
            /*$page_seo=$model->page_seo;
            if($page_seo=="")
            {
                $page_seo=$meta_title." , ". $meta_desc;
            }*/
            
            $model->meta_title=$meta_title;
            $model->meta_desc=$meta_desc;
            $model->page_seo=$slug;
            $model->meta_keywords=$_POST['Contents']['meta_keywords'];
            //$model->page_seo=$page_seo;
            
			if($model->save())
                $this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $arr=explode('_',$id);
		$model=$this->loadModel($arr[0]);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Contents']))
		{
			$model->attributes=$_POST['Contents'];
            if($model->id==5)
			{
				$model->google_map = $_POST['Contents']['google_map'];
				$model->display_map = $_POST['Contents']['display_map'];
				$model->display_form = $_POST['Contents']['display_form'];
			}
            
            $slug=CommonClass::getSlug($model->title);
            
            $model->page_seo=$slug;
            
            $meta_desc=$_POST['Contents']['meta_desc'];
            if($meta_desc=="")
            {
                $meta_desc=substr(strip_tags($model->desc),0,160);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_desc = preg_replace($pattern, '', (string) $meta_desc);
                $meta_desc= str_replace("\t",'',$meta_desc);
            }
            else{        
                $meta_desc=$_POST['Contents']['meta_desc'];
            }
            $model->meta_desc=$meta_desc;
            $model->meta_keywords=$_POST['Contents']['meta_keywords'];
            
            $meta_title = $_POST['Contents']['meta_title'];
            if($meta_title=="")
            {
                $meta_title=substr(strip_tags($model->title),0,60);
                $whiteSpace = '\s'; //if you dnt even want to allow white-space set it to ''
                $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
                $meta_title = preg_replace($pattern, '', (string) $meta_title);
                $meta_title= str_replace("\t",'',$meta_title);
            }
            else{        
                $model->meta_title = $_POST['Contents']['meta_title'];
            }
            //$model->meta_title = $_POST['Contents']['meta_title'];            

			if($model->save()){
                if($arr[1])
                    $this->redirect('../../manage/id/'.$arr[1]);
                else
                    $this->redirect('../../manage/id/'.$arr[0]);
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if($id){
            $arr=explode('_',$id);
            
            if($arr[0]){
                $model=Contents::model()->findAll(array(
                    'condition'=>'parent=:parentID',
                    'params'=>array(':parentID'=>$arr[0]),
                    ));
                foreach($model as $delContents){
                    $del_child = $delContents->id;
                    $this->loadModel($del_child)->delete();
                }
            }
            $this->loadModel($arr[0])->delete();
            if($arr[1]){
                $this->redirect('../../manage/id/'.$arr[1]);
            }                
            else
                $this->redirect('../../index');
        }
        //$this->redirect(array('index'));
	}
    
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=Contents::model()->findAll(array('condition'=>'parent=0','order'=>'display_order'));
        $this->render('index',array(
			'model'=>$model,
		));        
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contents']))
			$model->attributes=$_GET['Contents'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Contents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionSort()
    {
        if (isset($_GET['list'])) {
            $items=$_GET['list'];
            $items=explode(',',$items);
            if(is_array($items))
            {
              $i = 1;
              foreach ($items as $item) {
                    $model=$this->loadModel($item);
                    $model->display_order = $i;
                    $model->save();
                    $i++;
              }
           	echo '<div id="successmsg">Successfully saved.</div>';
           	//make the success message disappear slowly
           	echo '<script type="text/javascript">$(document).ready(function(){ $("#successmsg").fadeOut(2000); });</script>';  
            }
        }
    }
    
    public function actionManage($id='')
    {
		if($id)
			$model=Contents::model()->findAll(array('condition'=>'id='.$id,'order'=>'display_order'));
		else
            $model=Contents::model()->findAll(array('condition'=>'parent=0','order'=>'display_order')); 
       	
        $this->render('manage',array(
			'model'=>$model,
		));
    }
}
