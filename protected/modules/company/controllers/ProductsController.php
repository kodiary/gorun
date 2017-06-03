<?php

class ProductsController extends Controller
{
    public $layout = 'column2';
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
	    $id=Yii::app()->user->getId();
        
	    $model=$this->loadModel($id);
	    $products = new CompanyProducts;
        $services = new CompanyServices;
        $brands = new CompanyBrands;
        $associations = new CompanyAssociations;
        
	    if($_POST)
        {
            //for products
            if(isset($_POST['CompanyProducts']))
            {
                Products::model()->deleteCompanyAdditionalProducts($id);
                CompanyProducts::model()->deleteAllByAttributes(array('company_id'=>$id));
                
                $products->attributes = $_POST['CompanyProducts'];
                $comProd = $products->product_id;
                for($i=0; $i<count($comProd); $i++){
                    $products->isNewRecord = true;
                    $products->primaryKey = NULL;
                    $products->company_id = $id;
                    $products->product_id = $comProd[$i];
                    if($products->product_id!=0)
                            $products->save(false);   
               }
               
               if($_POST['hiddenProductList']){
                    $additionalModel = new Products;
                    $additionalProducts = $_POST['hiddenProductList'];
                    $addedProducts = explode(',',$additionalProducts);
                    foreach($addedProducts as $prod)
                    {
                        $additionalModel->isNewRecord = true;
                        $additionalModel->primaryKey = NULL;
                        $additionalModel->product_name = $prod;
                        $additionalModel->additional = 1;
                        if($additionalModel->save(false)){
                            CommonClass::makeSlug($additionalModel, $additionalModel->product_name, $additionalModel->id);
                            $products->isNewRecord = true;
                            $products->primaryKey = NULL;
                            $products->company_id = $id;
                            $products->product_id = $additionalModel->id;
                            $products->save(false);
                        }
                    }
               }
            }
            
            //for services
            if(isset($_POST['CompanyServices']))
            {
                Services::model()->deleteCompanyAdditionalServices($id);
                CompanyServices::model()->deleteAllByAttributes(array('company_id'=>$id));
                $services->attributes = $_POST['CompanyServices'];
                $comService = $services->service_id;
                for($i=0; $i<count($comService); $i++){
                    $services->isNewRecord = true;
                    $services->primaryKey = NULL;
                    $services->company_id = $id;
                    $services->service_id = $comService[$i];
                    if($services->service_id!=0)
                        $services->save(false);   
               }
               
               if($_POST['hiddenServiceList']){
                    $additionalModel = new Services;
                    $additionalServices = $_POST['hiddenServiceList'];
                    $addedServices = explode(',',$additionalServices);
                    foreach($addedServices as $ser)
                    {
                        $additionalModel->isNewRecord = true;
                        $additionalModel->primaryKey = NULL;
                        $additionalModel->service_name = $ser;
                        $additionalModel->additional = 1;
                        if($additionalModel->save(false)){
                            CommonClass::makeSlug($additionalModel, $additionalModel->service_name, $additionalModel->id);
                            $services->isNewRecord = true;
                            $services->primaryKey = NULL;
                            $services->company_id = $id;
                            $services->service_id = $additionalModel->id;
                            $services->save(false);
                        }
                    }
               }
            }
            
            //for brands
            if(isset($_POST['hiddenBrandList']))
            {
                Brands::model()->deleteCompanyAdditionalBrands($id);
                CompanyBrands::model()->deleteAllByAttributes(array('company_id'=>$id));
                
                if($_POST['hiddenBrandList'])
                {
                    $additionalModel = new Brands;
                    $additionalBrands = $_POST['hiddenBrandList'];
                    $addedBrands = explode(',',$additionalBrands);
                    foreach($addedBrands as $brand)
                    {
                        $checkBrand = Brands::model()->checkBrand($brand);
                        if(!$checkBrand)
                        {
                            $additionalModel->isNewRecord = true;
                            $additionalModel->primaryKey = NULL;
                            $additionalModel->brand_name = $brand;
                            $additionalModel->additional = 1; 
                            
                            if($additionalModel->save(false)){
                                CommonClass::makeSlug($additionalModel, $additionalModel->brand_name, $additionalModel->id);
                                $brands->isNewRecord = true;
                                $brands->primaryKey = NULL;
                                $brands->company_id = $id;
                                $brands->brand_id = $additionalModel->id;
                                $brands->save(false);
                            }   
                        }
                        else
                        {
                            $brands->isNewRecord = true;
                            $brands->primaryKey = NULL;
                            $brands->company_id = $id;
                            $brands->brand_id = $checkBrand->id;
                            $brands->save(false);
                        }
                    }                            
                }
            }
            
            //for associations
            if(isset($_POST['CompanyAssociations']))
            {
                CompanyAssociations::model()->deleteAllByAttributes(array('company_id'=>$id));
                $associations->attributes = $_POST['CompanyAssociations'];
                $comAssociation = $associations->association_id;
                for($i=0; $i<count($comAssociation); $i++){
                    $associations->isNewRecord = true;
                    $associations->primaryKey = NULL;
                    $associations->company_id = $id;
                    $associations->association_id = $comAssociation[$i];
                    if($associations->association_id!=0)
                        $associations->save(false);   
               }
            }

            Yii::app()->user->setFlash('success', '<strong>SUCCESS! </strong> The changes have been successfully saved.');
        }
		$this->render('index',array(
			'model'=>$model,
            'products'=>$products,
            'services'=>$services,
            'brands'=>$brands,
            'associations'=>$associations,
            'companyId'=>$id,
		));
	}
    
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}