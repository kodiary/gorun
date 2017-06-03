<?php
class AccountsController extends Controller
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

        
	public function actionIndex()
	{
        $model = Accounts::model()->findByPk(1);
		if(!$model) $model = new Accounts;

		if(isset($_POST['Accounts']))
		{
            $oldfile = $model->filename;
			$model->attributes = $_POST['Accounts'];
            $newfile = $model->filename;
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
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your account detail has been successfully updated.');
                $this->redirect(array('index'));
            }
        }

		$this->render('index',array(
			'model'=>$model,
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
		$model=Accounts::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='accounts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionUpload()
	{
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
        $folder=Yii::app()->basePath.'/../documents/temp/';// folder to upload file
        $allowedExtensions = array('pdf','doc','docx');
        $sizeLimit = Yii::app()->params['image_size'] * 1024 * 1024;// maximum file size in bytes
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
}