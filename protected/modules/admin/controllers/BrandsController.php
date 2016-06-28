<?php

class BrandsController extends Controller
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
	    $model = new Brands;
        if(isset($_POST['Brands']))
		{
			$model->attributes=$_POST['Brands'];
            
            if($id = $_POST['Brands']['id'])
            {
                Brands::model()->updateByPk($id, array('brand_name'=>$model->brand_name));
                CommonClass::makeSlug($model, $model->brand_name, $id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your brand has been successfully updated.');
            }
            else{
                if($model->save()){
                    CommonClass::makeSlug($model, $model->brand_name, $model->id);
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your brand has been successfully added.');
                }
            }
			$this->redirect(array('index'));
		}
                
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional=0';
        $sort = new CSort();
        $sort->attributes = array(
            'alphabetic'=>array(
                'asc'=>'t.brand_name',
                'desc'=>'t.brand_name DESC',
                'label'=>'Alphabetical',
            ),
            'date'=>array(
                'asc'=>'t.id',
                'desc'=>'t.id DESC',
                'label'=>'Date Added'
            ),
        );
        $sort->defaultOrder='t.id desc';
        $sort->applyOrder($criteria);
        
        if(isset($_GET['keyword']))
        {
            $keyword =$_GET['keyword'];
            $criteria->addSearchCondition('brand_name', $keyword, 'OR');
        }
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Brands',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Brands',array('criteria'=>$criteria));
       
		$this->render('index',array(
            'model'=>$model,
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'sort'=>$sort,
		));
	}

    public function actionGetBrand()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                echo Brands::brandVal($id);
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
    
    public function actionDeleteBrand($id)
    {
        if($id){
            Brands::model()->deleteByPk($id);
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your brand has been successfully deleted.');
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
            if($with!="" and $replace!="" && $with!=$replace)
            {
                if(Brands::model()->deleteByPk($replace))
                {
                    $brandlinks=CompanyBrands::model()->findAll('brand_id='.$replace);
                    if($brandlinks)
                    {
                        foreach($brandlinks as $link)
                        {
                            if(!CompanyBrands::model()->exists('brand_id='.$with.' AND company_id='.$link->company_id))
                            {
                                $model=new CompanyBrands();
                                $model->isNewRecord=true;
                                $model->brand_id=$with;
                                $model->company_id=$link->company_id;
                                $model->save();
                            }
                        }
                        CompanyBrands::model()->deleteAll('brand_id='.$replace);
                    }
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your brand has been merged successfully.');
                }
            }
            
            $this->redirect(array('index'));
        }
        $brands=Brands::getAllBrands();
        $additional=Brands::getAdditionalBrands();
        $this->render('retag',array('brands'=>$brands,'additional'=>$additional));
    }
}