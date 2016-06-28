<?php

class SeoController extends Controller
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
			array('allow',
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
		$model=new Seo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seo']))
		{
			$model->attributes=$_POST['Seo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SeoId));
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
        $model->scenario='update';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Seo']))
		{
			$model->attributes=$_POST['Seo'];
            $model->Updated=date('Y-m-d');
			if($model->save())
            {
               Yii::app()->user->setFlash('success', 'Successfully Saved.');
               $this->redirect(array('index')); 
            }
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Seo',array('pagination'=>false));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Seo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Seo']))
			$model->attributes = $_GET['Seo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Seo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='seo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionUpdateCompany()
    {
        $model=new Company('seo');
        if(isset($_POST['Company']))
        {
            $id=$_POST['Company']['id'];
            if($id!="")
            {
                $model=Company::model()->findByPk($id);
                $model->scenario='seo';
                if($model->seo_title=="")
                {
                    $seo=Company::createSeo($model->name,$model->detail,$model->display_address);
                    $model->seo_title=$seo['title'];
                    $model->seo_desc=$seo['desc'];
                    $model->seo_keywords=$seo['keywords'];
                }
                if(isset($_POST['btnSubmit']))
                {
                    $model->attributes=$_POST['Company'];
                    $model->seo_title=$_POST['Company']['seo_title'];
                    $model->seo_desc=$_POST['Company']['seo_desc'];
                    $model->seo_keywords=$_POST['Company']['seo_keywords'];
                    $model->date_updated=date('Y-m-d');
                    if($model->save())
                    {
                       Yii::app()->user->setFlash('success', '<strong>SUCCESS!</strong> Seo saved successfully.'); 
                    }
                }
            }
        }
        $this->render('companySeo',array('model'=>$model));
    }  
}