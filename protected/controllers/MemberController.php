<?php
class MemberController extends Controller
{
    public $layout='//layouts/column2';

    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
    public function actionLogin()
	{
        if(Yii::app()->user->id)
        {
            $this->redirect(array('/member/info'));
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
				$this->redirect(array('/member/info'));
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
    
    
	public function actionIndex()
	{
        if(Yii::app()->user->id)
        {
            Yii::app()->user->logout();
        }
		$model = new Company('signup'); //signup scenario
        
        if(isset($_POST['Company']))
		{
			$model->attributes = $_POST['Company'];
            $model->slug = CommonClass::getSlug($_POST['Company']['name']);
            $model->date_added = date('Y-m-d');
            $model->password = sha1($model->password_real);
			if($model->save())
            {
                $_POST['Company']['user_email']=$_POST['Company']['email'];
                if($this->notifyAdmin($_POST['Company']) && $this->notifyCompany($_POST['Company']))
                {
                        $this->redirect(array('signup/success/id/'.$model->id));
                }
                //$this->notifyCompany($_POST['Company'],$model->id);
            }
		}
        $this->render('index',array('model'=>$model));
	}

    private function notifyAdmin($info)
    {
        $email = Yii::app()->email;
        $to_emails = AdminEmail::model()->findByPk(1);
        
        $receivers="";
        if($emails)
        {
            if($emails->email1!="")$receivers.=$emails->email1.",";
            if($emails->email2!="")$receivers.=$emails->email2.",";
            if($emails->email3!="")$receivers.=$emails->email3.",";
            if($emails->email4!="")$receivers.=$emails->email4.",";
            if($emails->email5!="")$receivers.=$emails->email5.",";
        }
        
        if($receivers!="")$receivers=rtrim($receivers,",");
        else $receivers=Yii::app()->params['adminEmail'];
        
        $email->to =  $receivers;
        $email->from = "exsa.co.za <exsa@exsa.co.za>";
        $email->subject = 'New Company Registered';
        $email->view='signupAdmin';
        $email->viewVars=$info;
        if($email->send())return true;
        else return false;
    }
    
    private function notifyCompany($info)
    {
        $email = Yii::app()->email;
       
        $email->to = $info['email'];
        $email->from = "exsa.co.za <exsa@exsa.co.za>";
        $email->subject = 'Welcome to Exsa directory';
        $email->replyTo = 'exsa.co.za <noreply@exsa.co.za>';
        $email->view='signupCompany';
        $email->viewVars=$info;
        if($email->send())return true;
        else return false;
    }
    
    public function actionSuccess()
	{
	    $loginForm = new LoginForm;
        $id = $_GET['id'];
        Yii::import('application.modules.company.components.UserIdentity');
        $info = Company::model()->findByPk($id);
        //$info->status = 1;
        $info->save();
        $loginForm->username = $info->email;
        $loginForm->password = $info->password_real;
        if($loginForm->login()){
		$this->render('success');
        }
	}
}