<?php

class ClubController extends Controller
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
			array('allow',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Club;
        $model->country = Yii::app()->params['defaultCountryId'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Club']))
		{
			$model->attributes=$_POST['Club'];
            if($model->editor_type==0 && $_POST['Club']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Club']['basic_editor']);
            }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
    
    public function actionAddBlank()
    {
        $model=new Club('adminSignup');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        //Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?key=AIzaSyDdlZuslizFva3XY9GZVyF_IDZTDI-7BD0&libraries=places");
        Yii::app()->clientScript->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo&libraries=places");
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_new.js"));
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        $events = EventsType::model()->findAll();
        /*if($_POST['Club'])
        {
             $model->attributes=$_POST['Club'];
             $model->slug=CommonClass::getSlug($_POST['Club']['title']);
             $model->date_added=date('Y-m-d');
             $model->date_updated=date('Y-m-d');
             $model->status=0;
             $model->password = sha1($model->password_real);
             if($model->save())
             {
                $_POST['Club']['user_email']=$_POST['Club']['email'];
                $this->notifyClub($_POST['Club']);
                $this->redirect(array('/admin/Club/update/id/'.$model->id));
             }
        }*/
        $this->render('update',array('model'=>$model,'events'=>$events));
    }
    
    private function notifyClub($info)
    {
       $email = Yii::app()->email;
                
        $email->to =  $info['user_email'];
        $email->replyTo="exsa.co.za <noreply@exsa.co.za>";
        $email->from = "exsa.co.za <info@exsa.co.za>";
        $email->subject = 'Welcome to EXSA';
        $email->view='adminNotifyClub';
        $email->viewVars=$info;
        if($email->send())return true;
        else return false; 
    }    

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        //Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?key=AIzaSyDdlZuslizFva3XY9GZVyF_IDZTDI-7BD0&libraries=places");
        Yii::app()->clientScript->registerScriptFile("https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo&libraries=places");
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_new.js"));
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        $events = EventsType::model()->findAll();
        //$member = User::model()->findByPk(1);
        if($id == 0)
        {
            $club = new Club;
            $club->created_by =  '0';
            
        }
        else
        {
		    $club=$this->loadModel($id);
            $club->created_by =  Yii::app()->user->id;
        }
        $types ='';
        //var_dump($_POST);die();
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
            $club->trial_day =  isset($_POST['trial_day'])?$_POST['trial_day']:'';
            $club->trial_time =  isset($_POST['trial_time'])?$_POST['trial_time']:'';
            $club->trial_desc =  isset($_POST['trial_desc'])?$_POST['trial_desc']:'';
            $club->contact_person =  isset($_POST['contact_person'])?$_POST['contact_person']:'';
            $club->website =  $_POST['website'];
            $club->fb_page =  $_POST['fb_page'];
            $club->twitter_page =  $_POST['twitter_page'];
            
            $club->contact_email = $_POST['contact_email'];
            $club->google = $_POST['google'];
            $club->contact_number = $_POST['contact_number'];
            $club->date_updated=date('Y-m-d H:i:s');
           //if($club->seo_title=="")$club->seo_title=$club->title." in Clubs | GoRun.co.za.";
           //if($club->seo_desc=="")$club->seo_desc=CommonClass::limit_text($club->detail);
            
            if($club->save())
            {
                //$id = $club->id;
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Club has been updated successfully!');
                if($id != 0)
				$this->redirect(Yii::app()->request->requestUri);
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Error</strong>!');
            }
	   }
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
		$this->render('update',array(
			'model'=>$club,
            'events'=>$events,
            //'member'=>$member
            //'tradinghours'=>$tradinghours,
		));
	}
    public function actionUpdatestatus($id)
    {
       $model=$this->loadModel($id);
       $model->scenario = 'updatestatus'; 
       if(isset($_POST['Club']))
       {
             $model->attributes=$_POST['Club'];
             $model->date_updated=date('Y-m-d');
       
            if($model->save())
            {
               echo "<div class='alert alert-block alert-success fade in'>Saved Successfully!</div>"; 
               echo '<script type="text/javascript">$(document).ready(function(){ $(".alert-block ").fadeOut(3000); });</script>';
               return; 
            }
            else
            {
                echo "<div class='alert alert-block alert-error fade in'>Something went wrong!</div>";
                echo '<script type="text/javascript">$(document).ready(function(){ $(".alert-block ").fadeOut(3000); });</script>';
                return;
            }
       }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	   if($id) // if no franchise exists
		{
            //delete stats
            ClubViews::model()->deleteAllByAttributes(array('Club_id'=>$id));
            ClubClicks::model()->deleteAllByAttributes(array('Club_id'=>$id));
            //deelte Gallery
            Gallery::model()->deleteAllByAttributes(array('Club_id'=>$id));
            Videos::model()->deleteAllByAttributes(array('Club_id'=>$id));
            //delete products,services and brands
            ClubServices::model()->deleteAllByAttributes(array('Club_id'=>$id));

            //delete brochures
            Brochures::model()->deleteAllByAttributes(array('Club_id'=>$id));

            //delete restaurants info
            Tradinghours::model()->deleteAllByAttributes(array('Club_id'=>$id));
            //delete restaurant
			if($this->loadModel($id)->delete())
            Yii::app()->user->setFlash('success', '<strong>Success - </strong> Club deleted successfully.');
            else
            Yii::app()->user->setFlash('error', '<strong>Error - </strong> Error in deletion.');
            
            $this->redirect(array('index'));
            //$this->redirect(Yii::app()->request->getUrlReferrer());
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($filter="")
	{
	   //echo Yii::app()->controller->action->id;
        $c1 = new CDbCriteria;
        if(isset($_GET['key']))
        {
            $key=trim($_GET['key']);
            $c1->addSearchCondition('title',$key,true,'OR');
        }
        $c1->addCondition('title!=""');
        //$c1->addCondition('isActive!=1');
        if($filter=="") $order='title ASC';
        if($filter=="newest") $order='id DESC';
        if($filter=="new") { 
            $criteria= new CDbCriteria;
            $criteria->select='club_id';
            $criteria->group='club_id';    
            
            $all_id=ClubMember::model()->findAll($criteria);
            $ids=array();
            if($all_id)
            {
                foreach($all_id as $id)
                {
                    $ids[]=$id->club_id;
                }
            }
            $c1->addNotInCondition('id',$ids);
            $order='id ASC';
        }
        if($filter=="oldest") $order='id ASC';
        if($filter=="updated") $order='date_updated DESC,id DESC';
        if($filter=="inactive" || $filter=="draft")
        {
            $c1->addCondition('status=0');
            $order='title ASC';
        }
        else  $c1->addCondition('status=1');
        $c1->order=$order;
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Club',array('criteria'=>$c1, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 15;
            $pages->applyLimit($criteria);
        }
        else
    	$dataProvider=new CActiveDataProvider('Club',array('criteria'=>$c1));
      
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'filter' =>$filter,
            'pages'=>$pages,
		));
	}
     public function actionNewListings()
	{
    	$dataProvider=new CActiveDataProvider('Club',
        array( 
            'criteria'=>array(
            'order'=>'id DESC',
            'limit'=>10,
            ),
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Club::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Club-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionUpload()
    {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
     
            $folder=Yii::app()->basePath.'/../images/temp/full/';// folder to upload file
            $allowedExtensions = array("jpg","jpeg",'gif','png');
            $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            if($result['success'])
            {
                 $file=$folder.$result['filetitle'];
                 $result['imageFull']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filetitle'];
                 
                 Yii::import('application.extensions.image.Image');
                 $resize_detail=CommonClass::get_resize_details('Club_logo');
                 if (is_array($resize_detail))
                 {
                    foreach($resize_detail as $resize_item)
                    {
                        //load image library for resizing
                        $image = new Image($file);
                        
                        $image->save($resize_item["new_path"].$result['filetitle']);
                        $image_new = new Image($resize_item["new_path"].$result['filetitle']);
                        list($width,$height) = getimagesize($file);
                        
                        if($width > $resize_item["width"])
                        {
                           $image_new->resize($resize_item["width"],$resize_item["height"],Image::WIDTH)->quality(90);
                           $image_new->save(); 
                        }
                         list($new_width,$new_height)=getimagesize($resize_item["new_path"].$result['filetitle']);
                         if($new_height>$resize_item["height"])
                         {
                             $image_new->resize($new_width,$resize_item["height"],Image::HEIGHT)->quality(90);
                         }
                         $image_new->save($resize_item["new_path"].$result['filetitle']);
                 } 
                 $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/main/'.$result['filetitle'];  
            }
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }
        else
            {
                $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
            }
            
    
    }
    
    function actionCropLogo()
    {
        if($_POST['filetitle']!="")
        {
            Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        	);
        	$imageUrl = Yii::app()->baseUrl.'/images/temp/full/'. $_POST['filetitle'];
        	$this->renderPartial('_cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['filetitle']), false, true);
         }
         else
            echo "";
    } 
    public function actionCrop()
    {
       $x=$_POST['cropX'];
       $y=$_POST['cropY'];
       $width=$_POST['cropW'];
       $height=$_POST['cropH'];
       $src_file=Yii::app()->basePath.'/../images/temp/full/'.$_POST['filetitle'];
       $temp_file=Yii::app()->basePath.'/../images/temp/'.$_POST['filetitle'];
       
       Yii::import('application.extensions.image.Image');
       
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);
       
       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize(120,90);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filetitle']);
       
       $cropped_image->resize(260,200);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/main/'.$_POST['filetitle']);
    
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       echo Yii::app()->baseUrl.'/images/temp/main/'.$_POST['filetitle'].'?id='.rand();
    }  
    
    public function actionServices($id)
	{
	    $model=$this->loadModel($id);
        $services = new ClubServices;
                
	    if($_POST)
        {           
            //for services
            if(isset($_POST['ClubServices']))
            {
                Services::model()->deleteClubAdditionalServices($id);
                ClubServices::model()->deleteAllByAttributes(array('Club_id'=>$id));
                $services->attributes = $_POST['ClubServices'];
                $comService = $services->service_id;
                for($i=0; $i<count($comService); $i++)
                {
                    $services->isNewRecord = true;
                    $services->primaryKey = NULL;
                    $services->Club_id = $id;
                    $services->service_id = $comService[$i];
                    if($services->service_id!=0)$services->save(false);    
               }
               
               if($_POST['hiddenServiceList']){
                    $additionalModel = new Services;
                    $additionalServices = $_POST['hiddenServiceList'];
                    $addedServices = explode(',',$additionalServices);
                    foreach($addedServices as $ser)
                    {
                        $additionalModel->isNewRecord = true;
                        $additionalModel->primaryKey = NULL;
                        $additionalModel->service_title = $ser;
                        $additionalModel->additional = 1;
                        if($additionalModel->save(false)){
                            CommonClass::makeSlug($additionalModel, $additionalModel->service_title, $additionalModel->id);
                            $services->isNewRecord = true;
                            $services->primaryKey = NULL;
                            $services->Club_id = $id;
                            $services->service_id = $additionalModel->id;
                            $services->save(false);
                        }
                    }
               }
            }
            Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
        }
		$this->render('application.modules.admin.views.Club.product_service_brand',array(
			'model'=>$model,
            'services'=>$services,
            'ClubId'=>$id,
		));
	} 
    
    public function actionAccounts($id)
    {
        $status = Club::model()->findByPk($id)->status;
        $accounts = Accounts::model()->findByPk(1);
        
        $this->render('accounts',array(
            'status'=>$status,
            'accounts'=>$accounts,
            'Club'=>Club::ClubInfo($id),
        ));
    }
    public function actionLogin($id)
    {
        $model=$this->loadModel($id);
        $model->scenario='editlogin';
        if(isset($_POST['Club']))
        {
           //print_r($_POST['Restaurants']);exit;
            $model->attributes=$_POST['Club'];
            $model->date_updated=date('Y-m-d H:i:s');
            $model->password=sha1($model->password_real);
        	if($model->save())
            {
               Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
            }
        }
        $this->render('login',array('model'=>$model)); 
    }
    
    public function actionContact($id='')
    {
        if(isset($id))
        {
            $model = $this->loadModel($id);
            if($model)
            {
                $contactModel = new ContactForm('contactClub');
                if(isset($_POST['contactClub']))
                {
                    if($model->email!="" || $model->email!=null)
                    {
                        $emails = AdminEmail::model()->findByPk(1);
                        $admin_email="";
                        if($emails)
                        {
                            if($emails->email1!="")$admin_email.=$emails->email1.",";
                            if($emails->email2!="")$admin_email.=$emails->email2.",";
                            if($emails->email3!="")$admin_email.=$emails->email3.",";
                            if($emails->email4!="")$admin_email.=$emails->email4.",";
                            if($emails->email5!="")$admin_email.=$emails->email5.",";
                        }
                        if($admin_email=="")$admin_email=Yii::app()->params['adminEmail'];
                        
                        $subject="Message from EXSA";
                        $body = $this->renderPartial('application.views.email.contactClub',array('body'=>$_POST['ContactForm']['body'],'Clubtitle'=>$model->title),true);
                        CommonClass::sendEmail("","", $model->email, $subject, $body,$admin_email) ;
                        Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> '.$model->title.' has been contacted successfully.'); 
                    }
                    else
                    {
                         Yii::app()->user->setFlash('info', '<strong>ERROR! </strong> '.$model->title.' do not have valid email.');
                    }
                }
                $this->render('contactClub',array('Club'=>$model->title,'model'=>$contactModel));
            }        
        }
    }
    
    public function actionUpdateMemberType($id)
    {
       $model=new ClubMember;
       if(isset($_POST['ClubMember']) && $_POST['ClubMember']['member_id']!="")
       {
            ClubMember::model()->deleteAllByAttributes(array('Club_id'=>$id));
            $model->attributes=$_POST['ClubMember'];
            $comMember = $model->member_id;
            for($i=0; $i<count($comMember); $i++)
            {
                $model->isNewRecord = true;
                $model->primaryKey = NULL;
                $model->Club_id = $id;
                $model->member_id = $comMember[$i];
                $model->save(false);   
                $status=true;
            }
            Yii::app()->user->setFlash('success', 'Club member type saved successfully!');
            $this->redirect(array('Club/update/id/'.$id));
        }
    }
    
    public function actionExport()
    {
        $this->render('export');
    }
    
    public function actionExporttoExcel()
    {
	
        $criteria = new CDbCriteria;
        
        $criteria->select = 'title, contact_person, number, email, fax, website, twitter, facebook, pinterest, google, tagline, detail, display_address, postal_address, street_add, suburb, province, latitude, longitude';

$sql = "SELECT t.*, m.type_title as member_type FROM tbl_Club as t JOIN tbl_Club_member as c ON c.Club_id = t.id JOIN tbl_member_type as m ON m.id = c.member_id";

$DATA = new CSqlDataProvider($sql, array('pagination'=>false));        
/*$DATA = new CActiveDataProvider('Club', array(
    'criteria' => array(
        'select' => array('t.*', 'm.type_title AS member_type'),
        'join' => 'JOIN tbl_Club_member as c ON c.Club_id = t.id JOIN tbl_member_type AS m ON m.id = c.member_id',
    )
));*/
        //$c->condition='event_id='.$eventid;
        //$DATA = new CActiveDataProvider('Club', array('criteria'=>$criteria, 'pagination'=>false));
        //var_dump($DATA);die();
        $this->widget('ext.EExcelView', array(
             'dataProvider'=> $DATA,
             'title'=>"Club Member",
             'autoWidth'=>false,
             //'filetitle'=>'',
             'stream'=>true,
             //'exportType'=>'Excel5',
             'grid_mode'=>'export',
             'columns'=>array(
                'title',
                'contact_person',
                'member_type',
                'number',
                'email',
                'fax',
                'website',
                'twitter',
                'facebook',
                'pinterest',
                'google',
                'tagline',
                'detail',
                'display_address',
                'postal_address',
                'street_add',
                'suburb',
                'province',
                'latitude',
                'longitude',
            ),
        ));
        //ExcelExporter::sendAsXLS($DATA, true, 'data.xlsx');
        Yii::app()->end();
    }
}