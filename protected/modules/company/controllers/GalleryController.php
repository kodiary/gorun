<?php
class GalleryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

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
			array('allow', // allow authenticated user to perform following actions
				//'actions'=>array('index'),
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
		$model=new Gallery;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ImageId));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gallery']))
		{
			$model->attributes=$_POST['Gallery'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ImageId));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
			$model=$this->loadModel($id);
            $imageFile=$model->name;
            if($model->delete())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS!</strong> Deleted Succcessfully.');
                //delete image file if and only if the image is not a group image i.e image is not shared by other franchises
               if($imageFile!="")
               {
                    $this->deleteImageByType('full',$imageFile);
                    $this->deleteImageByType('thumb',$imageFile);
                    $this->deleteImageByType('main',$imageFile);
               } 
            }
            $this->redirect(Yii::app()->request->urlReferrer);
	}
    
    private function deleteImageByType($type,$image)
    {
        if (Yii::app()->file->set('images/frontend/'.$type.'/'.$image)->exists)
        {
            $file = Yii::app()->file->set('images/frontend/'.$type.'/'.$image, true);
            $file->delete();
            return true;
        }
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
       $id=$id=Yii::app()->user->id;
       $cmodel=Company::model()->findByPk($id);
       	if(!empty($_POST['Gallery']))
		{
            $galleries=$_POST['Gallery'];
            $gallery0=$galleries[0];
            if($gallery0['id']!="") // edit image case
            {
                $model=Gallery::model()->findByPk($gallery0['id']);
                $model->attributes=$gallery0; 
                if($image_name!=$gallery0['name'])
                {
                    if(Yii::app()->file->set('images/temp/full/'.$model->name)->exists)
                    {
                        $full = Yii::app()->file->set('images/temp/full/'.$model->name);
                        $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$model->name);
                        $full->delete();
                    }
                    if(Yii::app()->file->set('images/temp/main/'.$model->name)->exists)
                    {
                        $main = Yii::app()->file->set('images/temp/main/'.$model->name);
                        $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->name);
                        $main->delete();
                    }
                    if(Yii::app()->file->set('images/temp/thumb/'.$model->name)->exists)
                    {
                        $thumb = Yii::app()->file->set('images/temp/thumb/'.$model->name);
                        $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->name);
                        $thumb->delete();
                    } 
                }
                if($model->save())Yii::app()->user->setFlash('success', '<strong>Success - </strong> Successfully saved.');
                unset($galleries[0]); // remove first element from the array
            }
            if($galleries)
            {
    			foreach($galleries as $galleryData) //insert all images to db for corresponding company
    			{
                    $model = new Gallery();
                    $model->attributes=$galleryData;
                    $image_count=$model->getTotalImages($id);
                    if($model->name!="")
                    {
                        if($image_count<=25)
                        {
                            if(Yii::app()->file->set('images/temp/full/'.$model->name)->exists)
                               {
                                    $full = Yii::app()->file->set('images/temp/full/'.$model->name);
                                    $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$model->name);
                                    $full->delete();
                               }
                               if(Yii::app()->file->set('images/temp/main/'.$model->name)->exists)
                               {
                                    $main = Yii::app()->file->set('images/temp/main/'.$model->name);
                                    $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->name);
                                    $main->delete();
                               }
                               if(Yii::app()->file->set('images/temp/thumb/'.$model->name)->exists)
                               {
                                    $thumb = Yii::app()->file->set('images/temp/thumb/'.$model->name);
                                    $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->name);
                                    $thumb->delete();
                               }
                            $model->company_id=$id;
                            $model->display_order=$model->getMaxDisplayOrder($id)+1;
            				if($model->save())
                            {
                                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> Successfully saved.');
                            }
                        }
                        else
                        {
                            Yii::app()->user->setFlash('info', '<strong>Sorry! </strong> A maximum of 25 photos is permitted.');
                        }
                    }
    			}
            }
		}
             
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
         
		$model = new Gallery();
        $dataProvider=new CActiveDataProvider('Gallery');
        $this->render('index',array(
		            'data'=>Gallery::model()->findAll(array('order'=>'display_order', 'condition'=>'company_id='.$id)),
                    'model' => $model,
                    'cmodel'=>$cmodel,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Gallery::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
   	public function actionAddfield($index)
	{
		$model = new Gallery();
		$this->renderPartial('application.modules.admin.views.gallery._form', array(
			'model' => $model,
			'index' => $index,
		));
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
                 $resize_detail=CommonClass::get_resize_details('gallery');
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
    
    function actionCropPhoto()
    {
        if($_POST['fileName']!="")
        {
            Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        	);
        	$imageUrl = Yii::app()->baseUrl.'/images/frontend/full/'. $_POST['fileName'];
        	$this->renderPartial('application.modules.admin.views.gallery._cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['fileName'],'id'=>$_POST['id']), false, true);
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
       $src_file=Yii::app()->basePath.'/../images/frontend/full/'.$_POST['filename'];
       $temp_file=Yii::app()->basePath.'/../images/frontend/'.$_POST['filename'];
       
       Yii::import('application.extensions.image.Image');
       
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);
       
       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize(90,90);
       $cropped_image->save(Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['filename']);
       
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       echo Yii::app()->baseUrl.'/images/frontend/thumb/'.$_POST['filename'].'?id='.rand();
    }
    
    public function actionSortImage()
    {
       if (isset($_GET['item']))
       {
            $items=$_GET['item'];
            if(is_array($items))
            {
              $i = 1;
              foreach ($items as $item) {
                    $model=$this->loadModel($item);
                    $model->display_order = $i;
                    $model->save();
                    $i++;
              }
           	echo '<div class="alert alert-block alert-info fade in"><a data-dismiss="alert" class="close" >&times;</a> Successfully saved.</div>'; 
            }
        } 
    }
    public function actionGetImagebyId()
    {
        $image=Gallery::model()->findByPk($_POST['id']);
        
        $result['image_id']=$image->id;
        $result['image_name']=$image->name;
        if($image->caption!="")$result['caption']=$image->caption;
        if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$image->name))
            $result['image_thumb']=Yii::app()->baseUrl.'/images/frontend/thumb/'.$image->name;
       
        $return=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $return;
    }   
}