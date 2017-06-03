<?php

class MembertypeController extends Controller
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
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteType($id)
	{
		if($id)
		{
            CompanyMember::model()->deleteAllByAttributes(array('member_id'=>$id));
            $result=$this->loadModel($id)->delete();
            
			if($result)
            {
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The member type was successfully deleted!');
            } 
            else
            {
                Yii::app()->user->setFlash('danger', '<strong>ERROR</strong> - The member type could not be deleted!');
            }
            $this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	   //echo "adad"; die();
	   $model = new MemberType;
       
       if(isset($_POST['MemberType']))
		{
		
            if($id = $_POST['MemberType']['id'])$model=$this->loadModel($id);
            else
            {
                $slug=CommonClass::getSlug($_POST['MemberType']['type_name']);
                $model->slug=$slug;
                $max = MemberType::getmaxOrder();
                $model->display_order = $max+1;
            }
            $model->attributes=$_POST['MemberType'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The member type saved successfully!');
            }
            else
            {
                Yii::app()->user->setFlash('danger', '<strong>ERROR</strong> - The member type could not be saved!');
            }
            $this->redirect(array('index'));
		}
        $pages='';
        $criteria = new CDbCriteria;
        $criteria->order="display_order ASC";
        
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('MemberType',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
        $dataProvider= new CActiveDataProvider('MemberType',array('criteria'=>$criteria));
        
        //$records = MemberType::model()->findAll(array('order'=>'display_order ASC'));
        $this->render('index', array('dataProvider'=>$dataProvider, 'model'=>$model,'pages'=>$pages));

	}
    
        
    public function actionSort()
    {
        
        if (isset($_GET['list'])) {
            $items=$_GET['list'];
            $items=explode(',',$items);
            if(is_array($items))
            {
              $i = 1;
              foreach ($items as $item) {
                    $model=MemberType::model()->findByPk($item);
                    $model->display_order = $i;
                    $model->save();
                    $i++;
              }
           	echo '<div id="successmsg">Successfully saved.</div>';
           	//make the success message disappear slowly
           	echo '<script type="text/javascript">$(document).ready(function(){ $("#successmsg").fadeOut(2000); });</script>';  
            }
        }
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=MemberType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionGetMemberType()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                echo MemberType::typeName($id);
                die();
            }
            else{
                echo '';
                die();
            }
                
        }
    }
}    