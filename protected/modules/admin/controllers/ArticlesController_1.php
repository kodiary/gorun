<?php

class ArticlesController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			)
		);
	}
    
	/**
	 * Lists all models.
	 */
	public function actionIndex($companyId='')
	{
        $criteria = new CDbCriteria;
        
        $criteria->condition = 'visible=1';
        
        if($companyId)
            $criteria->addCondition('company_id='.$companyId);
            
        $criteria->order = 'publish_date DESC,t.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Articles;
        $model->visible = 1;
        $model->comment_option = 1;
        $model_source = new ArticleSource;
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
            $str_tag = '';
			$keywords = '';
            if(!empty($model->common_tags)){
                for($i=0; $i<count($model->common_tags); $i++){
					$str_tag.= $model->common_tags[$i].',';
					$tag_id = $model->common_tags[$i];
					$tag_name = Tags::model()->findByPk($tag_id);
					$keywords .= $tag_name->tag.',';
                }
            }
			$model->keywords = $keywords;
            $model->common_tags = $str_tag;
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
    			/* save the news images*/
                if(isset($_POST['ArticleSource']))
                {
        			foreach($_POST['ArticleSource'] as $sourceData)
        			{
                        $source = new ArticleSource();
                        $source->attributes=$sourceData;
                        $source->article_id = $model->id;
                        
                        if($source->source_name!='' && $source->source_link!='' && $source->article_id)
                            $source->save();
        			}
                }
			 // Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your article has been successfully submitted.');
             $this->redirect(array('addPhotos', 'id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
            'model_source'=>$model_source
    	));
    }

    # adding the articles image file
    public function actionAddPhotos($id='')
    {   
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/eajaxupload.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/multipleupload/fileuploader.css"));
        $model_image = array();
        if($id){
            $model_image = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>1));    
        }else{
            $model_image = new ArticleFile;
        }
        
        if(isset($_POST['ArticleFile'])){
            ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id, 'file_type'=>1));
            foreach($_POST['ArticleFile'] as $imageData)
			{
                $modelImages = new ArticleFile();
                $modelImages->attributes=$imageData;
                
                if($modelImages->filename!="")
                {
                    if(Yii::app()->file->set('images/temp/full/'.$modelImages->filename)->exists)
                       {
                            $full = Yii::app()->file->set('images/temp/full/'.$modelImages->filename);
                            $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$modelImages->filename);
                       }
                      
                       if(Yii::app()->file->set('images/temp/thumb/'.$modelImages->filename)->exists)
                       {
						    $thumb = Yii::app()->file->set('images/temp/thumb/'.$modelImages->filename);
                            $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$modelImages->filename);
                            $thumb->delete();
                       }
                    $modelImages->article_id=$id;
                    $modelImages->file_type = 1;
    				$modelImages->save();
                }
			}

            $mediaModel = Articles::model()->articleInfo($id);
            if($mediaModel->media_post==1 && $mediaModel->visible==1)
            {
                if($mediaModel->fb_post!=1)
                {
                    CommonClass::autoPost('articles', $id);
                    $this->redirect(array('addphotos','id'=>$id));
                }
                else
                {
                    $this->redirect(array('addaudio', 'id'=>$id));
                }
                
            }
            else
            {
                $this->redirect(array('addaudio', 'id'=>$id));
            }
        }
        
        $this->render('_addimage',array('model_image'=>$model_image));
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

    # saving the articles audio file
    public function actionAddAudio($id)
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        $model = array();
        $model = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>2));
        if(isset($_POST['ArticleFile'])){
            ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id, 'file_type'=>2));
			foreach($_POST['ArticleFile'] as $audioData)
			{
                $model = new ArticleFile();
                $model->attributes=$audioData;
                if($model->filename!="")
                {
                    $model->file_type = 2;
                    $model->article_id =$id;
                    $model->save();
                }
            }
            $this->redirect(array('addVideo', 'id'=>$id));   
        }
        $this->render('audioform', array('model'=>$model));
    }
    
    # add multiple audio form
    public function actionAddAudioField($index)
    {
        $model = new ArticleFile();
		$this->renderPartial('_addaudio', array(
			'model' => $model,
			'index' => $index,
		), false, false);
	}
        
    public function actionAddVideo($id)
    {
        $model = array();
        $model = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>3));
        if(isset($_POST['ArticleFile'])){
            ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id, 'file_type'=>3));
			foreach($_POST['ArticleFile'] as $videoData)
			{
                $model = new ArticleFile();
                $model->attributes=$videoData;
                if($model->filename!="")
                {
                    $model->file_type = 3;
                    $model->article_id =$id;
                    $model->save();
                }
            }
            $this->redirect(array('addDoc', 'id'=>$id));   
        }
        $this->render('videoform', array('model'=>$model));
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
    
    public function actionAddDoc($id)
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        $model = array();
        $model = ArticleFile::model()->findAllByAttributes(array('article_id'=>$id, 'file_type'=>4));
        if(isset($_POST['ArticleFile'])){
            ArticleFile::model()->deleteAllByAttributes(array('article_id'=>$id, 'file_type'=>4));
			foreach($_POST['ArticleFile'] as $docData)
			{
			    $model = new ArticleFile();
                $model->attributes = $docData;
                
                if(Yii::app()->file->set('documents/temp/'.$model->filename)->exists && $model->filename!='')
                {
                    $path = Yii::app()->file->set('documents/temp/'.$model->filename);
                    $path->copy(Yii::app()->basePath.'/../documents/'.$model->filename);
                    @unlink(Yii::app()->basePath.'/../documents/temp/'.$model->filename);
                }
                
                if($model->filename!="")
                {
                    $model->file_type = 4;
                    $model->article_id = $id;
                    $model->save();
                }
            }
            $this->redirect(array('seo', 'id'=>$id));   
        }
        $this->render('docform', array('model'=>$model));
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
    
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
            $keywords = '';
            if(!empty($model->common_tags)){
                for($i=0; $i<count($model->common_tags); $i++){
					$str_tag.= $model->common_tags[$i].',';
					$tag_id = $model->common_tags[$i];
					$tag_name = Tags::model()->findByPk($tag_id);
					$keywords .= $tag_name->tag.',';
                }
            }
            $model->common_tags = $str_tag;
            if($model->editor_type==0 && $_POST['Articles']['basic_editor']!=''){
                $model->detail = nl2br($_POST['Articles']['basic_editor']);
            }
            $model->publish_date = date('Y-m-d', strtotime($model->publish_date));
            $model->date_updated = date('Y-m-d');
            $model->is_approved=1;
            
            if($model->save()){
                CommonClass::makeSlug($model, $model->title, $model->id);
                if(isset($_POST['ArticleSource']))
                {
                    //delete the previous data before updating
                    ArticleSource::model()->deleteAllByAttributes(array('article_id'=>$id));
        			foreach($_POST['ArticleSource'] as $sourceData)
        			{
                        $source = new ArticleSource();
                        $source->attributes=$sourceData;
                        $source->article_id = $model->id;
                        
                        if($source->source_name!='' && $source->source_link!='' && $source->article_id)
                            $source->save();
        			}
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your article has been successfully updated.');
			}
		}
        $model->common_tags = explode(',',$model->common_tags);
        $article_source = ArticleSource::model()->findAllByAttributes(array('article_id'=>$id));
        $model_source = new ArticleSource;
		$this->render('update',array(
			'model'=>$model,
            'source'=>$article_source,
            'model_source'=>$model_source
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
          $this->redirect(array('index'));
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
    
    public function actionDeleteImage($id)
	{
		if($id)
		{
		  $model = ArticleFile::model()->findByPk($id);
          $filepath = Yii::app()->basePath.'/../images/frontend/';
          $temppath = Yii::app()->basePath.'/../images/temp/';
          # delete photo
          if(file_exists($filepath.'full/'.$model->filename) && $model->filename)
            @unlink($filepath.'full/'.$model->filename);
          if(file_exists($filepath.'main/'.$model->filename) && $model->filename)
            @unlink($filepath.'main/'.$model->filename);  
          if(file_exists($filepath.'thumb/'.$model->filename) && $model->filename)
            @unlink($filepath.'thumb/'.$model->filename);
            
          if(file_exists($temppath.'full/'.$model->filename) && $model->filename)
            @unlink($temppath.'full/'.$model->filename);
          if(file_exists($temppath.'main/'.$model->filename) && $model->filename)
            @unlink($temppath.'main/'.$model->filename);
          if(file_exists($temppath.'thumb/'.$model->filename) && $model->filename)
            @unlink($temppath.'thumb/'.$model->filename);
          
		  // we only allow deletion via POST request
		  $model->delete();
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    public function actionDeleteVideo($id)
    {
        if($id){
            ArticleFile::model()->deleteByPk($id);
            //$this->redirect(Yii::app()->request->getUrlReferrer());
        }
    }

    public function actionApprove($id)
    {
        if($id)
        {
            $article = Articles::get_articles_by_id($id);
            $company = Company::companyInfo($article->company_id);
            $company_name = $company->name;
            $company_email = $company->email;
            
            $subject = "The News entitled \"$article->title\" has been approved.";
            $body = $this->renderPartial('application.views.email.adminNewsApproval',array('news_title'=>$article->title, 'posted_date'=>CommonClass::formatDate($article->date_added), 'com_name'=>$company_name, 'news_slug'=>$article->slug),true);
              
            if(Articles::model()->updateByPk($id, array('is_approved'=>1))){
                CommonClass::sendEmail("","", $company_email, $subject, $body);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The article is successfully approved and is live now.');
            }
            
            $mediaModel = Articles::model()->articleInfo($id);
            if($mediaModel->media_post==1 && $mediaModel->visible==1)
            {
                if($mediaModel->fb_post!=1)
                {
                    CommonClass::autoPost('articles', $id);
                }
            }
            $this->redirect(array('index'));
        }
    }
    
    /**
     * the news rejected by admin
    
    */
    public function actionReject($id)
    {
        if($id)
        {
            $article = Articles::get_articles_by_id($id);
            $company = Company::companyInfo($article->company_id);
            $company_name = $company->name;
            $company_email = $company->email;
            
            $subject="The News entitled \"$article->title\" is not suitable for publication and has been rejected and deleted.";
            $body = $this->renderPartial('application.views.email.adminNewsRejection',array('news_title'=>$article->title, 'posted_date'=>CommonClass::formatDate($article->date_added), 'com_name'=>$company_name, 'news_slug'=>$article->slug),true);
              
            CommonClass::sendEmail("","", $company_email, $subject, $body);
            
            $this->actionDelete($id);
        }

    }
    
    public function actionInactive()
	{	   
        $criteria = new CDbCriteria;
        if(isset($_GET['companyId']) && $_GET['companyId']!=''){
            $companyId =$_GET['companyId'];
            $criteria->condition='company_id='.$_GET['companyId'];
        }
        else
        $companyId='';
        
        $criteria->with= array('articles'=>array('select'=>'name'));
        $criteria->condition='visible=0';
        $criteria->order = 'publish_date DESC,t.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}
    
    public function actionApproval()
	{	   
        $criteria = new CDbCriteria;
        if(isset($_GET['companyId']) && $_GET['companyId']!=''){
            $companyId =$_GET['companyId'];
            $criteria->condition='company_id='.$_GET['companyId'];
        }
        else
        $companyId='';
        
        $criteria->with= array('articles'=>array('select'=>'name'));
        $criteria->condition='is_approved=0';
        $criteria->order = 'publish_date DESC,t.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
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
    
    public function actionAddSource($index)
	{
		$source = new ArticleSource();
		$this->renderPartial('_addsource', array(
			'source' => $source,
			'index' => $index,
		), false, true);
	}
    
    public function actionUpload()
    {
            ini_set("memory_limit", "1024M");
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
    
    public function actionAddPhotoField($index)
	{
	    Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
    	);
		$modelImages = new ArticleFile();
		$this->renderPartial('_imageform', array(
			'modelImages' => $modelImages,
			'index' => $index,
		), false, true);
	}
    
    public function actionSeo($id)
    {
        if(!$model=$this->loadModel($id))
            $model = new Articles;
            
        if(isset($_POST['Articles'])){
            $model->attributes = $_POST['Articles'];
            $model->updateByPk($id, array('seo_title'=>$model->seo_title, 'seo_desc'=>$model->seo_desc,'keywords'=>$model->keywords));
            $this->redirect(array('preview','id'=>$id));
        }
        $this->render('seo', array('model'=>$model));
    }
    
    public function actionPreview($id)
    {
    	   $criteria = new CDbCriteria;
           $criteria->with = array('article_file', 'article_source');
           $criteria->condition = 't.id="'.$id.'"'; 
           $dataProvider = Articles::model()->find($criteria);
    	   $this->render('preview',array(
    			'model'=>$dataProvider,
    		));
    }
    
    public function actionSearch()
    {
        $criteria = new CDbCriteria;
        if(isset($_GET['keyword']))
        {
            $keyword =$_GET['keyword'];
            $criteria->addSearchCondition('t.title', $keyword, 'OR');
            $criteria->addSearchCondition('t.detail', $keyword, 'OR'); 
        }
        //$criteria->addCondition('t.is_approved=1 AND t.visible=1 AND publish_date<=CURDATE()');
        $criteria->order = 't.id DESC';

        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
       
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
    }

    public function actionComments($id)
    {
        $model = $this->loadModel($id);
        if(isset($_POST['Articles']))
        {
            $model->attributes=$_POST['Articles'];
            if($model->save(false))
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your article has been successfully updated.');
        }
        $this->render('comments',array('model'=>$model));
    }
        
    public function actionGetFbCode()
    {
        $app_id = Yii::app()->params['fb_app_id'];
        $app_secret = Yii::app()->params['fb_secret_id'];
        
        //step1
        if(!isset($_GET['code']) && !isset($_GET['client_id']) && !isset($_GET['client_secret'])){
            $graph_url = "https://graph.facebook.com/oauth/authorize?"
                . "client_id=". $app_id
                . "&scope=manage_pages"
                . "&redirect_uri=".$this->createAbsoluteUrl('/admin/articles/getfbcode');
            Yii::app()->request->redirect($graph_url);
        }
       
        //step2
        if(isset($_GET['code']) && $_GET['code']!='' && !isset($_GET['client_secret'])){
            $code = $_GET['code'];
            $graph_url = "https://graph.facebook.com/oauth/access_token?"
                . "client_id=". $app_id
                . "&client_secret=".$app_secret
                . "&code=".$code
                . "&redirect_uri=".$this->createAbsoluteUrl('/admin/articles/getfbcode');
            Yii::app()->request->redirect($graph_url);
        }
     
        //step3
        //https://developers.facebook.com/tools/explorer/APP_ID/?method=GET&path=me%2Faccounts%2F
        
        //step4
        //here value for fb exchange token is PAGE ACCESS TOKEN that user poses
        if(isset($_GET['client_id']) && isset($_GET['client_secret']) && isset($_GET['code'])){
            $graph_url = "https://graph.facebook.com/oauth/access_token?"
                    . "client_id=". $app_id
                    . "&client_secret=".$app_secret
                    . "&grant_type=fb_exchange_token"
                    . "&fb_exchange_token=CAAElqmTrGf4BAO3unUGEgP73ZA0J7e6KJeVAVCx1Dsa4aZCqjP6zBWopBuwlgTsVe2RYixd9XIM9ZCEQNr6XBGl0ZB56CFj3GbDfugBbnO0DKXWlAXYB8MsYTtdrCLT6Ap9Thiq0fffzsjKcP8SLHQEfxZA9ksPXBJyqF53zYFr2yH9NHGMfCRMQijwOPlXO7PhnGCXJLMAZDZD";
            Yii::app()->request->redirect($graph_url);
        }
    }
}