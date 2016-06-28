<?php

class CompanyController extends Controller
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
		$model=new Company;
        $model->country = Yii::app()->params['defaultCountryId'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
            if($model->editor_type==0 && $_POST['Company']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Company']['basic_editor']);
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
        $model=new Company('adminSignup');
        if($_POST['Company'])
        {
             $model->attributes=$_POST['Company'];
             $model->slug=CommonClass::getSlug($_POST['Company']['name']);
             $model->date_added=date('Y-m-d');
             $model->date_updated=date('Y-m-d');
             $model->status=0;
             $model->password = sha1($model->password_real);
             if($model->save())
             {
                $_POST['Company']['user_email']=$_POST['Company']['email'];
                $this->notifyCompany($_POST['Company']);
                $this->redirect(array('/admin/company/update/id/'.$model->id));
             }
        }
        $this->render('register',array('model'=>$model));
    }
    
    private function notifyCompany($info)
    {
       $email = Yii::app()->email;
                
        $email->to =  $info['user_email'];
        $email->replyTo="exsa.co.za <noreply@exsa.co.za>";
        $email->from = "exsa.co.za <info@exsa.co.za>";
        $email->subject = 'Welcome to EXSA';
        $email->view='adminNotifyCompany';
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
		$model=$this->loadModel($id);
        $model->scenario="companyInfo";
        $tradinghours=Tradinghours::model()->findByAttributes(array('company_id'=>$id));
        if($tradinghours==null)$tradinghours= new Tradinghours();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if(isset($_POST['Tradinghours']))
		{
		  if($_POST['Company']['opentimes_type']==2)
          {
            $tradinghours->attributes=$_POST['Tradinghours'];
            $tradinghours->company_id=$id;
            $tradinghours->save();
          }
        }
        
		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
            $model->editor_type = $_POST['Company']['editor_type'];
            if($model->editor_type==0 && $_POST['Company']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Company']['basic_editor']);
            }
            $model->slug=CommonClass::getSlug($_POST['Company']['name']);
            if($_POST['logo']!="")
            {
                if(Yii::app()->file->set('images/temp/full/'.$_POST['logo'])->exists)
                {
                    $full = Yii::app()->file->set('images/temp/full/'.$_POST['logo']);
                    $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                }
                if(Yii::app()->file->set('images/temp/main/'.$_POST['logo'])->exists)
                {
                    $main = Yii::app()->file->set('images/temp/main/'.$_POST['logo']);
                    $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                    $main->delete();
                }
                if(Yii::app()->file->set('images/temp/thumb/'.$_POST['logo'])->exists)
                {
                    $thumb1 = Yii::app()->file->set('images/temp/thumb/'.$_POST['logo']);
                    $thumb1->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                    $thumb1->delete();
                }
                $model->logo=$_POST['logo'];
            }
            if($_POST['Company']['opentimes_type']==1)
            {
                $model->opentimes=$_POST['Company']['opentimes'];
            }
            else
            {
                $model->opentimes="";
            }
           $model->date_updated=date('Y-m-d');
           if($model->seo_title=="")$model->seo_title=$model->name." in Directory | EXSA - Exhibition Association of Southern Africa";
           if($model->seo_desc=="")$model->seo_desc=CommonClass::limit_text($model->detail);
            if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
                $this->redirect(array('update','id'=>$model->id));
            }
		}
        
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
		$this->render('update',array(
			'model'=>$model,
            'tradinghours'=>$tradinghours,
		));
	}
    public function actionUpdatestatus($id)
    {
       $model=$this->loadModel($id);
       $model->scenario = 'updatestatus'; 
       if(isset($_POST['Company']))
       {
             $model->attributes=$_POST['Company'];
             $model->date_updated=date('Y-m-d');
             if(!CompanyMember::is_member($model->id))
            {
                echo "<div class='alert alert-block alert-error fade in'><strong>Error</strong> - The company cannot be activated! Please assign the member type for the company first!</div>";
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
            CompanyViews::model()->deleteAllByAttributes(array('company_id'=>$id));
            CompanyClicks::model()->deleteAllByAttributes(array('company_id'=>$id));
            //deelte Gallery
            Gallery::model()->deleteAllByAttributes(array('company_id'=>$id));
            Videos::model()->deleteAllByAttributes(array('company_id'=>$id));
            //delete products,services and brands
            CompanyServices::model()->deleteAllByAttributes(array('company_id'=>$id));

            //delete brochures
            Brochures::model()->deleteAllByAttributes(array('company_id'=>$id));

            //delete restaurants info
            Tradinghours::model()->deleteAllByAttributes(array('company_id'=>$id));
            //delete restaurant
			if($this->loadModel($id)->delete())
            Yii::app()->user->setFlash('success', '<strong>Success - </strong> Company deleted successfully.');
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
            $c1->addSearchCondition('name',$key,true,'OR');
        }
        $c1->addCondition('name!=""');
        //$c1->addCondition('isActive!=1');
        if($filter=="") $order='name ASC';
        if($filter=="newest") $order='id DESC';
        if($filter=="new") { 
            $criteria= new CDbCriteria;
            $criteria->select='company_id';
            $criteria->group='company_id';    
            
            $all_id=CompanyMember::model()->findAll($criteria);
            $ids=array();
            if($all_id)
            {
                foreach($all_id as $id)
                {
                    $ids[]=$id->company_id;
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
            $order='name ASC';
        }
        //else  $c1->addCondition('status=1');
        $c1->order=$order;
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Company',array('criteria'=>$c1, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 15;
            $pages->applyLimit($criteria);
        }
        else
    	$dataProvider=new CActiveDataProvider('Company',array('criteria'=>$c1));
      
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'filter' =>$filter,
            'pages'=>$pages,
		));
	}
     public function actionNewListings()
	{
    	$dataProvider=new CActiveDataProvider('Company',
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
		$model=Company::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='company-form')
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
                 $resize_detail=CommonClass::get_resize_details('company_logo');
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
        $services = new CompanyServices;
                
	    if($_POST)
        {           
            //for services
            if(isset($_POST['CompanyServices']))
            {
                Services::model()->deleteCompanyAdditionalServices($id);
                CompanyServices::model()->deleteAllByAttributes(array('company_id'=>$id));
                $services->attributes = $_POST['CompanyServices'];
                $comService = $services->service_id;
                for($i=0; $i<count($comService); $i++)
                {
                    $services->isNewRecord = true;
                    $services->primaryKey = NULL;
                    $services->company_id = $id;
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
                            $services->company_id = $id;
                            $services->service_id = $additionalModel->id;
                            $services->save(false);
                        }
                    }
               }
            }
            Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
        }
		$this->render('application.modules.admin.views.company.product_service_brand',array(
			'model'=>$model,
            'services'=>$services,
            'companyId'=>$id,
		));
	} 
    
    public function actionAccounts($id)
    {
        $status = Company::model()->findByPk($id)->status;
        $accounts = Accounts::model()->findByPk(1);
        
        $this->render('accounts',array(
            'status'=>$status,
            'accounts'=>$accounts,
            'company'=>Company::companyInfo($id),
        ));
    }
    public function actionLogin($id)
    {
        $model=$this->loadModel($id);
        $model->scenario='editlogin';
        if(isset($_POST['Company']))
        {
           //print_r($_POST['Restaurants']);exit;
            $model->attributes=$_POST['Company'];
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
                $contactModel = new ContactForm('contactCompany');
                if(isset($_POST['contactCompany']))
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
                        $body = $this->renderPartial('application.views.email.contactCompany',array('body'=>$_POST['ContactForm']['body'],'companyName'=>$model->name),true);
                        CommonClass::sendEmail("","", $model->email, $subject, $body,$admin_email) ;
                        Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> '.$model->name.' has been contacted successfully.'); 
                    }
                    else
                    {
                         Yii::app()->user->setFlash('info', '<strong>ERROR! </strong> '.$model->name.' do not have valid email.');
                    }
                }
                $this->render('contactCompany',array('company'=>$model->name,'model'=>$contactModel));
            }        
        }
    }
    
    public function actionUpdateMemberType($id)
    {
       $model=new CompanyMember;
       if(isset($_POST['CompanyMember']) && $_POST['CompanyMember']['member_id']!="")
       {
            CompanyMember::model()->deleteAllByAttributes(array('company_id'=>$id));
            $model->attributes=$_POST['CompanyMember'];
            $comMember = $model->member_id;
            for($i=0; $i<count($comMember); $i++)
            {
                $model->isNewRecord = true;
                $model->primaryKey = NULL;
                $model->company_id = $id;
                $model->member_id = $comMember[$i];
                $model->save(false);   
                $status=true;
            }
            Yii::app()->user->setFlash('success', 'Company member type saved successfully!');
            $this->redirect(array('company/update/id/'.$id));
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

$sql = "SELECT t.*, m.type_name as member_type FROM tbl_company as t JOIN tbl_company_member as c ON c.company_id = t.id JOIN tbl_member_type as m ON m.id = c.member_id";

$DATA = new CSqlDataProvider($sql, array('pagination'=>false));        
/*$DATA = new CActiveDataProvider('Company', array(
    'criteria' => array(
        'select' => array('t.*', 'm.type_name AS member_type'),
        'join' => 'JOIN tbl_company_member as c ON c.company_id = t.id JOIN tbl_member_type AS m ON m.id = c.member_id',
    )
));*/
        //$c->condition='event_id='.$eventid;
        //$DATA = new CActiveDataProvider('Company', array('criteria'=>$criteria, 'pagination'=>false));
        //var_dump($DATA);die();
        $this->widget('ext.EExcelView', array(
             'dataProvider'=> $DATA,
             'title'=>"Company Member",
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