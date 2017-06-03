<?php
class AdminemailController extends Controller
{
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
			array('allow', // allow authenticated user to perform  actions
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
        $model = AdminEmail::model()->findByPk(1);
        $configModel=Config::model()->findByPk(1);
        if(!isset($model) && $model=='') $model = new AdminEmail;
        if(!isset($configModel) && $configModel=='') $configModel = new Config;
        
        if(isset($_POST['AdminEmail'])){
            $model->attributes = $_POST['AdminEmail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '<strong>Success!</strong> Admin Email updated successfully.');
            }
        }
        if(isset($_POST['Config']))
        {
       	    $configModel->attributes = $_POST['Config'];
			if($configModel->save())Yii::app()->user->setFlash('success', '<strong>Success!</strong> Contact notification updated successfully.');
        }
        
		$this->render('index',array('model'=>$model,'configModel'=>$configModel));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel()
	{
		$model=AdminEmail::model()->findByPk(1);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='newsletters-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
