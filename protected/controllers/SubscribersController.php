<?php

class SubscribersController extends Controller
{
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;

    public function actionIndex()
    {
        $seo=CommonClass::getSeoByPage('generic');
        $this->pageTitle=$seo['title']." - Manage Subscription";      
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        
        $model=new Subscribers('subscribe');
		$this->performAjaxValidation($model);
        
        $this->render('index',array('model'=>$model));
    }

    public function actionAdd()
	{
        $model=new Subscribers('subscribe');
		$this->performAjaxValidation($model);
		if($_POST['Subscribers'])
		{
			$model->attributes=$_POST['Subscribers'];
			$model->date_added = date('Y-m-d');
            $model->subscribe_newsletters = 1;
            
			if($model->save()){
			     Yii::app()->user->setFlash('info', '<strong>Thank You - </strong> You have been added!');
                 //$this->redirect($model->url);
                 $this->redirect(array('success'));
            }	
		}
		$this->render('_add',array('model'=>$model));
	}
    
    public function actionSuccess()
    {
        $seo=CommonClass::getSeoByPage('generic');
        $this->pageTitle=$seo['title']." - Manage Subscription";      
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        
        $model = new Subscribers('subscribe');
        $this->render('index',array('model'=>$model, 'status'=>'success'));
    }
   
    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='addform')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function loadModel($id)
	{
		$model=Subscribers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionSubscription()
    {
        $seo=CommonClass::getSeoByPage('generic');
        $this->pageTitle=$seo['title']." - Manage Subscription";      
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        
        $model = new Subscribers('subscribe');
        $this->performAjaxValidation($model);
       	if(isset($_POST['Subscribers']))
		{
		  $email = $_POST['Subscribers']['email'];
          $status = $_POST['Subscribers']['subscribe_newsletters'];
		  $modelId = Subscribers::model()->findByAttributes(array('email'=>$email))->id;
            
          if(Subscribers::model()->updateByPk($modelId,array('subscribe_newsletters'=>$status))){
                if($status==0) Yii::app()->user->setFlash('info', '<strong>Thank You - </strong> You have been successfully unsubscribed!');
                else if($status==1) Yii::app()->user->setFlash('info', '<strong>Thank You - </strong> You have been successfully subscribed!');
                $updated = 'updated';
                $model = Subscribers::model()->findByAttributes(array('email'=>$email));
          }
        }
      $this->render('index',array('model'=>$model,'email'=>$email,'status'=>$updated));
    }
    
    public function actionManage()
    {
	   $seo=CommonClass::getSeoByPage('generic');
       $this->pageTitle=$seo['title']." - Manage Subscription";      
       $this->metaDesc=$seo['desc'];
       $this->metaKeys=$seo['keys'];
               
        $model=new Subscribers('subscribe');
		$this->performAjaxValidation($model);
        
        if(isset($_POST['Subscribers']))
        {
            $model->attributes=$_POST['Subscribers'];

            $subscriber_email = $_POST['Subscribers']['email'];
            $record = Subscribers::existsSubscriber($subscriber_email);
                if(!$record){ //if new record save it and redirect to manage page
                    $subscriber_email='';
                    Yii::app()->user->setFlash('error', '<strong>Error!</strong> Bad e-mail address - Please try again.');
                }else{
                    $model = Subscribers::model()->findByAttributes(array('email'=>$subscriber_email));
                }
        }
        $this->render('index',array('model'=>$model,'email'=>$subscriber_email));
    }
}