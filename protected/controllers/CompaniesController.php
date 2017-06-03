<?php

class CompaniesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $metaDesc;
    public $metaKeys;
    public $pageImage;

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $seo = CommonClass::getSeoByPage('generic');
        
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle=$seo['title']; 
        
        $order = $_GET['order'];
		$criteria = new CDbCriteria;
        $criteria->condition='status=1';
        if($order=='alphabetical')$criteria->order='name ASC';
        if($order=='date-added')$criteria->order='date_added DESC';
        if($order=='last-updated'|| $order=="")$criteria->order='date_updated DESC';

        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider = new CActiveDataProvider('Company',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Company',array('criteria'=>$criteria,'pagination' => array('pageSize' => Yii::app()->params['items_pers_page'])));
       
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Company::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionDetails($slug)
    {
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        $data = $this->getCompanyInfo($slug);
        if(!empty($data))
        {
            if($data['company']->seo_title=="")
            {
                $seo = Company::createSeo($data['company']->name,$data['company']->detail);
                $this->metaDesc=$seo['desc'];
                $this->metaKeys=$seo['keywords'];
                $this->pageTitle=$seo['title'];
            }
            else
            {
                $this->metaDesc=$data['company']->seo_desc;
                $this->metaKeys=$data['company']->seo_keywords;
                $this->pageTitle=$data['company']->seo_title;  
            }
            
            if($data['company']->logo!="" && file_exists(Yii::app()->basePath.'/../images/frontend/'.$data['company']->logo)) $this->pageImage=$this->createAbsoluteUrl('/images/frontend/'.$data['company']->logo);
            else $this->pageImage=$this->createAbsoluteUrl('/images/no_image_medium.jpg');
            
            # increment the rest views counter
            if($data['id']){
                $companyViews = new CompanyViews;
                $companyViews->company_id =$data['id']; 
                $companyViews->date = date('Y-m-d');
                $companyViews->save(false);
            }
            $videos = Videos::model()->findAll('company_id='.$data['id']);
            
                $this->render('view',array(
                    'model'=>$data['company'],
                    'id'=>$data['id'],
                    'slug'=>$slug,
                    'dataProvider'=>$dataProvider,
                    'brochures'=>$data['brochures'],
                    'videos'=>$videos,
                    'gallery'=>$data['gallery'],
                    'tradingHours'=>$data['trading'],
                ));
        }
        else
       	    throw new CHttpException(404,'The requested page does not exist.');
    }
    
    public function getCompanyInfo($slug)
    {
        if(Company::exists_company($slug))
        {
            $company = Company::model()->findByAttributes(array('slug'=>$slug));

            $id=$company->id;
            
            $data['gallery'] = Gallery::model()->findAllByAttributes(array('company_id'=>$id),array('order'=>'display_order ASC'));
            $data['company'] = $company;
            $data['id'] = $id;
            $data['brochures'] = Brochures::model()->findAllByAttributes(array('company_id'=>$id),array('order'=>'display_order'));
            $data['trading'] = Tradinghours::model()->findByAttributes(array('company_id'=>$id));
            return $data;
        }
    }
    
    public function actionProducts()
    {
        $companyId = $_POST['companyId'];
        $model=$this->loadModel($companyId);
        $products = Products::model()->getProductsByCompany($companyId);
        $services = Services::model()->getServicesByCompany($companyId);
        $brands = Brands::model()->getBrandsByCompany($companyId);
        $associations = CompanyAssociations::model()->getSelectedAssociations($companyId);
                
        $this->renderPartial('_products',array(
            'products'=>$products,
            'services'=>$services,
            'brands'=>$brands,
            'associations'=>$associations,
            'model'=>$model
        ));
    }
    
    public function actionMap($slug)
    {
       $data = $this->getCompanyInfo($slug);
       Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
       $this->render('_map',array('model'=>$data['company'],'gallery'=>$data['gallery'],'dataSpecials'=>$data['dataSpecials'],'id'=>$data['id'],'slug'=>$slug));
    }
    
    public function actionVideo($slug)
    {
        $data = $this->getCompanyInfo($slug);
        $this->renderPartial('_video',array('Video'=>$data['company']->Video), false, true);
        Yii::app()->end();
    }
        
    public function actionCountContact()
    {
       $slug = $_POST['slug'];
       $model = Company::model()->findByAttributes(array('slug'=>$slug));
       $clickLimit = Config::model()->findByPk(1)->number;
       if($model->contact_clicked>=$clickLimit-1){
        $totalClicks = CompanyClicks::countClicks($model->id);
        $model->updateByPk($model->id, array('contact_clicked'=>0));
        $subject = 'More clicks on your listing';
        $body = $this->renderPartial('application.views.email.companyClicked', array('count'=>$clickLimit,'company'=>$model->name), true);
        
        CommonClass::sendEmail("EXSA","noreply@exsa.co.za", $model->email, $subject, $body, "noreply@exsa.co.za");
        CommonClass::sendEmail("EXSA","noreply@exsa.co.za", 'webmaster@exsa.co.za', $subject, $body, "noreply@exsa.co.za");
        
       }
       else
        $model->updateByPk($model->id, array('contact_clicked'=>$model->contact_clicked+1));
       
       if($model->id){
            $companyClicks = new CompanyClicks;
            $companyClicks->company_id =$model->id; 
            $companyClicks->date = date('Y-m-d');
            $companyClicks->save(false);
       }
       return;
    }

    
    /*public function actionFacilities($slug)
    {   
        $data = $this->getRestroInfo($slug);
        
        $this->renderPartial('facilities',array('model'=>$data['restaurant'],'id'=>$data['id'], 'slug'=>$slug), false, true);
        Yii::app()->end();
     
    }
    
    public function actionMenus($slug)
    {   
        $data = $this->getRestroInfo($slug);
        $menus = Menu::restMenus($data['id']);
        $this->renderPartial('menus',array('slug'=>$slug, 'menus'=>$menus), false, true);
       Yii::app()->end();
    }
    
     public function actionNews($slug)
    {   
        $data = $this->getRestroInfo($slug);
        $criteria = new CDbCriteria;
        $criteria->addCondition('isApproved=1 AND Active=1 AND 	restaurantsId='.$data['id']);
        $criteria->order = 'DateAdded DESC';
        $dataProvider = new CActiveDataProvider('News', array('criteria'=>$criteria, 'pagination'=>false));
        
        $this->renderPartial('news',array('id'=>$data['id'], 'slug'=>$slug, 'dataProvider'=>$dataProvider), false, true);
     
    }
    
    public function actionNewsdetail($slug, $news_slug)
    {   
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        $data = $this->getRestroInfo($slug);
        $criteria = new CDbCriteria;
        $criteria->addCondition('isApproved=1 AND Active=1 AND 	Slug="'.$news_slug.'"');
        $newsDetail = News::model()->find($criteria);
        
        $seo=CommonClass::getSeoByPage('generic');
        if($newsDetail->seo_desc!="")$this->metaDesc=$newsDetail->seo_desc;
        else $this->metaDesc=$seo['desc'];
        if($newsDetail->keywords!="")$this->metaKeys=$newsDetail->keywords;
        else $this->metaKeys=$seo['keys'];
        if($newsDetail->seo_title!="")$this->pageTitle=$newsDetail->seo_title." - ".$seo['title'];
        else $this->pageTitle="News - ".$seo['title'];
        
        if($newsDetail)
        {
            News::model()->updateByPk($newsDetail->NewsId, array('readcount'=>$newsDetail->readcount+1));
        }
        //menus
        $menus = Menu::restMenus($data['id']);
        //news
        $criteria = new CDbCriteria;
        $criteria->addCondition('isApproved=1 AND Active=1 AND 	restaurantsId='.$data['id']);
        $criteria->order = 'DateAdded DESC';
        $dataProvider = new CActiveDataProvider('News', array('criteria'=>$criteria, 'pagination'=>false));
        $videos=Videos::model()->findAll('resId='.$data['id']);
        $this->render('newsdetail',array('model'=>$data['restaurant'],'meals'=>$data['meals'],'gallery'=>$data['gallery'], 'dataSpecials'=>$data['dataSpecials'], 'dataJobs'=>$data['dataJobs'],'must_try_meals'=>$data['must_try_meals'],'id'=>$data['id'], 'slug'=>$slug, 'menus'=>$menus, 'newsDetail'=>$newsDetail, 'dataProvider'=>$dataProvider,'videos'=>$videos));
    }*/    
}