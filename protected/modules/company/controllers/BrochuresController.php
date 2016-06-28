<?php
class BrochuresController extends Controller
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
	    $id = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = 'company_id='.$id;
        $criteria->order = 'display_order ASC';
        $dataProvider = Brochures::model()->findAll($criteria);
        
        $this->render('index',array(
        	'dataProvider'=>$dataProvider,
            'company'=>Company::companyInfo($id),
        ));
	}

    public function actionCreate()
    {
        $id = Yii::app()->user->id;
        $model = new Brochures;
        if(isset($id))
        {
            $model = new Brochures;
            if(isset($_POST['Brochures']))
    		{
    			$model->attributes = $_POST['Brochures'];
                $model->detail = nl2br($model->detail);
                $model->date_updated=date('Y-m-d H:i:s');
                $model->display_order = $model->maxDisplayVal($id);
    			if($model->save()){
                    if($model->filename!="")
                    {
                       if(Yii::app()->file->set('documents/temp/'.$model->filename)->exists)
                       {
                            $path = Yii::app()->file->set('documents/temp/'.$model->filename);
                            $path->copy(Yii::app()->basePath.'/../documents/'.$model->filename);
                            @unlink(Yii::app()->basePath.'/../documents/temp/'.$model->filename);
                       }
                    }			 
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Brochure added successfully.');
                    $this->redirect(array('index'));
                }
            }
        }
		$this->render('create',array(
			'model'=>$model,
            'company'=>Company::companyInfo($id)
		));
    }
    
    public function actionUpdate($id='',$bId='')
    {
        if($bId) $model = $this->loadModel($bId);
        if(isset($id) && $model)
        {
            if(isset($_POST['Brochures']))
    		{
                $oldfile = $model->filename;
    			$model->attributes = $_POST['Brochures'];
                $newfile = $model->filename;
                $model->date_updated=date('Y-m-d H:i:s');
                $model->detail = nl2br($model->detail);
                if($oldfile!=$model->filename)
                {
                    $this->actionDeletedoc($model->id);        
                }
    			if($model->save()){
                    if($model->filename!="")
                    {
                       if(Yii::app()->file->set('documents/temp/'.$model->filename)->exists)
                       {
                            $path = Yii::app()->file->set('documents/temp/'.$model->filename);
                            $path->copy(Yii::app()->basePath.'/../documents/'.$model->filename);
                            @unlink(Yii::app()->basePath.'/../documents/temp/'.$model->filename);
                       }
                    }			 
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Brochure updated successfully.');
                    $this->redirect(array('index'));
                }
            }                
        }
        $this->render('update',array(
			'model'=>$model,
            'company'=>Company::companyInfo($id)
		));
    }

    public function actionDeletedoc($id)
	{
		if($id)
		{
		  $model = $this->loadModel($id);
          $filepath = Yii::app()->basePath.'/../documents/';
          if(file_exists($filepath.$model->filename) && $model->filename)
            @unlink($filepath.$model->filename);
                    
		  // we only allow deletion via POST request
		  $model->updateByPk($id,array('filename'=>''));
        }
		else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
		$model = $this->loadModel($id);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Brochures::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='brochure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload()
	{
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
        $folder=Yii::app()->basePath.'/../documents/temp/';// folder to upload file
        $allowedExtensions = array('pdf','doc','docx','jpeg','jpg');
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        if($result['success'])
        {
             $result['fileSize'] = CommonClass::format_file_size(filesize($folder.$result['filename']));//GETTING FILE SIZE
             $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
             echo $return;// it's array
        }
        else
        {
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }  
	}
    
    public function actionDelete($bId='')
    {
        $id = Yii::app()->user->id;
        if(isset($bId) && isset($id))
        {
            $this->actionDeletedoc($bId);
            Brochures::model()->deleteByPk($bId);
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Brochure deleted successfully.');
            $this->redirect(array('index'));
        }
        $this->redirect(array('index'));
    }
    
    public function actionSortbrochures(){
        $ids = $_GET['listitem'];
        if (empty ($ids) || !is_array($ids)){
            die();
        }
        $order = 1;
        foreach ($ids as $id){
            Brochures::model()->updateByPk($id, array('display_order'=>$order));
            $order++;
        }
    
         echo '<div class="alert alert-block alert-success fade in"><a class="close" data-dismiss="alert">&times;</a><strong>SUCCESS!</strong> - The item is sorted now.</div>';
        die();    
    }
}
