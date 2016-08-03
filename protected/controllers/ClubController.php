<?php
class ClubController extends Controller
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
            $club = Member::model()->findByPk(Yii::app()->user->id);
            
            if($club->is_verified=='0')
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
         
	   $club = Member::model()->findByPk(Yii::app()->user->id);
	   $this->render('index', array('member'=>$club));
    }
    
    public function actionCreate()
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
         
        $club = new Club;
        
        if(isset($_POST['submit']))
        {
            $club->title = $_POST['title'];
            $club->slug = $club->testSlug(CommonClass::getSlug($_POST['title']));
            $club->description = $_POST['description'];
            if($_POST['logo']!='')
            {
                $logo = explode("?rand",$_POST['logo']);
                $_POST['logo'] = $logo[0];
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/clubs/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/clubs/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/clubs/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/full/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $club->logo = $_POST['logo'];                
            }
            foreach($_POST['type'] as $type)
            {
                $types.= $type.",";
            }
            $club->types = $types;
            $club->venue = $_POST['street_address'];
            $club->town = $_POST['city'];
            $club->province =  $_POST['province'];
            $club->trial_day =  $_POST['trial_day'];
            $club->trial_time =  $_POST['trial_time'];
            $club->trial_desc =  $_POST['trial_desc'];
            $club->contact_person =  $_POST['contact_person'];
            $club->website =  $_POST['website'];
            $club->fb_page =  $_POST['fb_page'];
            $club->twitter_page =  $_POST['twitter_page'];
            $club->created_by =  Yii::app()->user->id;
            
            
            if($club->save())
            {
                $id = $club->id;
                $clubExtra = new ClubExtra;
                foreach($_POST['contact_number'] as $number)
                {
                    if($number != '')
                    {
                        $clubExtra = new ClubExtra;
                        $clubExtra->type = 'contact_number';
                        $clubExtra->value= $number;
                        $clubExtra->club_id = $id;
                        $clubExtra->save();
                        unset($clubExtra);
                    }
                }
                
                foreach($_POST['contact_email'] as $number)
                {
                    if($number != "")
                    {
                        $clubExtra = new ClubExtra;
                        $clubExtra->type = 'contact_email';
                        $clubExtra->value= $number;
                        $clubExtra->club_id = $id;
                        $clubExtra->save();
                        unset($clubExtra);
                    }
                }
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - A new club has been added successfully!');
				$this->redirect(Yii::app()->request->baseUrl);
            }
         
        }
        if(!Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl.'/dashboard');
        }
       
        
    }
    public function generateSlug($string)
    {
        
    }
 }
 ?>