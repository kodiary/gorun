<?php

class TagsController extends Controller
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
		  $art = Articles::model()->findAll(array('condition'=>"common_tags LIKE '%$id%'"));
         
            if($art)
            {
                foreach($art as $a)
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
                        
                       Articles::model()->updateByPk($a->id,array('common_tags'=>$tag));
                    }                   
                }
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
	   $model = new Tags;
       if(isset($_POST['Tags']))
		{
			$model->attributes=$_POST['Tags'];
            
            if($id = $_POST['Tags']['id'])
            {
                Tags::model()->updateByPk($id, array('tag'=>$model->tag));
            }
            else{
                $model->save();
                CommonClass::makeSlug($model, $model->tag, $model->id);
            }
                
			$this->redirect(array('index'));
		}
	   $records = Tags::model()->findAll(array('order'=>'id DESC'));
       $this->render('index', array('records'=>$records, 'model'=>$model));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Tags::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionGetTag()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id){
                echo Tags::tagName($id);
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
}