<?php
class ArticlesController extends Controller
{
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;
    
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
	   if(isset($_GET['slug'])){
	       $slug = $_GET['slug'];
           //update views counter
           $article = Articles::model()->findByAttributes(array('slug'=>$slug));
           if($article){
                $this->metaDesc=$article['seo_desc'];
                $this->metaKeys=$article['keywords'];
                $this->pageTitle=$article['seo_title'];
                $image = ArticleFile::model()->findByAttributes(array('article_id'=>$article->id,'file_type'=>1));
                $audios=ArticleFile::getArtilceFilesByType($article->id,2);
                if($image && file_exists(Yii::app()->basePath.'/../images/articles/photo/thumb/'.$image->filename))
                {
                    $this->pageImage=$this->createAbsoluteUrl('/images/articles/photo/thumb/'.htmlspecialchars($image->filename, ENT_QUOTES));
                }
                Articles::model()->updateByPk($article->id, array('readcount'=>$article->readcount+1));

                $criteria = new CDbCriteria;
                $criteria->with = array('article_file', 'article_source');
                $criteria->condition = 't.slug="'.$slug.'"';
                
                $dataProvider = Articles::model()->find($criteria);
                $this->render('view',array(
                	'model'=>$dataProvider,
                    'audios'=>$audios,
                )); 
           }
          else
            throw new CHttpException(404,'The requested page does not exist.');
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $seo=CommonClass::getSeoByPage('generic');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle="News - ".$seo['title'];
        
        $criteria = new CDbCriteria;
        if(isset($_GET['tag']))
        {
            $tagId = Tags::getIdBySlug($_GET['tag']);
            if($tagId)
            {
                //$criteria->addInCondition('t.id',Articles::getAllArticles(),'AND');
                $criteria->addCondition('is_approved=1 AND visible=1 AND publish_date<=CURDATE()');
                $criteria->addCondition("common_tags REGEXP '({$tagId},)|{$tagId}$'", 'AND');
            }
        }
        $criteria->with = array('articles');
        $criteria->addCondition('is_approved=1 AND visible=1 AND publish_date<=CURDATE()');
        
        if(isset($_GET['company']))
        {
            $company = Company::model()->findByAttributes(array('slug'=>$_GET['company']));
            if($company){
                $criteria->addCondition("company_id=$company->id");
            }
        }
        
        
        if(isset($_GET['keyword']))
        {
            $keyword = $_GET['keyword'];
            $criteria->addSearchCondition('t.title', $keyword, 'OR');
            $criteria->addSearchCondition('t.detail', $keyword, 'OR'); 
        }
        
        if($_GET['order']=='new')
            $criteria->order = 'publish_date DESC,t.id DESC';
        elseif($_GET['order']=='mostread')
            $criteria->order = 'readcount DESC, publish_date DESC';
        elseif($_GET['order']=='alphabetic')
            $criteria->order = 'title ASC,t.id DESC';
        else
            $criteria->order = 'publish_date DESC,t.id DESC';
            
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['articles_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Articles',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['articles_pers_page'])));
            
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
    
    protected function performAjaxValidation($model,$form_id)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']===$form_id)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionDownloads()
    {
        $docslug = $_GET['docslug'];
        $file = 'documents/'.$docslug;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }
    
    public function actionApproval()
    {
        $slug = $_GET['slug'];
        if(isset($slug) && $slug!='')
        {
            $model = Articles::getPendingArticle($slug);
            if(!$model)
            {
        		$status='invalid';
            }
            else
            {
                $status='';
            }
            $this->renderPartial('approval',array('model'=>$model,'status'=>$status),false,true);
        }
    }
    
    public function actionApprove($slug)
    {
        if($slug && $slug!='')
        {
            $article = Articles::get_article_by_slug($slug);
            $id = $article->id;
            $company = Company::companyInfo($article->company_id);
            $company_name = $company->name;
            $company_email = $company->email;
            
            $subject = "The News entitled \"$article->title\" has been approved.";
            $body = $this->renderPartial('application.views.email.adminNewsApproval',array('news_title'=>$article->title, 'posted_date'=>CommonClass::formatDate($article->date_added), 'com_name'=>$company_name, 'news_slug'=>$article->slug),true);
              
            if(Articles::model()->updateByPk($id, array('is_approved'=>1))){
                CommonClass::sendEmail("","", $company_email, $subject, $body);
            }
            $model = $this->loadModel($id);
            $this->renderPartial('approval',array('model'=>$model, 'status'=>'approved'),false,true);
        }
    }
    
    /**
     * the news rejected by admin
    */
    public function actionReject($slug)
    {
        if($slug)
        {
            $article = Articles::get_article_by_slug($slug);
            $id = $article->id;
            $company = Company::companyInfo($article->company_id);
            $company_name = $company->name;
            $company_email = $company->email;
            
            $subject="The News entitled \"$article->title\" is not suitable for publication and has been rejected and deleted.";
            $body = $this->renderPartial('application.views.email.adminNewsRejection',array('news_title'=>$article->title, 'posted_date'=>CommonClass::formatDate($article->date_added), 'com_name'=>$company_name, 'news_slug'=>$article->slug),true);
              
            CommonClass::sendEmail("","", $company_email, $subject, $body);
            
            $this->actionDelete($id);
            $this->renderPartial('approval',array('status'=>'rejected'),false,true);
        }
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
          $this->loadModel($id)->delete();
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
}