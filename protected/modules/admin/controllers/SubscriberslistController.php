<?php

class SubscriberslistController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin';

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				   'users'=>array('@'),
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
		$model=new SubscribersList;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SubscribersList']))
		{
			$model->attributes=$_POST['SubscribersList'];
            $model->permanent = '1';
            $model->date_added = date('Y-m-d H:i:s');
			if($model->save())
            {
                $id = $model->id;
                if($_POST['company'])
                {
                    foreach($_POST['company'] as $c_id)
                    {
                        $com = new SubscribersDetail;
                        $com->company_id = $c_id;
                        $com->list_id = $id;
                        $com->save();
                    }    
                }
                if($_POST['subscriber'])
                {
                    foreach($_POST['subscriber'] as $sid)
                    {
                        $com = new SubscribersDetail;
                        $com->subscriber_id = $sid;
                        $com->list_id = $id;
                        $com->save();
                    }    
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Subscriber List has been successfully created.');
				$this->redirect(array('index'));
            }
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SubscribersList']))
		{
			$model->attributes=$_POST['SubscribersList'];
			if($model->save())
            {
                SubscribersDetail::model()->deleteAllByAttributes(array('list_id'=>$id));
                if($_POST['company'])
                {
                    foreach($_POST['company'] as $c_id)
                    {
                        $com = new SubscribersDetail;
                        $com->company_id = $c_id;
                        $com->list_id = $id;
                        $com->save();
                    }    
                }
                if($_POST['subscriber'])
                {
                    foreach($_POST['subscriber'] as $sid)
                    {
                        $com = new SubscribersDetail;
                        $com->subscriber_id = $sid;
                        $com->list_id = $id;
                        $com->save();
                    }    
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Subscriber List has been successfully updated.');
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
		if($id)
		{
			// we only allow deletion via POST request
            SubscribersDetail::model()->deleteAllByAttributes(array('list_id'=>$id));
			if($this->loadModel($id)->delete())
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Subscriber List has been successfully deleted.');

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        $criteria->order = 'date_added ASC,t.id ASC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('SubscribersList',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('SubscribersList',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SubscribersList::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscribers-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionSearch()
    {
        $criteria = new CDbCriteria;
        if(isset($_GET['keyword']))
        {
            $keyword =$_GET['keyword'];
            $criteria->addSearchCondition('title', $keyword);
        }
        //$criteria->addCondition('t.is_approved=1 AND t.visible=1 AND publish_date<=CURDATE()');
        $criteria->order = 't.id ASC';

        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('SubscribersList',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('SubscribersList',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
       
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
    }
}