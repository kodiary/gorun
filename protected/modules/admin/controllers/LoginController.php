<?php

class LoginController extends Controller
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
    public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'login' actions.
				'actions'=>array('index','login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex()
	{
        if(Yii::app()->user->id)
        {
            $this->redirect(array('/admin/dashboard'));
        }
        $this->layout='adminIndex';
        $model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/admin/dashboard'));
		}
		// display the login form
        $this->render('index',array('model'=>$model));
	}
    public function actionLogout()
	{
		Yii::app()->user->logout();
		  $this->redirect(Yii::app()->getModule('admin')->user->loginUrl);
	}
    
    public function actionDashboard()
    {
        $this->render('dashboard'); 
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}