<?php

class ServicesController extends Controller
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
	    $model = new Services;
        
        if(isset($_POST['Services']))
		{
			$model->attributes=$_POST['Services'];
            
            if($id = $_POST['Services']['id'])
            {
                Services::model()->updateByPk($id, array('service_name'=>$model->service_name));
                CommonClass::makeSlug($model, $model->service_name, $id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your service has been successfully updated.');
            }
            else{
                $max = Services::getmaxOrder();
                $model->display_order = $max+1;
                
                $model->save();
                CommonClass::makeSlug($model, $model->service_name, $model->id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your service has been successfully added.');
            }
			$this->redirect(array('index'));
		}
                
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional=0';
        
        /*$sort = new CSort();
        $sort->attributes = array(
            'alphabetic'=>array(
                'asc'=>'t.service_name',
                'desc'=>'t.service_name DESC',
                'label'=>'Alphabetical',
            ),
            'date'=>array(
                'asc'=>'t.id',
                'desc'=>'t.id DESC',
                'label'=>'Date Added',
            ),
        );
        $sort->defaultOrder='t.id desc';
        $sort->applyOrder($criteria);
        */
        
        $criteria->order='display_order ASC';
        
        if(isset($_GET['keyword']))
        {
            $keyword =$_GET['keyword'];
            $criteria->addSearchCondition('service_name', $keyword, 'OR');
        }
        $pages='';
        
        $dataProvider= new CActiveDataProvider('Services',array('criteria'=>$criteria));
       
		$this->render('index',array(
            'model'=>$model,
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            //'sort'=>$sort,
		));
	}

    public function actionGetService()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                echo Services::serviceVal($id);
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
    
    public function actionDeleteService($id)
    {
        if($id){
            CompanyServices::model()->deleteAllByAttributes(array('service_id'=>$id));
            Services::model()->deleteByPk($id);
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your service has been successfully deleted.');
            $this->redirect(array('index'));
        }
        $this->redirect(array('index'));
    }
    public function actionRetag()
    {
        if(isset($_POST['submit']))
        {
            $replace=$_POST['replace'];
            $with= $_POST['with'];
            if($with!="" and $replace!="" && $with!=$replace )
            {
                if(Services::model()->deleteByPk($replace))
                {
                    $links=CompanyServices::model()->findAll('service_id='.$replace);
                    $specials=CompanySpecials::model()->findAll('service_id='.$replace);
                    if($specials)
                    {
                        foreach($specials as $special)
                        {
                                $model=CompanySpecials::model()->find('service_id='.$replace.' AND company_id='.$special->company_id);
                                $model->service_id=$with;
                                $model->save();
                        }
                    }
                    if($links)
                    {
                        foreach($links as $link)
                        {
                            if(!CompanyServices::model()->exists('service_id='.$with.' AND company_id='.$link->company_id))
                            {
                                $model=new CompanyServices();
                                $model->isNewRecord=true;
                                $model->service_id=$with;
                                $model->company_id=$link->company_id;
                                $model->save();
                            }
                        }
                        CompanyServices::model()->deleteAll('service_id='.$replace);
                    }
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your service has been merged successfully.');
                }
            }
            
            $this->redirect(array('index'));
        }
        $services=Services::getAll();
        $additional=Services::getAdditional();
        $this->render('retag',array('services'=>$services,'additional'=>$additional));
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
                    $model=Services::model()->findByPk($item);
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