<?php

class BranchesController extends Controller
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
		$model=new Branches;
        $id=Yii::app()->user->id;
        $model->country = Yii::app()->params['defaultCountryId'];
       	if(isset($_POST['Branches']))
		{
			$model->attributes=$_POST['Branches'];
            $model->slug=CommonClass::getSlug($_POST['Branches']['name']);
            $model->date_updated=date('Y-m-d');
            $model->company_id=$id;
			if($model->save())
            {
           	    Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
                $this->redirect($this->createUrl('/company/branches'));
            }
		}
        
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_branches.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($bid)
	{
		$model=$this->loadModel($bid);
		if(isset($_POST['Branches']))
		{
			$model->attributes=$_POST['Branches'];
            $model->slug=CommonClass::getSlug($_POST['Branches']['name']);
            $model->date_updated=date('Y-m-d');
			if($model->save())
            {
           	    Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
                $this->redirect($this->createUrl('/company/branches'));
            }
		}
        
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_branches.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($bid)
	{
	   if($this->loadModel($bid)->delete())
       Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The branch has been successfully deleted.');
       $this->redirect(Yii::app()->request->getUrlReferrer());
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $id=Yii::app()->user->id;
	    $cmodel=Company::model()->findByPk($id);
		$dataProvider=new CActiveDataProvider('Branches',array( 
            'criteria'=>array(
            'condition'=>'company_id='.$id,
            )));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'cmodel'=>$cmodel,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Branches('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Branches']))
			$model->attributes=$_GET['Branches'];

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
		$model=Branches::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='branches-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
