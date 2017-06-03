<?php

class ServicesController extends Controller
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
	    //$id=Yii::app()->user->getId();
        
        $id=$_GET['id'];
        //echo $id;die();
	    $model=$this->loadModel($id);
        $services = new CompanyServices;
        
	    if($_POST)
        {
            //for services
            if(isset($_POST['CompanyServices']))
            {
                Services::model()->deleteCompanyAdditionalServices($id);
                CompanyServices::model()->deleteAllByAttributes(array('company_id'=>$id));
                $services->attributes = $_POST['CompanyServices'];
                $comService = $services->service_id;
                for($i=0; $i<count($comService); $i++){
                    $services->isNewRecord = true;
                    $services->primaryKey = NULL;
                    $services->company_id = $id;
                    $services->service_id = $comService[$i];
                    if($services->service_id!=0)
                        $services->save(false);   
               }
               
               if($_POST['hiddenServiceList']){
                    $additionalModel = new Services;
                    $additionalServices = $_POST['hiddenServiceList'];
                    $addedServices = explode(',',$additionalServices);
                    foreach($addedServices as $ser)
                    {
                        $additionalModel->isNewRecord = true;
                        $additionalModel->primaryKey = NULL;
                        $additionalModel->service_name = $ser;
                        $additionalModel->additional = 1;
                        if($additionalModel->save(false)){
                            CommonClass::makeSlug($additionalModel, $additionalModel->service_name, $additionalModel->id);
                            $services->isNewRecord = true;
                            $services->primaryKey = NULL;
                            $services->company_id = $id;
                            $services->service_id = $additionalModel->id;
                            $services->save(false);
                        }
                    }
               }
            }
            Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
        }
		$this->render('index',array(
			'model'=>$model,
            'services'=>$services,
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