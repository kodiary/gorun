<?php

class ResourcesController extends Controller
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
	    $companyId=Yii::app()->user->getId();
 
		$this->render('index',array(
			'model'=>$model,
            'companyId'=>$companyId,
		));
	}
    
    public function actionViewdocs()
    {
        if(isset($_GET['slug']))
        {
            $slug = $_GET['slug'];
            $companyId = Yii::app()->user->getId();
            $resourcesModel = Resources::getResourceByCategorySlug($slug);
            
    		$this->render('viewdocs',array(
                'resourcesModel'=>$resourcesModel,
                'companyId'=>$companyId,
    		));
        }
    }
    
	public function loadModel($id)
	{
		$model=Resources::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}