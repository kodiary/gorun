<?php

class SubscribersController extends Controller
{
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
    public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			)
		);
	}
    
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        
        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
            $criteria->addSearchCondition('first_name', $keyword, true, 'OR');
            $criteria->addSearchCondition('last_name', $keyword, true, 'OR');
            $criteria->addSearchCondition('email', $keyword, true, 'OR');
        }

        $criteria->order = 'date_added DESC,t.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Subscribers',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Subscribers',array('criteria'=>$criteria));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
    }
    
    public function actionCreate()
	{
		$model = new Subscribers;
        $subscribersdetail = SubscribersDetail::findBySubscriberId();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscribers']))
		{
			$model->attributes=$_POST['Subscribers'];
            $model->date_added = date('Y-m-d H:i:s');
			if($model->save())
            {
                $id = $model->id;
                if($_POST['subscriber_id'])
                {
                    foreach($_POST['subscriber_id'] as $ids)
                    {
                        $m = new SubscribersDetail;
                        $m->subscriber_id = $id;
                        $m->list_id = $ids;
                        $m->save();
                    }   
				}
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - New Member has been successfully created.');
                $this->redirect(array('index'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'subscribersdetail'=>$subscribersdetail
		));
	}

    function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $subscribersdetail = SubscribersDetail::findBySubscriberId();
        
        if($_POST['Subscribers'])
        {
         	$model->attributes=$_POST['Subscribers'];
			if($model->save())
            {
                SubscribersDetail::deleteallbySubId($id);
                if($_POST['subscriber_id'])
                {
                    foreach($_POST['subscriber_id'] as $ids)
                    {
                        $m = new SubscribersDetail;
                        $m->subscriber_id = $id;
                        $m->list_id = $ids;
                        $m->save();
                    } 
                 }
                 Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Member has been successfully updated.');
                 $this->redirect(array('index'));
            }
        }
         $this->render('update',array('model'=>$model,'subscribersdetail'=>$subscribersdetail));
    }
    
    public function actionDelete($id)
	{
		if($id)
		{
            SubscribersDetail::model()->deleteAllByAttributes(array('subscriber_id'=>$id));
            if($this->loadModel($id)->delete())
                Yii::app()->user->setFlash('success', '<strong>Success - </strong> The member has been successfully deleted.');
            $this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    public function loadModel($id)
	{
		$model=Subscribers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscribers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}