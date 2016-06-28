<?php

class AccountsController extends Controller
{
    public $layout = 'column2';
    
    /**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control 
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
			array('allow', // allow authenticated user to perform following actions
				//'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionIndex()
    {
        $id = Yii::app()->user->getId();
        $model = Company::model()->findByPk($id);
        $accounts = Accounts::model()->findByPk(1);
        $contactModel = new ContactForm('contactAdmin');
        
        $this->render('index',array(
            'status'=>$model->status,
            'contactModel'=>$contactModel,
            'company'=>Company::companyInfo($id),
            'model'=>$model,
            'accounts'=>$accounts,
        ));
    }    
        
    public function actionContact()
    {
       	if(isset($_POST['ContactForm']))
		{
			$info = $_POST['ContactForm'];
            $id = Yii::app()->user->getId();

            $record = Company::companyInfo($id);
               
            $companyName = $record->name;
            if($this->sendAccountEmail($info,$companyName,$record->email))
                Yii::app()->user->setFlash('success', '<strong>Success! </strong>Your message has been sent');
            else
               Yii::app()->user->setFlash('error', '<strong>Error! </strong> The email has not been sent.Please try later.'); 
            
            $this->redirect(array('index'));
		}
    }
    
    public function sendAccountEmail($info,$companyName,$replyTo)
    {
        $email = Yii::app()->email;
        $emails = AdminEmail::model()->findByPk(1);
        
        $receivers="";
        if($emails)
        {
            if($emails->email1!="")$receivers.=$emails->email1.",";
            if($emails->email2!="")$receivers.=$emails->email2.",";
            if($emails->email3!="")$receivers.=$emails->email3.",";
            if($emails->email4!="")$receivers.=$emails->email4.",";
            if($emails->email5!="")$receivers.=$emails->email5.",";
        }
        
        if($receivers!="")$receivers=rtrim($receivers,",");
        else $receivers=Yii::app()->params['adminEmail'];

        $email->to=$receivers;
        $email->from = "exsa.co.za <info@exsa.co.za>";
        if($replyTo!="")$email->replyTo = $replyTo;
        $email->subject = 'A company admin wants to contact Accounts';
        $email->view='accounts';
        $email->viewVars=array('info'=>$info,'companyName'=>$companyName);
        if($email->send())return true;
        else return false;
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}