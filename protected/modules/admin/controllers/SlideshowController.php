<?php

class SlideshowController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				//'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionAddfield($index)
	{
	   Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
    	);
		$modelImages = new Slideshow();
		$this->renderPartial('_imageform', array(
			'modelImages' => $modelImages,
			'index' => $index,
		), false, true);        
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id='')
	{
	    if($id=='')
            die();
        elseif(Yii::app()->request->isAjaxRequest)
		{
			// we only allow deletion via POST request
            $model = $this->loadModel($id);
            $this->actionDeleteImages($model->image);
			$model->delete();
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $modelImages = array();
        $modelImages = Slideshow::model()->findAll(array('order'=>'display_order ASC'));//new Slideshow();
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        if(isset($_POST['Slideshow']))
        {
            //var_dump($_POST['Slideshow']); die();
            Slideshow::model()->deleteAll();
			foreach($_POST['Slideshow'] as $imageData)
			{
			     
                $modelImages = new Slideshow();
                $modelImages->attributes=$imageData;
                //var_dump($modelImages); die();
                if($modelImages->image!="")
                {
                       if(Yii::app()->file->set('images/temp/full/'.$modelImages->image)->exists)
                       {
                            $full = Yii::app()->file->set('images/temp/full/'.$modelImages->image);
                            $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$modelImages->image);
                            $full->delete();
                       }
                       if(Yii::app()->file->set('images/temp/main/'.$modelImages->image)->exists)
                       {
                            $full = Yii::app()->file->set('images/temp/main/'.$modelImages->image);
                            $full->copy(Yii::app()->basePath.'/../images/frontend/main/'.$modelImages->image);
                            $full->delete();
                       }              
                       if(Yii::app()->file->set('images/temp/thumb/'.$modelImages->image)->exists)
                       {
                            $thumb = Yii::app()->file->set('images/temp/thumb/'.$modelImages->image);
                            $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$modelImages->image);
                            $thumb->delete();
                       }
                    $modelImages->display_order = Slideshow::model()->displayMax();
                    //var_dump($modelImages); 
    				if($modelImages->save())
                    {
                        //echo $modelImages->id;
                        $success = 1;
                        unset($modelImages);
                    }
                        
                }
			}
             if($success==1) Yii::app()->user->setFlash('success', '<strong>Success!</strong> Slider updated successfully.');
             $this->redirect(array('index'));
		}   
		$dataProvider=new CActiveDataProvider('Slideshow');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'modelImages'=>$modelImages,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Slideshow::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionUpload($index)
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
             list($fwidth,$fheight)=getimagesize($folder.$result['filename']);
             if($fwidth<800 || $fheight<340)
                {
                    $result['errorSize']=true;
                    $result['errorMsg']="Image Size Error - You must upload atleast 980x270 image!";
                    $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                    $this->actionDeleteImages($result['filename']);
                    echo $return;// it's array
                    exit;
                } 
             Yii::import('application.extensions.image.Image');
             $resize_detail=CommonClass::get_resize_details('slideshow');
             if(is_array($resize_detail))
             {
                foreach($resize_detail as $resize_item)
                {
                    list($width,$height) = getimagesize($file);
                    if($resize_item['width']=='' && $resize_item['height']=='')
                    {
                        $resize_item['width'] = $width;
                        $resize_item['height'] = $height;
                    }
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
   public function actionCropImg()
    {
        Yii::app()->clientScript->scriptMap=array(
            (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        );
        if(file_exists(Yii::app()->basePath.'/../images/frontend/full/'.$_POST['fileName']))
            $imageUrl = Yii::app()->baseUrl.'/images/frontend/full/'.$_POST['fileName'];
        else
            $imageUrl = Yii::app()->baseUrl.'/images/temp/full/'.$_POST['fileName'];
 
    	//$imageUrl = Yii::app()->baseUrl.'/images/temp/full/'. $_POST['fileName']; 
    	$this->renderPartial('_cropImg', array('imageUrl'=>$imageUrl, 'filename'=>$_POST['fileName'],'index'=>$_POST['index']), false, true);
    }
    
    public function actionCrop()
    {
       $index = $_POST['index'];
       $x=$_POST['cropX'];
       $y=$_POST['cropY'];
       $width=$_POST['cropW'];
       $height=$_POST['cropH'];
       $resize_detail=CommonClass::get_resize_details('slideshow');
       
       if(file_exists(Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename']))
            $src_file = Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename'];
        else
            $src_file = Yii::app()->basePath.'/../images/frontend/full/'.$_POST['filename'];
       //$src_file=Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename'];
       $temp_file=Yii::app()->basePath.'/../images/temp/'.$_POST['filename'];
       //die($src_file);
       Yii::import('application.extensions.image.Image');
      
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);

       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize($resize_detail[0]['width'],$resize_detail[0]['height']);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filename']);
       
       $cropped_image->resize($resize_detail[1]['width'],$resize_detail[1]['height']);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/main/'.$_POST['filename']);
       
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       $response['index'] = $index;
       $response['thumbImage'] = Yii::app()->baseUrl.'/images/temp/thumb/'.$_POST['filename'].'?id='.rand();
       //encode the response as json:
       //echo CJSON::encode($response);
       $return = htmlspecialchars(json_encode($response), ENT_NOQUOTES);
            echo $return;// it's array
            Yii::app()->end();
       
    }
    
    public function actionSortslide()
    {
        $ids = $_GET['remove'];
        if (empty ($ids) || !is_array($ids)){
            die();
        }
        $order = 1;
        if($ids){
            foreach ($ids as $id){
                Slideshow::model()->updateByPk($id, array('display_order'=>$order));
                $order++;
            }
            echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - Sorted successfully.</div>';
            die();
        }
    }
    
    public function actionDeleteImages($image)
    {
        if(isset($image) && $image!=''){
            $realdir = Yii::app()->basePath.'/../images/frontend/';
            $tempdir = Yii::app()->basePath.'/../images/temp/';
            
            if(file_exists($realdir.'full/'.$image))@unlink($realdir.'full/'.$image);
            if(file_exists($realdir.'main/'.$image))@unlink($realdir.'main/'.$image);
            if(file_exists($realdir.'thumb/'.$image))@unlink($realdir.'thumb/'.$image);
            
            if(file_exists($tempdir.'full/'.$image))@unlink($tempdir.'full/'.$image);
            if(file_exists($tempdir.'main/'.$image))@unlink($tempdir.'main/'.$image);
            if(file_exists($tempdir.'thumb/'.$image))@unlink($tempdir.'thumb/'.$image);
        }    
    } 
}