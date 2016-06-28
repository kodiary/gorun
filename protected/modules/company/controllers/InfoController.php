<?php

class InfoController extends Controller
{
    public $layout = 'column2';
    
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
    
	public function actionIndex()
	{
        $id=Yii::app()->user->getId();
            
        $model=$this->loadModel($id);
        $model->scenario="companyInfo";
        $tradinghours=Tradinghours::model()->findByAttributes(array('company_id'=>$id));
        if($tradinghours==null)$tradinghours= new Tradinghours();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Company']))
		{
			$model->attributes=$_POST['Company'];
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
           $model->detail = nl2br($model->detail);
           if($model->seo_title=="")$model->seo_title=$model->name." in Directory | EXSA - Exhibition Association of Southern Africa";
           if($model->seo_desc=="")$model->seo_desc=CommonClass::limit_text($model->detail);
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
                
            }
		}
        if(isset($_POST['Tradinghours']))
		{
		  if($_POST['Company']['opentimes_type']==2)
          {
            $tradinghours->attributes=$_POST['Tradinghours'];
            $tradinghours->company_id=$id;
            $tradinghours->save();
          }
        }
        
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
		$this->render('index',array(
			'model'=>$model,
            'tradinghours'=>$tradinghours,
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
        	$this->renderPartial('application.modules.admin.views.company._cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['fileName']), false, true);
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
    public function actionGetProvince()
    {
        $country=$_POST['country_id'];
        $code=Countries::model()->findByPk($country)->code;
        $states=Province::getProvinceByCountry($country);
        $select=CHtml::tag('option',array('value'=>''),'Select Province',true);;
        if($states)
        {
            foreach($states as $val)
            {
                 $select.= CHtml::tag('option',array('value'=>$val->id),$val->name,true);
            }
        }
        $return ['states']= $select;
        $return ['code']= $code;
        echo json_encode($return);
    } 
	
}