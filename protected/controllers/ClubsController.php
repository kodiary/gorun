<?php
class ClubsController extends Controller
{
    public $layout='//layouts/column2';
    
    public function init()
    {
       
        if(Yii::app()->user->isGuest)
        {
            
            //$this->redirect(Yii::app()->request->baseUrl);
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
	   if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?key=AIzaSyDdlZuslizFva3XY9GZVyF_IDZTDI-7BD0&libraries=places");
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_new.js"));
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD); 
        $events = EventsType::model()->findAll();
	   $club = Member::model()->findByPk(Yii::app()->user->id);
	   $this->render('index', array('member'=>$club,'events'=>$events));
    }
    
    public function actionCreate()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
         
        $club = new Club;
        //var_dump($_POST);
        if(isset($_POST['title']))
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
            if($_POST['cover']!='')
            {
                $logo = explode("?rand",$_POST['cover']);
                $_POST['cover'] = $logo[0];
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['cover']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['cover']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['cover'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['cover']);
                
                @unlink(Yii::app()->basePath."/../images/temp/full/".$_POST['cover']);
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['cover']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['cover']);
                $club->cover = $_POST['cover'];                
            }
            foreach($_POST['type'] as $type)
            {
                $t = explode('_',$type);
                
                $types.= $t[0].",";
                
                $eventCategory[]= $t[1];
            }
            $eventCategory = array_unique($eventCategory);
            $club->event_category = implode(",",$eventCategory);
            $club->types = $types;
            $club->venue = $_POST['street_address'];
            $club->town = $_POST['city'];
            $club->latitude = $_POST['latitude'];
            $club->longitude = $_POST['longitude'];
            $club->province =  $_POST['province'];
            $club->trial_day =  $_POST['trial_day'];
            $club->trial_time =  $_POST['trial_time'];
            $club->trial_desc =  $_POST['trial_desc'];
            $club->contact_person =  $_POST['contact_person'];
            $club->website =  $_POST['website'];
            $club->fb_page =  $_POST['fb_page'];
            $club->twitter_page =  $_POST['twitter_page'];
            $club->created_by =  Yii::app()->user->id;
            $club->contact_email = $_POST['contact_email'];
            $club->google = $_POST['google'];
            $club->contact_number = $_POST['contact_number'];
            
            
            if($club->save())
            {
                $id = $club->id;
               /*
                ClubExtra::model()->deleteAllByAttributes(['club_id'=>$id]);
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
                
                //Insert into Club members table
                $clubmember = new ClubMember;
                $clubmember->club_id = $id;
                $clubmember->member_id = Yii::app()->user->id;
                $clubmember->save();*/
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - A new club has been added successfully!');
				$this->redirect(Yii::app()->request->baseUrl);
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Error</strong>!');
            }
         
        }
        
       
        
    }
    public function actionDetails($slug)
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/jquery.infinitescroll.js"));
        //$club = Club::model()->with(['extras','member:recent'=>['together'=>true]])->findByAttributes(['slug'=>$slug],['limit'=>2]);
        $club = Club::model()->with(['extras','member:recent'=>['together'=>true]])->findByAttributes(['slug'=>$slug]);
        //var_dump($club);
        
        if($club->longitude!=0 && $club->latitude!=0)
        {
            Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?key=AIzaSyDdlZuslizFva3XY9GZVyF_IDZTDI-7BD0");
            //Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
            Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_new.js"));
            Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        }
        
        $companyId = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = 'company_id='.$club->id;
        $criteria->order = 'publish_date DESC,t.id DESC';
        
        $pages='';
       
        $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
        $pages = new CPagination($dataProvider->totalItemCount);
        $pages->pageSize = Yii::app()->params['articles_pers_page'];
        $pages->applyLimit($criteria);
    
       
            //$dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria));
        $dataProvider = Articles::model()->findAll($criteria); 
        $ismember = ClubMember::model()->ismember($club->id,Yii::app()->user->id);
        $total_member = ClubMember::model()->totalMember($club->id);
        $this->render('details', array('model'=>$club,'total'=>$total_member,'dataProvider'=>$dataProvider,'pages'=>$pages,'ismember'=>$ismember));
        
       
    }
    function actionUnfollow()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
        if(isset($_POST['clubid']))
        {
            if(ClubMember::model()->deleteAllByAttributes(['club_id'=>$_POST['clubid'],'member_id'=>Yii::app()->user->id]))
                echo "OK";
            else
                echo "Error";
            
            die();
            
        }
    }
    function actionFollow()
    {
        if(Yii::app()->user->isGuest)
        {
            $this->redirect(Yii::app()->request->baseUrl);
        }
        if(isset($_POST['club_id']))
        {
            $clubmember = new ClubMember;
            $clubmember->club_id = $_POST['club_id'];
            $clubmember->member_id = Yii::app()->user->id;
            if($clubmember->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Club Followed!');
                echo "OK";
            }
            else
                echo "Error";
            
            die();
            
        }
    }
    
    public function actionType($match="")
    {
        //die($match);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/jquery.infinitescroll.js"));
        
        $criteria = new CDbCriteria;
        if(isset($match) && $match!='')
        {
            $match = str_replace('_',' ',$match);
            $match = ucfirst($match);
            $type = EventsType::model()->findByAttributes(['title'=>$match]);
            
            //$type = addcslashes($type->id, '%_');
            //$criteria->addSearchCondition('types',$type);
            $criteria->addCondition("types LIKE '$type->id,%' OR types LIKE '%,$type->id,%' OR types LIKE '%,$type->id' OR types LIKE '$type->id'");
           
        }
        
        if(isset($_GET['province']))
        {
            $province = $_GET['province'];
            $prov = Province::model()->getIdbySlug($province);
            
            $criteria->condition= 'province='.$prov;
        }
            
        //$criteria->order = 'publish_date DESC,t.id DESC';
        $pages='';
       
        $dataProvider= new CActiveDataProvider('Club',array('criteria'=>$criteria, 'pagination'=>false));
        $pages = new CPagination($dataProvider->totalItemCount);
        $pages->pageSize = Yii::app()->params['articles_pers_page'];
        $pages->applyLimit($criteria);
        
        $dataProvider = Club::model()->findAll($criteria); 
        //$clubs = Club::model()->findAll('types LIKE :match',[':match'=>"%$match%"]);
        $this->render('type',['clubs'=>$clubs,'type'=>$match,'dataProvider'=>$dataProvider,'pages'=>$pages,'province_id'=>$prov]);
    }
    
    public function actionGetresults()
    {
        
        $criteria = new CDbCriteria;
        $criteria->with = ['member'];
        if(isset($_POST['ids']) &&$_POST['ids']!='')
            $criteria->addInCondition('user_id',explode(',',$_POST['ids']));
        if(isset($_POST['event_type']) && $_POST['event_type']!='')
            $criteria->compare('event_type',$_POST['event_type']);
        if(isset($_POST['distance']) &&$_POST['distance']!='')
            $criteria->addcondition('cast(distance as decimal(5,1))='.$_POST['distance']);
        if(isset($_POST['searchname']) &&$_POST['searchname']!='')
        {
            //echo $_POST['searchname']; die();
            //$criteria->addcondition("member.fname LIKE '%$_POST[searchname]%' and member.lname LIKE '%$_POST[searchname]%'");
            $criteria2 = new CDbCriteria;
            //$criteria2->addCondition("MATCH(member.fname,member.lname) AGAINST('$_POST[searchname]' IN BOOLEAN MODE)");
            //$criteria2->addCondition("MATCH(member.lname) AGAINST('$_POST[searchname]' IN BOOLEAN MODE)");
            $criteria2->addSearchCondition('member.fname',trim($_POST['searchname']),true);
            $criteria2->addSearchCondition('member.lname',trim($_POST['searchname']),true,'OR');
            $criteria->mergeWith($criteria2);
            
        }
        $criteria->group = 'user_id';
        
        
        $count = count(EventResult::model()->findAll($criteria));
        $criteria->limit = Yii::app()->params['results_per'];
        $criteria->order = 'dist_time';
        $report = EventResult::model()->findAll($criteria);
       
        $this->renderPartial('/common/_resultTable',['results'=>$report,'count'=>$count,'criteria'=>$criteria,'offset'=>Yii::app()->params['results_per']]);
        
        
        
    }
    public function actionCategory($match="")
    {
        //die($match);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/jquery.infinitescroll.js"));
        
        $criteria = new CDbCriteria;
        if(isset($match) && $match!='')
        {
            $match = str_replace('_',' ',$match);
            $match = ucfirst($match);
            $type = EventsCategory::model()->findByAttributes(['title'=>$match]);
           
            //$type = addcslashes($type->id, '%_');
            //$critera2 = new CDbCriteria;
            $criteria->addCondition("event_category LIKE '$type->id,%' OR event_category LIKE '%,$type->id,%' OR event_category LIKE '%,$type->id' OR event_category LIKE '$type->id'");
            //$criteria->mergeWith($critera2);
           
        }
        $prov ='';
        if(isset($_GET['province']))
        {
            $province = $_GET['province'];
            $prov = Province::model()->getIdbySlug($province);
            
            $criteria->condition= 'province='.$prov;
        }
           
        //$criteria->order = 'publish_date DESC,t.id DESC';
        $pages='';
       
        $dataProvider= new CActiveDataProvider('Club',array('criteria'=>$criteria, 'pagination'=>false));
        $pages = new CPagination($dataProvider->totalItemCount);
        $pages->pageSize = Yii::app()->params['articles_pers_page'];
        $pages->applyLimit($criteria);
        
        $dataProvider = Club::model()->findAll($criteria); 
        //$clubs = Club::model()->findAll('types LIKE :match',[':match'=>"%$match%"]);
        $this->render('type',['clubs'=>$clubs,'type'=>$match,'dataProvider'=>$dataProvider,'pages'=>$pages,'province_id'=>$prov]);
    }    
    
 }
 ?>