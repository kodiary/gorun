<?php
class SignupController extends Controller
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
            'oauth' => array(
        // the list of additional properties of this action is below
        'class'=>'ext.hoauth.HOAuthAction',
        // Yii alias for your user's model, or simply class name, when it already on yii's import path
        // default value of this property is: User
        'model' => 'Member', 
        // map model attributes to attributes of user's social profile
        // model attribute => profile attribute
        // the list of avaible attributes is below
        'attributes' => array(
          'email' => 'email',
          'fname' => 'firstName',
          'lname' => 'lastName',
          'gender' => 'genderShort',
          'dob' => 'birthDate',
          // you can also specify additional values, 
          // that will be applied to your model (eg. account activation status)
          'is_verified' => 1,
        ),
      ),
      // this is an admin action that will help you to configure HybridAuth 
      // (you must delete this action, when you'll be ready with configuration, or 
      // specify rules for admin role. User shouldn't have access to this action!)
      'oauthadmin' => array(
        'class'=>'ext.hoauth.HOAuthAdminAction',
      ),
      );
	}
	public function actionIndex()
	{
        if(Yii::app()->user->id)
        {
            $this->redirect(Yii::app()->homeUrl);
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