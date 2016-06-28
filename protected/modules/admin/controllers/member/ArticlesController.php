<?php
class ArticlesController extends Controller
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
				//'actions'=>array('index','upload', 'crop','cropImg', 'deleteImage', 'displayOnOff'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        //$companyId = Yii::app()->user->id;
        $companyId = $_GET['id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'company_id='.$companyId;
        $criteria->order = 'publish_date DESC,t.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['articles_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'companyModel'=>Company::model()->findByPk($companyId),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionCreate()
	{
        //$companyId = Yii::app()->user->id;
        $companyId = $_GET['id'];
            
		$model = new Articles;
        $model->company_id = $companyId;
        $model->visible = 1;
        $model->comment_option = 1;
        
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/eajaxupload.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/fileuploader.css"));
        
        $model_image = $this->actionAddImage();
        $model_video = $this->actionAddVideo();
        $model_audio = $this->actionAddAudio();
        $model_document = $this->actionAddDoc();
        
		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
            $str_tag = '';
            if($model->editor_type==0 && $_POST['Articles']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Articles']['basic_editor']);
            }
            $model->publish_date = date('Y-m-d', strtotime($model->publish_date));
            $model->date_added = date('Y-m-d');
            $model->date_updated = date('Y-m-d');
            if($model->seo_title=='') $model->seo_title = CommonClass::getCleanData($model->title,60);
            if($model->seo_desc=='') $model->seo_desc = CommonClass::getCleanData($model->detail,160);
            
            $model->is_approved=1;
            
            if($_POST['Articles']['media_post'])
                $model->media_post = 1;
                
            if($model->save()){
                /*create slug*/
                CommonClass::makeSlug($model, $model->title, $model->id);
                //$this->sendApprovalMail($model->id);
                
                //for article files
                if(isset($_POST['ArticleFile'])){
                    ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$model->id));
                    foreach($_POST['ArticleFile'] as $key=>$val)
                    {
                        $modelFile = new ArticleFile();
                        $modelFile->attributes = $val;
                        if($modelFile->filename!="")
                        {
                            $modelFile->article_id = $model->id;
                            
                            //case for article images
                            if($key>=0 && $key<50)
                            {
                                $modelFile->file_type = 1;
                                if(Yii::app()->file->set('images/temp/full/'.$modelFile->filename)->exists)
                                {
                                    $full = Yii::app()->file->set('images/temp/full/'.$modelFile->filename);
                                    $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$modelFile->filename);
                                    $full->delete();
                                }
                                if(Yii::app()->file->set('images/temp/main/'.$modelFile->filename)->exists)
                                {
                                    $main = Yii::app()->file->set('images/temp/main/'.$modelFile->filename);
                                    $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$modelFile->filename);
                                    $main->delete();
                                }
                                if(Yii::app()->file->set('images/temp/thumb/'.$modelFile->filename)->exists)
                                {
                                    $thumb = Yii::app()->file->set('images/temp/thumb/'.$modelFile->filename);
                                    $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$modelFile->filename);
                                    $thumb->delete();
                                }
                            }
                            
                            //case for article videos
                            elseif($key>=50 && $key<100)
                            {
                                $modelFile->file_type = 3;
                            }
                            
                            //case for article audios
                            elseif($key>=100 && $key<150)
                            {
                                $modelFile->file_type = 2;
                            }
                            
                            //case for article documents
                            elseif($key>=150)
                            {
                                $modelFile->file_type = 4;
                                if(Yii::app()->file->set('documents/temp/'.$modelFile->filename)->exists && $modelFile->filename!='')
                                {
                                    $path = Yii::app()->file->set('documents/temp/'.$modelFile->filename);
                                    $path->copy(Yii::app()->basePath.'/../documents/'.$modelFile->filename);
                                    @unlink(Yii::app()->basePath.'/../documents/temp/'.$modelFile->filename);
                                }
                            }
                            
                            $modelFile->save();
                        }
                    }
                }
                
                $mediaModel = Articles::model()->articleInfo($model->id);
                if($mediaModel->media_post==1 && $mediaModel->visible==1)
                {
                    if($mediaModel->fb_post!=1)
                    {
                        CommonClass::autoPost('articles', $model->id);
                    }
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your news has been submitted and is pending review before going live.');
                $this->redirect(array('index', 'id'=>$companyId));
			}
		}

		$this->render('create',array(
			'model' => $model,
            'model_image' => $model_image,
            'model_video' => $model_video,
            'model_audio' => $model_audio,
            'model_document' => $model_document,
            'companyModel'=>Company::model()->findByPk($companyId),
    	));
	}

	/**
	 * Updates a model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionUpdate($newsid)
	{
        //$companyId = Yii::app()->user->id;
        $companyId = $_GET['id'];

		$model = $this->loadModel($newsid);
        
        if($model)
        {
            Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/eajaxupload.js"));
            Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/fileuploader.css"));
            
            $model_image = $this->actionAddImage($model->id);
            $model_video = $this->actionAddVideo($model->id);
            $model_audio = $this->actionAddAudio($model->id);
            $model_document = $this->actionAddDoc($model->id);
            
            if(!isset($_POST['Articles']))
            {
                if($model->is_approved==0)
                    Yii::app()->user->setFlash('info', '<strong>Please Note - </strong>Your news is <strong>NOT CURRENTLY LIVE</strong> as it has <strong>not been approved</strong> yet.');
            }
        }
        
		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
            $str_tag = '';
            if($model->editor_type==0 && $_POST['Articles']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Articles']['basic_editor']);
            }
            $model->publish_date = date('Y-m-d', strtotime($model->publish_date));
            $model->date_updated = date('Y-m-d');
            if($model->seo_title=='') $model->seo_title = CommonClass::getCleanData($model->title,60);
            if($model->seo_desc=='') $model->seo_desc = CommonClass::getCleanData($model->detail,160);
            
            if($model->save()){
                /*create slug*/
                CommonClass::makeSlug($model, $model->title, $model->id);
                
                //for article files

                $articleModel = ArticleFile::model()->findAllByAttributes(array('article_id'=>$model->id));
                if($articleModel){
                    $earlierImages = array();
                    $earlierAudios = array();
                    $earlierDocuments = array();
                    foreach($articleModel as $checkModel){
                        if($checkModel->file_type = 1) $earlierImages[] = $checkModel->filename;
                        if($checkModel->file_type = 2) $earlierAudios[] = $checkModel->filename;
                        if($checkModel->file_type = 4) $earlierDocuments[] = $checkModel->filename;
                    }
                }
                
                ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$model->id));

                if(isset($_POST['ArticleFile'])){
                    foreach($_POST['ArticleFile'] as $key=>$val)
                    {
                        $modelFile = new ArticleFile();
                        $modelFile->attributes = $val;
                        if($modelFile->filename!="")
                        {
                            $modelFile->article_id = $model->id;
                            
                            //case for article images
                            if($key>=0 && $key<50)
                            {
                                $modelFile->file_type = 1;
                                if(!empty($earlierImages) && in_array($modelFile->filename,$earlierImages))
                                {
                                    if (($key = array_search($modelFile->filename, $earlierImages)) !== false)
                                    {
                                        unset($earlierImages[$key]);
                                    }
                                }
                                else
                                {
                                    if(Yii::app()->file->set('images/temp/full/'.$modelFile->filename)->exists)
                                    {
                                        $full = Yii::app()->file->set('images/temp/full/'.$modelFile->filename);
                                        $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$modelFile->filename);
                                        $full->delete();
                                    }
                                    if(Yii::app()->file->set('images/temp/main/'.$modelFile->filename)->exists)
                                    {
                                        $main = Yii::app()->file->set('images/temp/main/'.$modelFile->filename);
                                        $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$modelFile->filename);
                                        $main->delete();
                                    }
                                    if(Yii::app()->file->set('images/temp/thumb/'.$modelFile->filename)->exists)
                                    {
                                        $thumb = Yii::app()->file->set('images/temp/thumb/'.$modelFile->filename);
                                        $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$modelFile->filename);
                                        $thumb->delete();
                                    }
                                }
                            }
                            
                            //case for article videos
                            elseif($key>=50 && $key<100)
                            {
                                $modelFile->file_type = 3;
                            }
                            
                            //case for article audios
                            elseif($key>=100 && $key<150)
                            {
                                $modelFile->file_type = 2;
                                if(!empty($earlierAudios) && in_array($modelFile->filename,$earlierAudios))
                                {
                                    if (($key = array_search($modelFile->filename, $earlierAudios)) !== false)
                                    {
                                        unset($earlierAudios[$key]);
                                    }
                                }
                            }
                            
                            //case for article documents
                            elseif($key>=150)
                            {
                                $modelFile->file_type = 4;
                                if(!empty($earlierDocuments) && in_array($modelFile->filename,$earlierDocuments))
                                {
                                    if (($key = array_search($modelFile->filename, $earlierDocuments)) !== false) {
                                        unset($earlierDocuments[$key]);
                                    }
                                }
                                else
                                {
                                    if(Yii::app()->file->set('documents/temp/'.$modelFile->filename)->exists && $modelFile->filename!='')
                                    {
                                        $path = Yii::app()->file->set('documents/temp/'.$modelFile->filename);
                                        $path->copy(Yii::app()->basePath.'/../documents/'.$modelFile->filename);
                                        @unlink(Yii::app()->basePath.'/../documents/temp/'.$modelFile->filename);
                                    }                                    
                                }
                            }
                            
                            $modelFile->save();
                        }
                    }
                    
                    //delete earlier images, audios, and documents file
                    if(!empty($earlierImages)){
                        foreach($earlierImages as $val){
                            if(Yii::app()->file->set('images/frontend/full/'.$val)->exists && $val!=''){
                                @unlink(Yii::app()->basePath.'/../images/frontend/full/'.$val);
                            }
                            if(Yii::app()->file->set('images/frontend/main/'.$val)->exists && $val!=''){
                                @unlink(Yii::app()->basePath.'/../images/frontend/main/'.$val);
                            }
                            if(Yii::app()->file->set('images/frontend/thumb/'.$val)->exists && $val!=''){
                                @unlink(Yii::app()->basePath.'/../images/frontend/thumb/'.$val);
                            }
                        }
                    }
                    
                    if(!empty($earlierAudios)){
                        foreach($earlierAudios as $val){
                            if(Yii::app()->file->set('audio/'.$val)->exists && $val!=''){
                                @unlink(Yii::app()->basePath.'/../audio/'.$val);
                            }
                        }
                    }
                    if(!empty($earlierDocuments)){
                         foreach($earlierDocuments as $val){
                            if(Yii::app()->file->set('documents/'.$val)->exists && $val!=''){
                                @unlink(Yii::app()->basePath.'/../documents/'.$val);
                            }
                        }
                    }
                }
                
                $mediaModel = Articles::model()->articleInfo($model->id);
                if($mediaModel->media_post==1 && $mediaModel->visible==1)
                {
                    if($mediaModel->fb_post!=1)
                    {
                        CommonClass::autoPost('articles', $model->id);
                    }
                } 
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your news has been successfully updated.');
                $this->redirect(array('index', 'id'=>$companyId));
			}
		}

		$this->render('update',array(
			'model' => $model,
            'model_image' => $model_image,
            'model_video' => $model_video,
            'model_audio' => $model_audio,
            'model_document' => $model_document,
            'companyModel'=>Company::model()->findByPk($companyId),
    	));
	}
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($newsid)
	{
        $companyId = $_GET['id'];

		$model = $this->loadModel($newsid);
        $id = $model->id;
		if($id)
		{
          ArticleSource::model()->deleteAllByAttributes(array('article_id'=>$id));
          
          # delete images
          $this->actionDeleteImages($id);
		  
          $article_file = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id));
          if($article_file){
            foreach($article_file as $model_file){
                if($model_file->file_type==2){
                    # delete audio
                    if(file_exists(Yii::app()->basePath.'/../audio/'.$model_file->filename) && $model_file->filename)
                    @unlink(Yii::app()->basePath.'/../audio/'.$model_file->filename);
                }
                if($model_file->file_type==4){
                    # delete doc
                    if(file_exists(Yii::app()->basePath.'/../documents/'.$model_file->filename) && $model_file->filename)
                        @unlink(Yii::app()->basePath.'/../documents/'.$model_file->filename);
                    if(file_exists(Yii::app()->basePath.'/../documents/temp/'.$model_file->filename) && $model_file->filename)
                        @unlink(Yii::app()->basePath.'/../documents/temp/'.$model_file->filename);
                }
            }
            ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id));
          }

          if($this->loadModel($id)->delete())
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your article has been successfully deleted.'); 
          $this->redirect(array('index', 'id'=>$companyId));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    /*
    * id is article file id
    * delete aticle image
    */
    public function actionDeleteImages($id)
	{
		if($id)
		{
          $filepath = Yii::app()->basePath.'/../images/frontend/';
          $temppath = Yii::app()->basePath.'/../images/temp/';

		  $article_file = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id));
          if($article_file){
            foreach($article_file as $model_file){
                if($model_file->file_type==1){
                  # delete photo
                  if(file_exists($filepath.'full/'.$model_file->filename) && $model_file->filename)
                    @unlink($filepath.'full/'.$model_file->filename);
                  if(file_exists($filepath.'main/'.$model_file->filename) && $model_file->filename)
                    @unlink($filepath.'main/'.$model_file->filename);  
                  if(file_exists($filepath.'thumb/'.$model_file->filename) && $model_file->filename)
                    @unlink($filepath.'thumb/'.$model_file->filename);
                    
                  if(file_exists($temppath.'full/'.$model_file->filename) && $model_file->filename)
                    @unlink($temppath.'full/'.$model_file->filename);
                  if(file_exists($temppath.'main/'.$model_file->filename) && $model_file->filename)
                    @unlink($temppath.'main/'.$model_file->filename);
                  if(file_exists($temppath.'thumb/'.$model_file->filename) && $model_file->filename)
                    @unlink($temppath.'thumb/'.$model_file->filename); 
                }
            }
          ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id,'file_type'=>1));
          }
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
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
                 $resize_detail=CommonClass::get_resize_details('articles');
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

    # adding the articles image file
    public function actionAddImage($id='')
    {   
        $model_image = array();
        if($id){
            $model_image = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>1));    
        }else{
            $model_image = new ArticleFile;
        }
        
        return $model_image;
    }
    
    function actionCropImg()
    {
        if($_POST['fileName']!="")
        {
            Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        	);
        	$imageUrl = Yii::app()->baseUrl.'/images/frontend/full/'. $_POST['fileName'];
        	$this->renderPartial('_cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['fileName'],'index'=>$_POST['index']), false, true);
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
       $resize_detail=CommonClass::get_resize_details('articles');
       
       Yii::import('application.extensions.image.Image');
       
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);
       
       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize($resize_detail[0]['width'],$resize_detail[0]['height']);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filename']);
       
       $cropped_image->resize($resize_detail[1]['width'],$resize_detail[1]['height']);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename']);
       
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       //echo Yii::app()->baseUrl.'/images/frontend/thumb/'.$_POST['filename'].'?id='.rand();
       echo Yii::app()->baseUrl.'/images/temp/thumb/'.$_POST['filename'];
    }

    public function actionAddVideo($id='')
    {
        $model_video = array();
        if($id){
            $i=50;
            $videoModel = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>3));
            foreach($videoModel as $key=>$val){
                $model_video[$i]=$val;
                $i++;
            }    
        }else{
            $model_video = new ArticleFile;
        }
        return $model_video;
    }
    
    # add multiple video
    public function actionAddVideoField($index)
    {
        $model = new ArticleFile();
		$this->renderPartial('_addvideo', array(
			'model' => $model,
			'index' => $index,
		), false, false);
	}
    
    public function actionUploadAudio()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
        $folder=Yii::app()->basePath.'/../audio/';// folder to upload file
        $allowedExtensions = array("wav", "mp3");
        $sizeLimit = Yii::app()->params['audio_size'] * 1024 * 1024;// maximum file size in bytes
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
    
    # adding the articles audio file
    public function actionAddAudio($id='')
    {
        $model_audio = array();
        if($id){
            $i=100;
            $audioModel = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>2));
            foreach($audioModel as $key=>$val){
                $model_audio[$i]=$val;
                $i++;
            }     
        }else{
            $model_audio = new ArticleFile;
        }
        
        return $model_audio;
    }
    
    # add multiple audio form
    public function actionAddAudiofield($index)
    {
        $model = new ArticleFile();
		$this->renderPartial('_addaudio', array(
			'model' => $model,
			'index' => $index,
		), false, true);
	}

    public function actionUploadDoc()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
        $folder=Yii::app()->basePath.'/../documents/temp/';// folder to upload file
        $allowedExtensions = array('pdf','doc','jpg','jpeg','docx');
        $sizeLimit = Yii::app()->params['doc_size'] * 1024 * 1024;// maximum file size in bytes
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
    
    public function actionAddDoc($id='')
    {
        $model_document = array();
        if($id){
            $i=150;
            $docModel = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>4));
            foreach($docModel as $key=>$val){
                $model_document[$i]=$val;
                $i++;
            }      
        }
        else{
            $model_document = new ArticleFile;
        }
        
        return $model_document;
    }
    
    # add multiple audio form
    public function actionAddDocField($index)
    {
        $model = new ArticleFile();
		$this->renderPartial('_adddoc', array(
			'model' => $model,
			'index' => $index,
		), false, false);
	}
}