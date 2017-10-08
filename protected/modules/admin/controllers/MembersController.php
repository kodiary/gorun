<?php

class MembersController extends Controller
{
	public $layout='//layouts/column2';
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
		$model=new Member;
        $model->country = Yii::app()->params['defaultCountryId'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Member']))
		{
			$model->attributes=$_POST['Member'];
            if($model->editor_type==0 && $_POST['Member']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Member']['basic_editor']);
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
        $model=new Member('adminSignup');
        if($_POST['Member'])
        {
             $model->attributes=$_POST['Member'];
             $model->slug=CommonClass::getSlug($_POST['Member']['name']);
             $model->date_added=date('Y-m-d');
             $model->date_updated=date('Y-m-d');
             $model->status=0;
             $model->password = sha1($model->password_real);
             if($model->save())
             {
                $_POST['Member']['user_email']=$_POST['Member']['email'];
                $this->notifyMember($_POST['Member']);
                $this->redirect(array('/admin/Member/update/id/'.$model->id));
             }
        }
        $this->render('register',array('model'=>$model));
    }
    
    private function notifyMember($info)
    {
       $email = Yii::app()->email;
                
        $email->to =  $info['user_email'];
        $email->replyTo="GoRun.co.za <noreply@GoRun.co.za>";
        $email->from = "GoRun.co.za <info@GoRun.co.za>";
        $email->subject = 'Welcome to GoRun';
        $email->view='adminNotifyMember';
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
		$member=$this->loadModel($id);
        //var_dump($member);die();
        //$member->scenario="MemberInfo";
        //$tradinghours=Tradinghours::model()->findByAttributes(array('Member_id'=>$id));
        //if($tradinghours==null)$tradinghours= new Tradinghours();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if(isset($_POST['Tradinghours']))
		{
		  if($_POST['Member']['opentimes_type']==2)
          {
            $tradinghours->attributes=$_POST['Tradinghours'];
            $tradinghours->Member_id=$id;
            $tradinghours->save();
          }
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
            $member->facebook = $_POST['facebook'];
            $member->twitter = $_POST['twitter'];
            $member->google = $_POST['google'];
            $member->detail = $_POST['detail'];
            $member->gender = $_POST['gender'];
            $member->suburb = $_POST['suburb'];
            $member->province = $_POST['province'];
            
            if($_POST['logo']!='')
            {
                $logo = explode("?rand",$_POST['logo']);
                $_POST['logo'] = $logo[0];
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/full/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $member->logo = $_POST['logo'];                
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
                $member->cover = $_POST['cover'];                
            }
            //var_dump($member);
            if($member->save())
            {
                $id = $member->id;
                MemberExtra::model()->deleteAllByAttributes(['member_id'=>$id]);
                foreach($_POST['championchip'] as $number)
                {
                    if($number != '')
                    {
                        $memberExtra = new MemberExtra;
                        $memberExtra->type = 'championchip';
                        $memberExtra->value= $number;
                        $memberExtra->member_id = $id;
                        $memberExtra->save();
                        unset($memberExtra);
                    }
                }
                
                foreach($_POST['tracetec'] as $number)
                {
                    if($number != "")
                    {
                        $memberExtra = new MemberExtra;
                        $memberExtra->type = 'tracetec';
                        $memberExtra->value= $number;
                        $memberExtra->member_id = $id;
                        $memberExtra->save();
                        unset($memberExtra);
                    }
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your details has been updated successfully!');
                $this->redirect(array('update','id'=>$member->id));
            }
            
          
		}
        
		$this->render('update',array(
			'model'=>$member,
            'tradinghours'=>$tradinghours,
		));
	}
    public function actionSearch()
    {
        $members = NULL;
        if(isset($_GET['key']))
        {
            $c1 = new CDbCriteria;
            if(isset($_GET['key']))
            {
                $key=trim($_GET['key']);
                $c1->addSearchCondition('fname',$key,true,'OR');
                $c1->addSearchCondition('lname',$key,true,'OR');
                $c1->addSearchCondition('username',$key,true,'OR');
                $c1->addSearchCondition('display_address',$key,true,'OR');
                $c1->addSearchCondition('email',$key,true,'OR');
                $c1->addSearchCondition('detail',$key,true,'OR');
            }
            
         $c1->addCondition('is_verified!=0');
         $c1->with = array ('memberLogin' => array('order'=>'memberLogin.id DESC'));   
           
            $members = Member::model()->findAll($c1);
        }
        $c = new CDbCriteria;
        $c->condition = 'is_verified <> 0';
        $count = Member::model()->count($c);
        //die($count);
        $this->render('search',array(
            'members'=>$members,
            'count'=>$count
        ));
    }
    public function actionUpdatestatus($id)
    {
       $model=$this->loadModel($id);
       $model->scenario = 'updatestatus'; 
       if(isset($_POST['Member']))
       {
             $model->attributes=$_POST['Member'];
             $model->date_updated=date('Y-m-d');
             if(!MemberMember::is_member($model->id))
            {
                echo "<div class='alert alert-block alert-error fade in'><strong>Error</strong> - The Member cannot be activated! Please assign the member type for the Member first!</div>";
                echo '<script type="text/javascript">$(document).ready(function(){ $(".alert-block ").fadeOut(5000); });</script>';
                return;  
            }
            else
            {
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
            MemberViews::model()->deleteAllByAttributes(array('Member_id'=>$id));
            MemberClicks::model()->deleteAllByAttributes(array('Member_id'=>$id));
            //deelte Gallery
            Gallery::model()->deleteAllByAttributes(array('Member_id'=>$id));
            Videos::model()->deleteAllByAttributes(array('Member_id'=>$id));
            //delete products,services and brands
            MemberServices::model()->deleteAllByAttributes(array('Member_id'=>$id));

            //delete brochures
            Brochures::model()->deleteAllByAttributes(array('Member_id'=>$id));

            //delete restaurants info
            Tradinghours::model()->deleteAllByAttributes(array('Member_id'=>$id));
            //delete restaurant
			if($this->loadModel($id)->delete())
            Yii::app()->user->setFlash('success', '<strong>Success - </strong> Member deleted successfully.');
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
            $c1->addSearchCondition('fname',$key,true,'OR');
        }
        $c1->addCondition('fname!=""');
        //$c1->addCondition('isActive!=1');
        if($filter=="") $order='fname ASC';
        if($filter=="newest") $order='id DESC';
        if($filter=="new") { 
            $criteria= new CDbCriteria;
            $criteria->select='Member_id';
            $criteria->group='Member_id';    
            
            $all_id=MemberMember::model()->findAll($criteria);
            $ids=array();
            if($all_id)
            {
                foreach($all_id as $id)
                {
                    $ids[]=$id->Member_id;
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
            $order='fname ASC';
        }
        //else  $c1->addCondition('status=1');
        $c1->order=$order;
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Member',array('criteria'=>$c1, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 15;
            $pages->applyLimit($criteria);
        }
        else
    	$dataProvider=new CActiveDataProvider('Member',array('criteria'=>$c1));
        $criteria = new CDbCriteria;
       
        $criteria->condition = "login_date <> '0000-00-00 00:00:00'";
        $criteria->group = "t.member_id";
        $criteria->order = 't.id DESC';
        $criteria->limit = '21';
        $criteria->with = array ('member');
        $memberLogins = MemberLogin::model()->findAll($criteria);
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'filter' =>$filter,
            'pages'=>$pages,
            'memberlogins' => $memberLogins
		));
	}
     public function actionNewListings()
	{
    	$dataProvider=new CActiveDataProvider('Member',
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
		$model=Member::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='Member-form')
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
                 $file=$folder.$result['filename'];
                 $result['imageFull']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filename'];
                 
                 Yii::import('application.extensions.image.Image');
                 $resize_detail=CommonClass::get_resize_details('Member_logo');
                 if (is_array($resize_detail))
                 {
                    foreach($resize_detail as $resize_item)
                    {
                        //load image library for resizing
                        $image = new Image($file);
                        
                        $image->save($resize_item["new_path"].$result['filename']);
                        $image_new = new Image($resize_item["new_path"].$result['filename']);
                        list($width,$height) = getimagesize($file);
                        
                        if($width > $resize_item["width"])
                        {
                           $image_new->resize($resize_item["width"],$resize_item["height"],Image::WIDTH)->quality(90);
                           $image_new->save(); 
                        }
                         list($new_width,$new_height)=getimagesize($resize_item["new_path"].$result['filename']);
                         if($new_height>$resize_item["height"])
                         {
                             $image_new->resize($new_width,$resize_item["height"],Image::HEIGHT)->quality(90);
                         }
                         $image_new->save($resize_item["new_path"].$result['filename']);
                 } 
                 $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/main/'.$result['filename'];  
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
        if($_POST['fileName']!="")
        {
            Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        	);
        	$imageUrl = Yii::app()->baseUrl.'/images/temp/full/'. $_POST['fileName'];
        	$this->renderPartial('_cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['fileName']), false, true);
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
       $src_file=Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename'];
       $temp_file=Yii::app()->basePath.'/../images/temp/'.$_POST['filename'];
       
       Yii::import('application.extensions.image.Image');
       
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);
       
       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize(120,90);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filename']);
       
       $cropped_image->resize(260,200);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/main/'.$_POST['filename']);
    
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       echo Yii::app()->baseUrl.'/images/temp/main/'.$_POST['filename'].'?id='.rand();
    }  
    
    public function actionServices($id)
	{
	    $model=$this->loadModel($id);
        $services = new MemberServices;
                
	    if($_POST)
        {           
            //for services
            if(isset($_POST['MemberServices']))
            {
                Services::model()->deleteMemberAdditionalServices($id);
                MemberServices::model()->deleteAllByAttributes(array('Member_id'=>$id));
                $services->attributes = $_POST['MemberServices'];
                $comService = $services->service_id;
                for($i=0; $i<count($comService); $i++)
                {
                    $services->isNewRecord = true;
                    $services->primaryKey = NULL;
                    $services->Member_id = $id;
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
                        $additionalModel->service_name = $ser;
                        $additionalModel->additional = 1;
                        if($additionalModel->save(false)){
                            CommonClass::makeSlug($additionalModel, $additionalModel->service_name, $additionalModel->id);
                            $services->isNewRecord = true;
                            $services->primaryKey = NULL;
                            $services->Member_id = $id;
                            $services->service_id = $additionalModel->id;
                            $services->save(false);
                        }
                    }
               }
            }
            Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
        }
		$this->render('application.modules.admin.views.Member.product_service_brand',array(
			'model'=>$model,
            'services'=>$services,
            'MemberId'=>$id,
		));
	} 
    
    public function actionAccounts($id)
    {
        $status = Member::model()->findByPk($id)->status;
        $accounts = Accounts::model()->findByPk(1);
        
        $this->render('accounts',array(
            'status'=>$status,
            'accounts'=>$accounts,
            'Member'=>Member::MemberInfo($id),
        ));
    }
    public function actionLogin($id)
    {
        $model=$this->loadModel($id);
        $model->scenario='editlogin';
        if(isset($_POST['Member']))
        {
           //print_r($_POST['Restaurants']);exit;
            $model->attributes=$_POST['Member'];
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
                $contactModel = new ContactForm('contactMember');
                if(isset($_POST['contactMember']))
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
                        
                        $subject="Message from GoRun";
                        $body = $this->renderPartial('application.views.email.contactMember',array('body'=>$_POST['ContactForm']['body'],'MemberName'=>$model->name),true);
                        CommonClass::sendEmail("","", $model->email, $subject, $body,$admin_email) ;
                        Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> '.$model->name.' has been contacted successfully.'); 
                    }
                    else
                    {
                         Yii::app()->user->setFlash('info', '<strong>ERROR! </strong> '.$model->name.' do not have valid email.');
                    }
                }
                $this->render('contactMember',array('Member'=>$model->name,'model'=>$contactModel));
            }        
        }
    }
    
    public function actionUpdateMemberType($id)
    {
       $model=new MemberMember;
       if(isset($_POST['MemberMember']) && $_POST['MemberMember']['member_id']!="")
       {
            MemberMember::model()->deleteAllByAttributes(array('Member_id'=>$id));
            $model->attributes=$_POST['MemberMember'];
            $comMember = $model->member_id;
            for($i=0; $i<count($comMember); $i++)
            {
                $model->isNewRecord = true;
                $model->primaryKey = NULL;
                $model->Member_id = $id;
                $model->member_id = $comMember[$i];
                $model->save(false);   
                $status=true;
            }
            Yii::app()->user->setFlash('success', 'Member member type saved successfully!');
            $this->redirect(array('Member/update/id/'.$id));
        }
    }
    
    public function actionExport()
    {
        $this->render('export');
    }
    
    public function actionExporttoExcel()
    {
	
        $criteria = new CDbCriteria;
        
        $criteria->select = 'name, contact_person, number, email, fax, website, twitter, facebook, pinterest, google, tagline, detail, display_address, postal_address, street_add, suburb, province, latitude, longitude';

$sql = "SELECT t.*, m.type_name as member_type FROM tbl_Member as t JOIN tbl_Member_member as c ON c.Member_id = t.id JOIN tbl_member_type as m ON m.id = c.member_id";

$DATA = new CSqlDataProvider($sql, array('pagination'=>false));        
/*$DATA = new CActiveDataProvider('Member', array(
    'criteria' => array(
        'select' => array('t.*', 'm.type_name AS member_type'),
        'join' => 'JOIN tbl_Member_member as c ON c.Member_id = t.id JOIN tbl_member_type AS m ON m.id = c.member_id',
    )
));*/
        //$c->condition='event_id='.$eventid;
        //$DATA = new CActiveDataProvider('Member', array('criteria'=>$criteria, 'pagination'=>false));
        //var_dump($DATA);die();
        $this->widget('ext.EExcelView', array(
             'dataProvider'=> $DATA,
             'title'=>"Member Member",
             'autoWidth'=>false,
             //'filename'=>'',
             'stream'=>true,
             //'exportType'=>'Excel5',
             'grid_mode'=>'export',
             'columns'=>array(
                'name',
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