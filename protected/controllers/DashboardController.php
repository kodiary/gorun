<?php
class DashboardController extends Controller
{
    public $layout='//layouts/column2';
    
    public function init()
    {
       
        if(Yii::app()->user->isGuest)
        {
            
            $this->redirect(Yii::app()->request->baseUrl);
        }
        else
        {
            $member = Member::model()->findByPk(Yii::app()->user->id);
            
            if($member->is_verified=='0')
            {
                Yii::app()->user->setFlash('error', '<strong>Error - </strong> Please verify your email and try to login.');
                $this->redirect(Yii::app()->request->baseUrl);
            }
        }
    }
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
    public function actionIndex()
	{
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
         
        $member = Member::model()->findByPk(Yii::app()->user->id);
        if(isset($_POST['first_login']))
        {
            $member->saveAttributes(['is_verified'=>'2']);
        }
        if(isset($_POST['submit']))
        {
            
            $member->fname = $_POST['fname'];
            $member->lname = $_POST['lname'];
            $member->email = $_POST['email'];
            $member->dob = $_POST['y_ob']."-".$_POST['m_ob']."-".$_POST['d_ob'];
            $member->username = $_POST['username'];
            $member->mobile = $_POST['mobile'];
            $member->sa_identity_no = $_POST['sa_identity_no'];
            $member->championchip = $_POST['championchip'];
            $member->tracetec = $_POST['tracetec'];
            $member->gender = $_POST['gender'];
            
            if($_POST['logo']!='')
            {
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $member->logo = $_POST['logo'];                
            }
            //var_dump($member);
            if($member->save())
            {
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your details has been updated successfully!');
            }
            
          
              
        }
        if($member->is_verified == '1')
            $this->render('first_login');
        else
            $this->render('index',['member'=>$member]);
        
	}
    
    public function actionPassword()
    {
        
        $member = Member::model()->findByPk(Yii::app()->user->id);
        $pass = CommonClass::encoded_password($member->password_real);
        if(isset($_POST['submit']))
        {
            $member->password_real = $_POST['password'];
            $member->password = sha1($_POST['password']);
            if($member->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your password has been updated successfully!');
            }
        }
        $this->render('password',['password'=>$pass]);

    }
    
    

    
}