<?php

class FeaturedController extends Controller
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
		$model = new Featured;
        $tempdir = Yii::app()->basePath.'/../images/temp/';
        $realdir = Yii::app()->basePath.'/../images/frontend/';
        $random = time();

            $companyId = $id;
            $redirect = array('index', 'id'=>$id);
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Featured']))
		{
            $comModel = Company::model()->findByPk($companyId);
            $comModel->date_updated = date('Y-m-d H:i:s');
            $comModel->save();
            
			$model->attributes=$_POST['Featured'];
            if($image = $_POST['image']){
                @copy($tempdir.'full/'.$image, $realdir.'full/'.$image);
                @copy($tempdir.'main/'.$image, $realdir.'main/'.$image);
                @unlink($tempdir.'main/'.$image);
                @copy($tempdir.'thumb/'.$image, $realdir.'thumb/'.$image);
                @unlink($tempdir.'thumb/'.$image);
                $model->image = $image;
            }                                

            $model->status = $model->allowMax5display($companyId);
            $model->date_updated = date('Y-m-d');
            $model->display_order = $model->maxDisplayVal($companyId);
            if($model->save()){
                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> Successfully saved.');
                CommonClass::makeSlug($model, $model->title, $model->id);
                $this->redirect($redirect);
            }
		}

		$this->render('create',array(
			'model'=>$model,'company'=>Company::companyInfo($companyId)
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id="", $featId="")
	{
		$model = $this->loadModel($featId);
        $tempdir = Yii::app()->basePath.'/../images/temp/';
        $realdir = Yii::app()->basePath.'/../images/frontend/';
        $random = time();
            
            $companyId = $id;
            $redirect = array('index', 'id'=>$id);
            
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Featured']))
		{
            $comModel = Company::model()->findByPk($companyId);
            $comModel->date_updated = date('Y-m-d H:i:s');
            $comModel->save();
            
			$model->attributes = $_POST['Featured'];
            $model->date_updated = date('Y-m-d');
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
                       
     		if($model->save()){
                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
                $this->redirect($redirect);
            }
	   }
        $this->render('update',array(
    			'model'=>$model, 'company'=>Company::companyInfo($companyId)
    		));
    }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id, $featId)
	{
		if($id)
		{
            $redirect = array('index', 'id'=>$id);
            $featuredModel = $this->loadModel($featId);
            if($featuredModel){
                
                //delete images
                $filepath = Yii::app()->basePath.'/../images/frontend/';
                $temppath = Yii::app()->basePath.'/../images/temp/';
                if(file_exists($filepath.'full/'.$featuredModel->image) && $featuredModel->image)
                    @unlink($filepath.'full/'.$featuredModel->image);                
                if(file_exists($filepath.'main/'.$featuredModel->image) && $featuredModel->image)
                    @unlink($filepath.'main/'.$featuredModel->image);
                if(file_exists($filepath.'thumb/'.$featuredModel->image) && $featuredModel->image)
                    @unlink($filepath.'thumb/'.$featuredModel->image );
                if(file_exists($temppath.'full/'.$featuredModel->image) && $featuredModel->image)
                    @unlink($temppath.'full/'.$featuredModel->image);                    

            }
          
			// we only allow deletion via POST request
			if($this->loadModel($featId)->delete())
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
       $dataProvider = Featured::model()->findAll($criteria);

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
		$model=Featured::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='featured-form')
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
                 $result['imageMain']=Yii::app()->baseUrl.'/images/temp/main/'.$result['filename'];  
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
       
       echo Yii::app()->baseUrl.'/images/temp/main/'.$_POST['filename'].'?id='.rand();
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
                if($model->allowMax5display($model->company_id)){
                    if(Featured::model()->updateByPk($id, array('status'=>1)))
                        echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is active now</div>';  
                }
                else
                    echo '<div class="alert alert-block alert-info fade in"><a class="close" data-dismiss="alert">&times;</a><strong>ERROR! - Only 5 active items allowed.</strong> Deactivate an item to allow this one to be active.</div>';
                
            }
            elseif(isset($_GET['id'], $_GET['switch']) && $_GET['switch']==0)
            {
                if(Featured::model()->updateByPk($id, array('status'=>0)))
                     echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is inactive now</div>'; 
            }
            die();
        }
    }
    
    public function actionSortfeatured(){
        $ids = $_GET['listitem'];
        if (empty ($ids) || !is_array($ids)){
            die();
        }
        $order = 1;
        foreach ($ids as $id){
            Featured::model()->updateByPk($id, array('display_order'=>$order));
            //$this->db->update('tbl_banners', array ('banner_order'=> $order), array ('id'=> $id));
            $order++;
        }
    
         echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is sorted now.</div>';
        die();    
    }
}
