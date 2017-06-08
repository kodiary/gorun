<?php

class ProductsController extends Controller
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
	    $model = new Products;
        
        if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
            
            if($id = $_POST['Products']['id'])
            {
                Products::model()->updateByPk($id, array('product_name'=>$model->product_name));
                CommonClass::makeSlug($model, $model->product_name, $id);
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your product has been successfully updated.');
            }
            else{
                if($model->save()){
                    CommonClass::makeSlug($model, $model->product_name, $model->id);
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your product has been successfully added.');
                }
            }
			$this->redirect(array('index'));
		}
                
        $criteria = new CDbCriteria;
        $criteria->condition = 't.additional=0';
        $sort = new CSort();
        $sort->attributes = array(
            'alphabetic'=>array(
                'asc'=>'t.product_name',
                'desc'=>'t.product_name DESC',
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
        
        if(isset($_GET['keyword']))
        {
            $keyword =$_GET['keyword'];
            $criteria->addSearchCondition('product_name', $keyword, 'OR');
        }
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Products',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Products',array('criteria'=>$criteria));
       
		$this->render('index',array(
            'model'=>$model,
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'sort'=>$sort,
		));
	}

    public function actionGetProduct()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                echo Products::productVal($id);
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
    
    public function actionDeleteProduct($id)
    {
        if($id){
            Products::model()->deleteByPk($id);
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your product has been successfully deleted.');
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
                if(Products::model()->deleteByPk($replace))
                {
                    $links=CompanyProducts::model()->findAll('product_id='.$replace);
                    $specials=CompanySpecials::model()->findAll('product_id='.$replace);
                    if($specials)
                    {
                        foreach($specials as $special)
                        {
                                $model=CompanySpecials::model()->find('product_id='.$replace.' AND company_id='.$special->company_id);
                                $model->product_id=$with;
                                $model->save();
                        }
                    }
                    if($links)
                    {
                        foreach($links as $link)
                        {
                            if(!CompanyProducts::model()->exists('product_id='.$with.' AND company_id='.$link->company_id))
                            {
                                $model=new CompanyProducts();
                                $model->isNewRecord=true;
                                $model->product_id=$with;
                                $model->company_id=$link->company_id;
                                $model->save();
                            }
                        }
                        CompanyProducts::model()->deleteAll('product_id='.$replace);
                    }
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your product has been merged successfully.');
                }
            }
            
            $this->redirect(array('index'));
        }
        $products=Products::getAll();
        $additional=Products::getAdditional();
        $this->render('retag',array('products'=>$products,'additional'=>$additional));
    }
}