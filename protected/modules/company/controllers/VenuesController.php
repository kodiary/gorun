<?php

class VenuesController extends Controller
{
    public $layout = 'column2';
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
	    $id=Yii::app()->user->getId();
        
	    $model=$this->loadModel($id);

		$this->render('index',array(
			'model'=>$model,
            'companyId'=>$id,
		));
	}
    
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}