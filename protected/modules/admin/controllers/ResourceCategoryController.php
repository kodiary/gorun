<?php

class ResourcecategoryController extends Controller
{
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
	    $model = new ResourceCategory;
        
        if(isset($_POST['ResourceCategory']))
		{
			$model->attributes=$_POST['ResourceCategory'];
            
            if($id = $_POST['ResourceCategory']['id'])
            { 
                $model = ResourceCategory::model()->findByPk($id);
                $model->attributes=$_POST['ResourceCategory'];
                
                $str_tag = '';
                if(!empty($model->member_type)){
                    for($i=0; $i<count($model->member_type); $i++){
    					$str_tag.= $model->member_type[$i].',';
                    }
                }
                $model->member_type = $str_tag;
                if($model->save()){
                    CommonClass::makeSlug($model, $model->title, $id);
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resource category has been successfully updated.');
                }
            }
            else
            {   
                $max = ResourceCategory::getmaxOrder();
                $model->display_order = $max+1;
                
                $str_tag = '';
                if(!empty($model->member_type)){
                    for($i=0; $i<count($model->member_type); $i++){
    					$str_tag.= $model->member_type[$i].',';
                    }
                }
                $model->member_type = $str_tag;
                
                if($model->save()){
                    CommonClass::makeSlug($model, $model->title, $model->id);
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resource category has been successfully added.');    
                }
            }
			$this->redirect(array('index'));
		}
        
        $criteria = new CDbCriteria;   
        $criteria->order='display_order ASC';
        $dataProvider= new CActiveDataProvider('ResourceCategory',array('criteria'=>$criteria));
       
		$this->render('index',array(
            'model'=>$model,
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}

    public function actionGetResourceCategory()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                $model = ResourceCategory::model()->findByPk($id);
                $title = $model->title;
                $member_type = $model->member_type;
                echo json_encode(array(
                    "title" => $title, 
                    "member_type" => $member_type
                ));
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
    
    public function actionDelete($id)
    {
        if($id){
            ResourceCategory::model()->deleteByPk($id);
            //CompanyResources::model()->deleteAllByAttributes(array('resource_id'=>$id));
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The resources has been successfully deleted.');
            $this->redirect(array('index'));
        }
        $this->redirect(array('index'));
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
                    //$model=$this->loadModel($item);
                    $model=ResourceCategory::model()->findByPk($item);
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
}