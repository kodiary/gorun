<?php

class VideosController extends Controller
{
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
			array('allow', // allow authenticated user to perform following actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $id=$_GET['id'];
       $cmodel=Company::model()->findByPk($id);
       $model = new Videos;
	   if(isset($_POST['Videos']))
       {   
            if($_POST['id']!="")
            {
               $model = Videos::model()->findByPk($_POST['id']);
               $model->attributes= $_POST['Videos']; 
               $model->save();  
            }
            else
            {
                $model->attributes= $_POST['Videos'];
                $model->company_id=$id;
                $model->display_order=Videos::get_max_order($id)+1;
                $model->save();  
            }             
            Yii::app()->user->setFlash('success', '<strong>Success - </strong> Successfully saved.'); 
       }
        $criteria= new CDbCriteria;
        $criteria->addCondition('company_id='.$id);
        $criteria->order="display_order asc";
        $videos = Videos::model()->findAll($criteria);
		$this->render('index',array(
			'model'=>$model,
            'videos'=>$videos,
            'cmodel'=>$cmodel,
		));
	}
     public function actionGetVideo()
    {
        $id=$_POST['id'];
        $video=Videos::model()->findByPk($id);
       
        $result['title']=$video->title;
        $result['code']=$video->code;
        $result['id']=$video->id;
       
        $return=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $return;
    }
     public function actionDelete($id)
    {
        if(Videos::model()->deleteByPk($id))Yii::app()->user->setFlash('success', '<strong>Success - </strong> Successfully deleted.'); 
        else  Yii::app()->user->setFlash('error', '<strong>Error - </strong> Cannot be deleted.'); 
        $this->redirect(Yii::app()->request->urlReferrer);
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Videos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='videos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionSortvideos()
    {
        $ids = $_GET['listitem'];
        if (empty ($ids) || !is_array($ids)){
            die();
        }
        $order = 1;
        foreach ($ids as $id){
            Videos::model()->updateByPk($id, array('display_order'=>$order));
            $order++;
        }
    
         echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is sorted successfully.</div>';
         die();    
    }
}
