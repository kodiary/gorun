<?php

class LoginController extends Controller
{
	public $layout='column2';
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
				'actions'=>array('index','login','passwordReminder','details'),
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
            $this->redirect(array('/company/info'));
        }
        $model=new LoginForm('login');
        $model2=new LoginForm('passwordReminder');
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['login']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('/company/info'));
		}
        if(isset($_POST['btnRemindPass']))
		{
            
                $record=Company::model()->findByAttributes(array('email'=>$_POST['LoginForm']['emailAdd']));
                if($record===null)
                {
                    Yii::app()->user->setFlash('info', '<strong>ERROR - </strong> The email address does not exist in the database. Try another.');
                }
                else
                {
                    $password=$record->password_real;
                    $email=$record->email;
                    $name=$record->name;
                    if($this->sendPassword($email,$password,$name))
                        Yii::app()->user->setFlash('success', '<strong>Success - </strong> The password has been sent to the email address provided.');
                    else
                       Yii::app()->user->setFlash('error', '<strong>Error - </strong> The email cannot be sent.Please try later.'); 
                }
            }
		// display the login form
        $this->render('index',array('model'=>$model,'model2'=>$model2));
	}
    public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    public function actionDetails()
    {
      if(Yii::app()->user->id)
        {
            $id=Yii::app()->user->getId();
            $model=$this->loadModel($id);
            $model->scenario='editlogin';
            if(isset($_POST['Company']))
    	   	   {
                    $model->attributes=$_POST['Company'];
                    $model->date_updated=date('Y-m-d');
                    $model->password=sha1($model->password_real);
        			if($model->save())
                    {
                       Yii::app()->user->setFlash('success', '<strong>Success - </strong> Changes have been successfully saved.');   
                    }
                }
                $this->render('logindetails',array('model'=>$model)); 
        }
        else
        {
            $this->redirect(Yii::app()->user->loginUrl);
        }
    }
    public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function sendPassword($email_add,$password,$name)
    {
        
        $email = Yii::app()->email;
        
        $email->to =  $email_add;
        $email->from = "Exsa.co.za <info@exsa.co.za>";
        $email->replyTo="Exsa.co.za <noreply@exsa.co.za>";
        $email->subject = 'Password Reminder';
        $email->view='passwordReminder';
        $email->viewVars=array('email_add'=>$email_add,'password'=>$password,'name'=>$name);
        if($email->send())return true;
        else return false;
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