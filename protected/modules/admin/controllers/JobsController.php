<?php

class JobsController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
			
				'users'=>array('@'),
			)
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($companyId='')
	{
        $criteria = new CDbCriteria;
        
        if($companyId)
            $criteria->condition='company_id='.$companyId;

        if(isset($_GET['keyword'])){
            $keyword = $_GET['keyword'];
            $criteria->addSearchCondition('t.title', $keyword, true, 'OR');
            $criteria->addSearchCondition('t.desc', $keyword, true, 'OR');
        }
        
        if(isset($_GET['order']))
        {
            if($_GET['order']=='oldest'){
                $criteria->order = 'posted_date ASC,t.id ASC';
            }
            elseif($_GET['order']=='mostread'){
                $criteria->order = 'readcount DESC,t.id DESC';
            }
        }
        else
        {
            $criteria->order = 'posted_date DESC,t.id DESC';            
        }
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'companyId'=>$companyId,
		));
	}

    public function actionCreate()
	{
		$model=new Jobs;
       
		if(isset($_POST['Jobs']))
		{
			$model->attributes=$_POST['Jobs'];
            $companyId = $model->company_id;
            $model->display_order = Jobs::maxDisplayVal($companyId);
            if($model->visible==1)
                $model->visible = Jobs::allowMax3display($companyId);
            $model->posted_date = date('Y-m-d');
            $model->date_updated = date('Y-m-d');
            
            if($model->editor_type==0 && $_POST['Jobs']['basic_editor']!=''){
                $model->desc = nl2br($_POST['Jobs']['basic_editor']);
            }
   			if($model->save()){
			    Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> Successfully saved.');
                $model->slug = CommonClass::makeSlug($model, $model->title, $model->id);
                $this->redirect(array('index', 'companyId'=>$model->company_id));
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
        $companyId = $model->company_id;

		if(isset($_POST['Jobs']))
		{
			$model->attributes=$_POST['Jobs'];
            $companyId = $model->company_id;
            if($model->visible==1)
                $model->visible = Jobs::allowMax3display($companyId);
            $model->date_updated = date('Y-m-d');
            
            if($model->editor_type==0 && $_POST['Jobs']['basic_editor']!=''){
                $model->desc = nl2br($_POST['Jobs']['basic_editor']);
            }
   			if($model->save()){
			    Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> Successfully updated.');
                $model->slug = CommonClass::makeSlug($model, $model->title, $model->id);
                $this->redirect(array('index', 'companyId'=>$model->company_id));
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Jobs::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='jobs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionInactive($companyId='')
    {
        $criteria = new CDbCriteria;
        $criteria->condition= 'visible = 0';
        if($companyId)
            $criteria->addCondition('company_id='.$companyId);

        if(isset($_GET['order']))
        {
            if($_GET['order']=='oldest'){
                $criteria->order = 'posted_date ASC,t.id ASC';
            }
            elseif($_GET['order']=='mostread'){
                $criteria->order = 'readcount DESC,t.id DESC';
            }
        }
        else
        {
            $criteria->order = 'posted_date DESC,t.id DESC';            
        }
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Jobs',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));
            
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'companyId'=>$companyId,
            'inactive'=>'1',
		));
    }
}