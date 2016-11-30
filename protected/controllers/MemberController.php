<?php
class MemberController extends Controller
{
    //public $layout='//layouts/column2';
    public $username;
    
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
    public function actionDetails($slug)
    {
        
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/jquery.infinitescroll.js"));
        //$club = Club::model()->with(['extras','member:recent'=>['together'=>true]])->findByAttributes(['slug'=>$slug],['limit'=>2]);
        $member = Member::model()->findByAttributes(['username'=>$slug]);
       
        $events = EventsType::model()->findAll();
        
        $companyId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = 'company_id='.$member->id;
        $criteria->order = 'publish_date DESC,t.id DESC';
        $isfollowed = MemberFollow::model()->isfollowed($member->id,Yii::app()->user->id);
        //$results_best = EventResult::model()->findAllByAttributes(['user_id'=>Yii::app()->user->id, ]);
               
        $results = Yii::app()->db->createCommand('SELECT distance,dist_time,event_type FROM tbl_event_result AS a, (SELECT MIN(dist_time) AS mini FROM tbl_event_result GROUP BY event_type ,distance ) AS m WHERE m.mini = a.dist_time AND a.user_id='.$member->id.' ORDER BY a.event_type ASC, distance ASC')->queryAll();
        //$clubs = ClubMember::model()->findAllByAttributes(['member_id'=>$member->id]);
        $clubs = Yii::app()->db->createCommand()
            ->select('title')
            ->from('tbl_clubs c')
            ->join('tbl_club_members m', 'c.id=m.club_id AND m.member_id=:mid',array(':mid'=>$member->id))
            ->order('c.title asc')
            ->queryAll();
        $pages='';
        $this->render('details', array('model'=>$member,'pages'=>$pages,'isfollowed'=>$isfollowed,'events'=>$events,'results'=>$results,'clubs'=>$clubs,'limit'=>Yii::app()->params['results_per']));
        
       
    }
    public function actionCheckemail($username='')
    {
        
        $member = new Member;
        
        $cond = '';
        if(isset($_GET['type']) && isset($_POST) || $username!='')
        {
            if(isset(Yii::app()->user->id))
                $cond = 'id <> '.Yii::app()->user->id;
            if($_GET['type']=='email'|| $_GET['type'] == 'sa_identity_no')
            {
                if($member->findByAttributes([$_GET['type']=>$_POST[$_GET['type']]],$cond))
                {
                   echo "false";
                }
                else
                    echo "true";
            }
            else if($_GET['type']=='championchip' || $_GET['type']=='tracetec'){
                $member = new MemberExtra;
               if($member->findByAttributes(['type'=>$_GET['type'],'value'=>$_POST[$_GET['type']]],$cond))
                {
                   echo "false";
                }
                else
                    echo "true";
            }
            else
            {
                if($username == '')
                    $username1 = $_POST['username'];
                else
                	$username1 = $username;    
                 if($m = $member->findByAttributes(['username'=>$username1],$cond))
                {
                    
                    if($username!='')
                        self::actionCheckemail($username.rand(0,1000));
                    else
                        echo "false";
                }
                else
                {
                    //echo $n = $username;
                    if($username!=""){
                        //die('s');
                         $this->username =$username;
                         
                        }
                    else
                        echo "true";
                }
            }
            $this->renderPartial('_ajaxContent', '', false, false);//die();
        }
    }
    public function actionSignup()
    {
        //echo $this->createAbsoluteUrl('test/test');die();
        $member = new Member;
        
        if(isset($_POST['fname']))
        {
            $member->fname = $_POST['fname'];
            $member->lname = $_POST['lname'];
            $member->email = $_POST['email'];
            $member->dob = $_POST['y_ob']."-".$_POST['m_ob']."-".$_POST['d_ob'];
            $member->password_real = $_POST['password_signup'];
            $member->password = sha1($_POST['password_signup']);
            $member->gender = $_POST['gender'];
            $username = $_POST['fname'].$_POST['lname'];
            $this->actionCheckemail(CommonClass::getSlug($username));
            $member->username =  $this->username;
            
            if($member->save())
            {
                $id = $member->id;
                CommonClass::sendConfirmationEmail($member);
                     
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - User has been added. Please verfiy your account.');
				$this->redirect(Yii::app()->request->baseUrl);
            }
         
        }
        if(!Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl.'/dashboard');
        }
       
        
    }
    public function actionConfirmation($hash="")
    {
        Yii::import('application.modules.hybridauth.models.*');
        Yii::import('application.modules.hybridauth.components.*');
        $m = explode('acef',$hash);
        $id = $m[1];
        $member =  Member::model()->findByPk($id);
        if(Yii::app()->session['pin_'.$id]){
        if(isset($_POST['Verify'])){
            if(Yii::app()->session['pin_'.$id]==$_POST['code'])
            {
                //Yii::app()->user->setFlash('error', '<strong>Success - </strong>.Your email has been verified. You may now login.');
                if($m[0] == sha1($member->email))
                {
                    $member->saveAttributes(['is_verified'=>1]);
                    //$provider = Member::model()->with(['haLogin'])->findByAttributes(['id'=>$id],'password <>""');
                    //var_dump($provider);
                    //unset(Yii::app()->session['pin_'.$id]);
                    if($provider = Member::model()->with(['haLogin'=>['together'=>true]])->findByAttributes(['id'=>$id,'password'=>''])){
                        
                        //var_dump($provider['haLogin']);
                        $identity = new RemoteUserIdentity($provider->haLogin['loginProvider'],Yii::app()->getModule('hybridauth')->getHybridauth());
                        $identity->id = $id;
                        Yii::app()->user->login($identity, 0);
                        $this->redirect(Yii::app()->request->baseUrl."/dashboard");
                        
                    } else
                    {
                        Yii::app()->user->setFlash('notverified','ok');
                        $this->redirect(Yii::app()->request->baseUrl.'/member/login');
                    }
                }
            }
            else
            {
                
                Yii::app()->user->setFlash('error', '<strong>Error - </strong> The Pin didnot match.Please try again.');
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
            
                $record=Member::model()->findByAttributes(array('email'=>$_POST['LoginForm']['emailAdd']));
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
                       Yii::app()->user->setFlash('error', '<strong>Error - </strong> The email couldnot be sent.Please try later.'); 
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
        $email->from = "gorun.co.za <info@gorun.co.za>";
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
        $email->from = "gorun.co.za <info@gorun.co.za>";
        $email->subject = 'Welcome to GoRun directory';
        $email->replyTo = 'gorun.co.za <noreply@gorun.co.za>';
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
    public function actionLoadmore($model,$offset,$view)
    {
        //echo $model;
        $critera = new CDbCriteria;
        foreach($_POST as $k=>$value)
        {
            if($value!='' && $value != 'with[]')
                $critera->$k = $value;
            elseif($value == 'with[]')
                $critera->with = [$value];
        }
        $critera->offset =$offset;
        //var_dump($critera);
        
        $m = $model::model()->findAll($critera);
        $this->renderPartial('/common/'.$view,['memEvents'=>$m,'offset'=>$offset+$_POST['limit']]);
       
    }
}