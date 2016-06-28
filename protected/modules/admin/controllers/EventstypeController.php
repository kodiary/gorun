<?php

class EventstypeController extends Controller
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
	public function actionDelete($id)
	{
		if($id)
		{
		  $events = EventsLink::model()->findAll(array('condition'=>"type_id LIKE '%$id%'"));
         
            if($events)
            {
                Yii::app()->user->setFlash('warning', '<strong>WARNING</strong> - Cannot delete! This Event Type is selected by other event.');

                $this->redirect(array('index'));
               /* foreach($art as $a)
                {

                    $tag_ids = explode(',',$a->common_tags);
                    $size = count($tag_ids);
                    $tag = '';
                    for($i = 0; $i<$size;$i++)
                    {
                        if($tag_ids[$i] != $id && $tag_ids[$i]!='')
                        {
                            $tag = $tag.$tag_ids[$i].',';
                        }                        
                        
                       EventsLink::model()->updateByPk($a->id,array('common_tags'=>$tag));
                    }                   
                }*/
                //exit();
            }
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
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
	   $model = new EventsType;
       
       if(isset($_POST['EventsType']))
		{
			$model->attributes=$_POST['EventsType'];
            
            if($id = $_POST['EventsType']['id'])
            {
                EventsType::model()->updateByPk($id, array('title'=>$model->title));
            }
            else
            {
               
                $max = EventsType::getmaxOrder();
                $model->order_by = $max+1;
                $model->save();
                //CommonClass::makeSlug($model, $model->title, $model->id);
            }
                
			$this->redirect(array('index'));
		}
	   $records = EventsType::model()->findAll(array('order'=>'order_by ASC'));
       $this->render('index', array('records'=>$records, 'model'=>$model));
        
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
                    $model=$this->loadModel($item);
                    $model->order_by = $i;
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
		$model=EventsType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionGettitle()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                echo EventsType::titleName($id);
                die();
            }
            else{
                echo '';
                die();
            }
                
        }
    }
}    