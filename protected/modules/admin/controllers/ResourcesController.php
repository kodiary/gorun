<?php

class ResourcesController extends Controller
{
    public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform  actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actionIndex()
	{
        $pages='';      
        $criteria = new CDbCriteria;   
        $criteria->order='title ASC';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Resources',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Resources',array('criteria'=>$criteria));
       
        $model = Resources::getAvailableCategories();
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'model'=>$model,
		));
	}

    public function actionCreate()
    {
        $model = new Resources;
        $categoryModel = ResourceCategory::model()->findAll();
        
		if(isset($_POST['Resources']))
		{
			$model->attributes = $_POST['Resources'];
            $model->date_added = date('Y-m-d');
            $model->date_updated = date('Y-m-d');
            
            if($model->filename!='' && Yii::app()->file->set('documents/temp/'.$model->filename)->exists)
            {
                $path = Yii::app()->file->set('documents/temp/'.$model->filename);
                $path->copy(Yii::app()->basePath.'/../documents/'.$model->filename);
                $path->delete();
            }
            
            if($model->save())
            {
                CommonClass::makeSlug($model, $model->title, $model->id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resources has been successfully added.');
                $this->redirect(array('index'));
            }          
        }
        
		$this->render('create',array(
			'model'=>$model,
            'categoryModel'=>$categoryModel
    	));    
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $categoryModel = ResourceCategory::model()->findAll();
        
		if(isset($_POST['Resources']))
		{
			$model->attributes = $_POST['Resources'];
            $model->date_updated = date('Y-m-d');
            
            if($model->filename!='' && Yii::app()->file->set('documents/temp/'.$model->filename)->exists)
            {
                $path = Yii::app()->file->set('documents/temp/'.$model->filename);
                $path->copy(Yii::app()->basePath.'/../documents/'.$model->filename);
                $path->delete();
            }
            
            if($model->save())
            {
                CommonClass::makeSlug($model, $model->title, $model->id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resources has been successfully updated.');
                $this->redirect(array('index'));
            }          
        }
        
		$this->render('update',array(
			'model'=>$model,
            'categoryModel'=>$categoryModel,
            'category'=>ResourceCategory::model()->findByPk($model->cat_id),
    	));    
    }   
    
	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");
 
		$folder=Yii::app()->basePath.'/../documents/temp/';// folder for uploaded files
		$allowedExtensions = array("pdf","doc","docx","txt");//array("jpg","jpeg","gif","exe","mov" and etc...
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

    public function actionDelete($id)
    {
        if($id){
            //CompanyResources::model()->deleteAllByAttributes(array('resource_id'=>$id));
            $this->deleteDocument($id);
            if($this->loadModel($id)->delete())
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resources has been successfully deleted.'); 
            $this->redirect(array('index'));
        }
        $this->redirect(array('index'));
    }
    
    public function deleteDocument($id)
	{
		if($id)
		{
          $filepath = Yii::app()->basePath.'/../document/';
          $temppath = Yii::app()->basePath.'/../document/temp/';

		  $model = $this->loadModel($id);
          if($model){
              if(file_exists($filepath.$model->filename) && $model->filename)
                @unlink($filepath.$model->filename);
                
              if(file_exists($temppath.$model->filename) && $model->filename)
                @unlink($temppath.$model->filename);
          }
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
	public function loadModel($id)
	{
		$model=Resources::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}