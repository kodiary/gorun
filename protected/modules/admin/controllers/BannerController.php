<?php

class BannerController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin';

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


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

        $model=new Banner('create');
        $random = time();
        $uploaddir=Yii::app()->basePath.DIRECTORY_SEPARATOR.'../images/';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Banner']))
		{
            $model->attributes=$_POST['Banner'];
            if($model->image){
                if(Yii::app()->file->set('images/temp/main/'.$model->image)->exists)
                       {
                            $main = Yii::app()->file->set('images/temp/main/'.$model->image);
                            $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->image);
                            $main->delete();
                       }
            }
            if($model->save())
                $this->redirect(array('index'));        
		
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
        $report_model = new Banner('report');
        $this->performAjaxValidation($report_model);
        $old_image = $model->image;
        $random = time();
        $uploaddir=Yii::app()->basePath.DIRECTORY_SEPARATOR.'../images/';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
            $model->attributes=$_POST['Banner'];
            if($model->image!=$old_image && $model->image){
                if(Yii::app()->file->set('images/temp/main/'.$model->image)->exists)
                       {
                            @unlink($uploaddir.'main/'.$old_image);
                            $main = Yii::app()->file->set('images/temp/main/'.$model->image);
                            $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->image);
                            $main->delete();
                       }
            }
            else{
                $model->image = $old_image;
            }

            if($model->save()){
              if(Yii::app()->user->getState('inactive') == 0)
              $this->redirect(array('index'));
              else
              $this->redirect(array('inactive'));
            }
        }
		$this->render('update',array(
			'model'=>$model,
            'report_model'=>$report_model

		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if($id)
		{
			// we only allow deletion via POST request
            $model = $this->loadModel($id);
            @unlink(Yii::app()->basePath.'/../images/temp/full/'.$model->image);
            @unlink(Yii::app()->basePath.'/../images/frontend/main/'.$model->image);
			$model->delete();
            
            if(Yii::app()->user->getState('inactive') == 0)
              $this->redirect(array('index'));
              else
              $this->redirect(array('inactive'));
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   $criteria = new CDbCriteria;
       Yii::app()->user->setState('inactive',0);
       //$finish_date = 't.'
       $curr_year = (int) Date('Y');
       $curr_month = Date('m');
       //$criteria->addCondition('t.to_month>='.$curr_month.' AND t.to_year>='.$curr_year);
       $criteria->addCondition('(t.to_month>='.$curr_month.' AND t.to_year='.$curr_year.') OR (t.to_year>'.$curr_year.')');
       $criteria->order = 'id DESC';
		$dataProvider=new CActiveDataProvider('Banner',  array('criteria'=>$criteria,
            'pagination'=>array('pageSize'=>15)
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
		$model=Banner::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionUpload($size)
    {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
         $folder=Yii::app()->basePath.'/../images/temp/main/';// folder to upload file
        $allowedExtensions = array("jpg","jpeg",'gif','png', 'swf');
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        if($result['success'])
        {
            $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/main/'.$result['filename'];
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }
    else
        {
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $return;// it's array
        }
    }


    public function actionShowall()
    {
        $criteria = new CDbCriteria;
       //$criteria->select = array('')
       //$criteria->order = 'readcount DESC';
		$dataProvider=new CActiveDataProvider('Banner',
            array('criteria'=>$criteria, 'pagination'=>false,
            )
        );
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionInactive()
    {
       $criteria = new CDbCriteria;
       $curr_year = (int) Date('Y');
       $curr_month = Date('m');
       Yii::app()->user->setState('inactive',1);
       //$criteria->addCondition('t.to_month<'.$curr_month.' AND t.to_year<='.$curr_year);
       $criteria->addCondition('(t.to_month<'.$curr_month.' AND t.to_year='.$curr_year.') OR (t.to_year<'.$curr_year.')');
        $dataProvider=new CActiveDataProvider('Banner',  array('criteria'=>$criteria,
            'pagination'=>array('pageSize'=>15)
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
    }
    
    public function actionReport()
    {
        $model = new Banner('report');
       
        if(isset($_POST['Banner']))
        {
            $model->attributes = $_POST['Banner'];
            $data = $this->loadModel($_POST['banner_id']);
            $subject = 'Banner Report';
            $body = $this->renderPartial('application.views.email.bannerReport', array('name'=>$model->name, 'data'=>$data), true);
            if(CommonClass::sendEmail("","", $model->email, $subject, $body, "info@cruises.co.za"))
                echo 'SUCCESS! The banner report has been successfully sent.';
            else
                echo 'ERROR! The banner report could not be sent.';
            
        }
    }
    public function actionBackground()
    {
        $model=BackgroundBanner::model()->findAll(array('order'=>'id desc'));
        $this->render('background',array('model'=>$model));
    }
    public function actionEditBackground($id)
    {
       $model=BackgroundBanner::model()->findByPk($id);
        if(isset($_POST['BackgroundBanner']))
        {
           $model->attributes = $_POST['BackgroundBanner'];  
           if($model->image)
           {
                $tempdir = Yii::app()->basePath.'/../images/temp/';
                $realdir = Yii::app()->basePath.'/../images/frontend/';
                 if(file_exists($tempdir.'full/'.$model->image)) 
                 {
                    @copy($tempdir.'full/'.$model->image, $realdir.'full/'.$model->image);
                    @unlink($tempdir.'full/'.$model->image);
                 }
                if(file_exists($tempdir.'main/'.$model->image)){
                    @copy($tempdir.'main/'.$model->image, $realdir.'main/'.$model->image);
                    @unlink($tempdir.'main/'.$model->image);
                }
            }
           if($model->save()) Yii::app()->user->setFlash('info', '<strong>SUCCESS</strong> - The background banner saved successfully.');
        }
        $this->render('edit_background',array('model'=>$model)); 
    }
    public function actionAddBackground()
    {
      $model=new BackgroundBanner();
        if(isset($_POST['BackgroundBanner']))
        {
           $model->attributes = $_POST['BackgroundBanner'];  
           if($model->image)
           {
                $tempdir = Yii::app()->basePath.'/../images/temp/';
                $realdir = Yii::app()->basePath.'/../images/frontend/';
                 if(file_exists($tempdir.'full/'.$model->image)) 
                 {
                    @copy($tempdir.'full/'.$model->image, $realdir.'full/'.$model->image);
                    @unlink($tempdir.'full/'.$model->image);
                 }
                if(file_exists($tempdir.'main/'.$model->image)){
                    @copy($tempdir.'main/'.$model->image, $realdir.'main/'.$model->image);
                    @unlink($tempdir.'main/'.$model->image);
                }
            }
           if($model->save()) Yii::app()->user->setFlash('info', '<strong>SUCCESS</strong> - The background banner saved successfully.');
           $this->redirect(array('/admin/banner/background'));
        }
        $this->render('edit_background',array('model'=>$model));   
    }
    public function actionDelBackground($id)
    {
        $model=BackgroundBanner::model()->findByPk($id);
        if($model)
        {
            $realdir = Yii::app()->basePath.'/../images/frontend/';
            if(file_exists($realdir.'full/'.$model->image) && $model->image) 
             {
                @unlink($realdir.'main/'.$model->image);
                @unlink($realdir.'full/'.$model->image);
             }
            if($model->delete())Yii::app()->user->setFlash('info', '<strong>SUCCESS</strong> - The background banner deleted successfully.');
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionUploadbackground()
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
                 $resize_detail=CommonClass::get_resize_details('background_banner');
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
}