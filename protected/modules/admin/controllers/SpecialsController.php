<?php

class SpecialsController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id="")
	{
		$model = new Specials;
        $specials = new CompanySpecials;
        $tempdir = Yii::app()->basePath.'/../images/temp/';
        $realdir = Yii::app()->basePath.'/../images/frontend/';
        $random = time();

            $companyId = $id;
            $redirect = array('index', 'id'=>$id);
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Specials']))
		{
            $comModel=Company::model()->findByPk($companyId);
            $comModel->date_updated=date('Y-m-d H:i:s');
            $comModel->save();
            
			$model->attributes=$_POST['Specials'];
            $model->expiry_date = date('Y-m-d', strtotime($model->expiry_date));
            if($image = $_POST['image']){
                @copy($tempdir.'full/'.$image, $realdir.'full/'.$image);
                @copy($tempdir.'main/'.$image, $realdir.'main/'.$image);
                @unlink($tempdir.'main/'.$image);
                @copy($tempdir.'thumb/'.$image, $realdir.'thumb/'.$image);
                @unlink($tempdir.'thumb/'.$image);
                $model->image = $image;
            }
            
            
            #for pdf
            $file=CUploadedFile::getInstance($model,'filename');
            if(is_object($file)){
                $model->filename = $random.$file->getName();
            }
            $model->company_id = $companyId;
            $model->status = $model->allowMax3display($companyId);
            $model->display_order = $model->maxDisplayVal($companyId);
            
            if($model->save()){
                //for specials
                if(isset($_POST['CompanySpecials']))
                {
                    $specials->attributes = $_POST['CompanySpecials'];
                    $comSpecialProduct = $specials->product_id;
                    $comSpecialServce = $specials->service_id;
                    
                    for($i=0; $i<count($comSpecialProduct); $i++){
                        $specials->isNewRecord = true;
                        $specials->primaryKey = NULL;
                        $specials->company_id = $id;
                        $specials->special_id = $model->id;
                        $specials->product_id = $comSpecialProduct[$i];
                        $specials->service_id = 0;
                        $specials->save(false);
                    }
                   
                    for($i=0; $i<count($comSpecialServce); $i++){
                        $specials->isNewRecord = true;
                        $specials->primaryKey = NULL;
                        $specials->company_id = $id;
                        $specials->special_id = $model->id;
                        $specials->product_id = 0;
                        $specials->service_id = $comSpecialServce[$i];
                        $specials->save(false);
                    }
                } 
                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> Successfully saved.');
                CommonClass::makeSlug($model, $model->title, $model->id);
                $this->redirect($redirect);
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'company'=>Company::companyInfo($companyId),
            'specials'=>$specials,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id="", $specId="")
	{
	    $specials = new CompanySpecials;
		$model=$this->loadModel($specId);
        $old_file = $model->filename;
        $tempdir = Yii::app()->basePath.'/../images/temp/';
        $realdir = Yii::app()->basePath.'/../images/frontend/';
        $random = time();
            
            $companyId = $id;
            $redirect = array('index', 'id'=>$id);
            
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Specials']))
		{
            $comModel = Company::model()->findByPk($companyId);
            $comModel->date_updated = date('Y-m-d H:i:s');
            $comModel->save();
            
			$model->attributes = $_POST['Specials'];
            $model->expiry_date = date('Y-m-d' ,strtotime($_POST['Specials']['expiry_date']));
            $image = $_POST['image'];
            if($image){
                if(file_exists($tempdir.'full/'.$image)) 
                    @copy($tempdir.'full/'.$image, $realdir.'full/'.$image);
                if(file_exists($tempdir.'main/'.$image)){
                    @copy($tempdir.'main/'.$image, $realdir.'main/'.$image);
                    @unlink($tempdir.'main/'.$image);
                }
                if(file_exists($tempdir.'thumb/'.$image)){
                  @copy($tempdir.'thumb/'.$image, $realdir.'thumb/'.$image);
                    @unlink($tempdir.'thumb/'.$image); 
                }
                $model->image = $image;
            }
                       
            if($_POST['Specials']['filename']!=$old_file)
            {
                $model->filename = $_POST['Specials']['filename'];
                if(file_exists(Yii::app()->basePath.'/../documents/'.$old_file)){
                    @unlink(Yii::app()->basePath.'/../documents/'.$old_file); 
                }
            }
            else{
                $model->filename = $old_file;
            }
            
			if($model->save()){
                //for specials
                if(isset($_POST['CompanySpecials']))
                {
                    CompanySpecials::model()->deleteAllByAttributes(array('company_id'=>$id,'special_id'=>$specId));
                    $specials->attributes = $_POST['CompanySpecials'];
                    $product=$specials->product_id;
                    $service=$specials->service_id;
                   if($product)
                   {
                        $specials->isNewRecord = true;
                        $specials->primaryKey = NULL;
                        $specials->company_id = $id;
                        $specials->special_id = $model->id;
                        $specials->product_id = $product;
                        $specials->service_id = 0;
                        $specials->save(false);
                    }
                   
                   if($service)
                   {
                        $specials->isNewRecord = true;
                        $specials->primaryKey = NULL;
                        $specials->company_id = $id;
                        $specials->special_id = $model->id;
                        $specials->product_id = 0;
                        $specials->service_id = $service;
                        $specials->save(false);
                    }
                } 
			     Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
			     if(is_object($file)){
                    $file->saveAs($realdir.'/'.$model->filename);
                }
                $this->redirect($redirect);
            }
	   }
        $this->render('update',array(
    			'model'=>$model,
                'company'=>Company::companyInfo($companyId),
                'specials'=>$specials,
    		));
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id, $specId)
	{
		if($id)
		{
            $redirect = array('index', 'id'=>$id);
            $specialModel = $this->loadModel($specId);
            if($specialModel){
                
                //delete images
                $filepath = Yii::app()->basePath.'/../images/frontend/';
                $temppath = Yii::app()->basePath.'/../images/temp/';
                if(file_exists($filepath.'full/'.$specialModel->image) && $specialModel->image)
                    @unlink($filepath.'full/'.$specialModel->image);                
                if(file_exists($filepath.'main/'.$specialModel->image) && $specialModel->image)
                    @unlink($filepath.'main/'.$specialModel->image);
                if(file_exists($filepath.'thumb/'.$specialModel->image) && $specialModel->image)
                    @unlink($filepath.'thumb/'.$specialModel->image );
                if(file_exists($temppath.'full/'.$specialModel->image) && $specialModel->image)
                    @unlink($temppath.'full/'.$specialModel->image);                    

                //delete document
                if(file_exists(Yii::app()->basePath.'/../documents/'.$specialModel->filename) && $specialModel->filename)
                    @unlink(Yii::app()->basePath.'/../documents/'.$specialModel->filename);
            }
          
            //deleting related products and services
            CompanySpecials::model()->deleteAllByAttributes(array('company_id'=>$id,'special_id'=>$specId));
            
            // we only allow deletion via POST request
			if($this->loadModel($specId)->delete())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS!</strong> Deleted Succcessfully.');
                $this->redirect($redirect);
            }

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
	   $companyId = $id;
	   $criteria  = new CDbCriteria;
       $criteria->condition = 'company_id='.$companyId;
       $criteria->order = 'display_order ASC';
       $dataProvider = Specials::model()->findAll($criteria);

       $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'company'=>Company::companyInfo($companyId)
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Specials::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='specials-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpload($case)
    {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
     
            $folder=Yii::app()->basePath.'/../images/temp/full/';// folder to upload file
            $allowedExtensions = array("jpg","jpeg",'gif','png');
            $sizeLimit = 200 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            if($result['success'])
            {
                 $file=$folder.$result['filename'];
                 $result['imageFull']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filename'];
                 
                 Yii::import('application.extensions.image.Image');
                 $resize_detail=CommonClass::get_resize_details($case);
                 if (is_array($resize_detail))
                 {
                    foreach($resize_detail as $resize_item)
                    {
                        list($width,$height) = getimagesize($file);
                        list($resize_width,$resize_height)=CommonClass::get_resized_width_height($width, $height,$resize_item);
                        if($width < $resize_item["width"])
                        {
                            $resize_item["crop"]= "false";
                            $resize_width = $width;
                            $resize_height = $height;
                        }
                        //load image library for resizing
                         $image = new Image($file);
                         $image->resize($resize_width,$resize_height)->quality(90);
                         $image->save($resize_item["new_path"].$result['filename']);
                         
                        if($resize_item["crop"]=="true")
                        {
                            switch($resize_item["crop_type"])
                            {
                                case "center":
                                    $top_offset='center';
                                    $left_offset='center';
                                    break;
                                case "top_left":
                                    $top_offset='top';
                                    $left_offset='left';
                                    break;
                            }
                            //load image library for cropping
                             $image = new Image($resize_item["new_path"].$result['filename']);
                             $image->crop($resize_item["width"],$resize_item["height"],$top_offset,$left_offset)->quality(90);
                             $image->save();
                        }
                 } 
                 $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/thumb/'.$result['filename'];  
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
       
       $cropped_image->resize(90,90);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filename']);
       
       $cropped_image->resize(200,200);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/main/'.$_POST['filename']);
       
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       echo Yii::app()->baseUrl.'/images/temp/thumb/'.$_POST['filename'].'?id='.rand();
    }
    
    public function actionClearCroppedImage()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            if($id = $_GET['id'])
            {
                $tempdir = Yii::app()->basePath.'/../images/temp/';
                $realdir = Yii::app()->basePath.'/../images/frontend/';
                $model = $this->loadModel($id);
                if($image = $model->image){
                    @unlink($tempdir.'full/'.$image);
                    @unlink($realdir.'full/'.$image);
                    @unlink($realdir.'main/'.$image);
                    @unlink($realdir.'thumb/'.$image);
                }               
            }
        }
    }
    
    public function actionDisplayOnOff()
    {
        if(Yii::app()->request->isAjaxRequest){
            $id = $_GET['id'];
            $model = $this->loadModel($id);
            if(isset($_GET['id'], $_GET['switch']) && $_GET['switch']==1)
            {
                if($model->allowMax3display($model->company_id)){
                    if(Specials::model()->updateByPk($id, array('status'=>1)))
                        echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is active now</div>';  
                }
                else
                    echo '<div class="alert alert-block alert-info fade in"><a class="close" data-dismiss="alert">&times;</a><strong>ERROR!</strong> - A maximum of 3 active specials allowed</div>';
                
            }
            elseif(isset($_GET['id'], $_GET['switch']) && $_GET['switch']==0)
            {
                if(Specials::model()->updateByPk($id, array('status'=>0)))
                     echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is inactive now</div>'; 
            }
            die();
        }
    }
    
    public function actionSortspecials(){
        $ids = $_GET['listitem'];
        if (empty ($ids) || !is_array($ids)){
            die();
        }
        $order = 1;
        foreach ($ids as $id){
            Specials::model()->updateByPk($id, array('display_order'=>$order));
            //$this->db->update('tbl_banners', array ('banner_order'=> $order), array ('id'=> $id));
            $order++;
        }
    
         echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is sorted now.</div>';
        die();    
    }
    
     ## doc upload
    public function actionUploaddoc()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
            $folder=Yii::app()->basePath.'/../documents/';// folder to upload file
            $allowedExtensions = array("pdf", "doc", "docx");
            $sizeLimit = 200 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            if($result['success'])
            {
                 $result['fileSize']=CommonClass::format_file_size(filesize($folder.$result['filename']));//GETTING FILE SIZE
                 $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                 echo $return;// it's array
            }
            else
            {
                $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $return;// it's array
            }
    }
}
