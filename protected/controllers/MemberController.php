<?php
class MemberController extends Controller
{
    //public $layout='//layouts/column2';

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
    public function actionCheckemail()
    {
        $member = new Member;
        $cond = '';
        if(isset($_GET['type']))
        {
            if(isset(Yii::app()->user->id))
                $cond = 'id <> '.Yii::app()->user->id;
            if($_GET['type']=='email')
            {
                if($member->findByAttributes(['email'=>$_POST['email']],$cond))
                {
                   echo "false";
                }
                else
                    echo "true";
            }
            else
            {
                 if($member->findByAttributes(['username'=>$_POST['username']],$cond))
                {
                   echo "false";
                }
                else
                    echo "true";
            }
            die();
        }
    }
    public function actionSignup()
    {
        $member = new Member;
        
        if(isset($_POST['signup']))
        {
            $member->fname = $_POST['fname'];
            $member->lname = $_POST['lname'];
            $member->email = $_POST['email'];
            $member->dob = $_POST['y_ob']."-".$_POST['m_ob']."-".$_POST['d_ob'];
            $member->password_real = $_POST['password_signup'];
            $member->password = sha1($_POST['password_signup']);
            $member->gender = $_POST['gender'];
            if($member->save())
            {
                $id = $member->id;
                $pin = CommonClass::randomString('8');
                Yii::app()->session["pin_$id"] = $pin;
                $url = Yii::app()->request->baseUrl."/member/confirmation/hash/".sha1($member->email)."acef".$id;
                $msg = "Hi ".ucfirst($_POST['fname'])." ".ucfirst($_POST['lname']);
                $msg .= "<br/><br/> Thankyou for creating an account on the Go Run SA website.<br/><br/>
                        Verify your regestration by clicking on the link below or by copying and pasting this link on tyhe browser.
                        <br/>When prompted please enter the following One Time Pin: ".$pin;
                $msg .= "<br/><br/>Verification link:<br/>
                        <a href='".$url."' taget='_blank'>".$url."</a>";
                echo $msg; 
                    CommonClass::sendEmail("","",$member->email,"Confirmation Email",$msg);     
                 Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - A new event has been added successfully!');
				//$this->redirect(array('index'));
            }
         
        }
        if(!Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl.'/dashboard');
        }
       
        
    }
    public function actionConfirmation($hash="")
    {
        
        $m = explode('acef',$hash);
        $id = $m[1];
        $member =  Member::model()->findByPk($id);
        if(Yii::app()->session['pin_'.$id]){
        if(isset($_POST['Verify'])){
            if(Yii::app()->session['pin_'.$id]==$_POST['code'])
            {
                Yii::app()->user->setFlash('error', '<strong>Success - </strong>.');
                if($m[0] == sha1($member->email))
                {
                    $member->saveAttributes(['is_verified'=>1]);
                       
                    unset(Yii::app()->session['pin_'.$id]);
                    $this->redirect('/member/login');
                }
            }
            else
            {
                
                Yii::app()->user->setFlash('error', '<strong>Error - </strong> The Pin didnot match.Please try later.');
                 //$this->redirect(Yii::app()->request->urlReferrer);
            }
        }
        $this->render('/signup/index',array('member'=>$member));
        }
        else
            $this->redirect(Yii::app()->request->baseUrl);
        
        
    }
    public function actionLogin()
	{
        if(Yii::app()->user->id)
        {
            $this->redirect(array('/dashboard'));
        }
        $model=new LoginForm('login');
        $model2=new LoginForm('passwordReminder');
		// if it is ajax validation request
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/

		// collect user input data
		if(isset($_POST['login']))
		{
			//$model->attributes=$_POST['LoginForm'];
            $model->username = $_POST['LoginForm_username'];
            $model->password = $_POST['LoginForm_password'];
            if(isset($_POST['remember']))
                $model->rememberMe = $_POST['remember'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
            {
                //$this->redirect(array('/member/info'));
                echo "OK";
            }
            else
            {
                echo "Error";
            }
				
		}
        else{
            $this->render('login');
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