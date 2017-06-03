<?php

class DirectoryController extends Controller
{
    public $layout='//layouts/column2';
    public $metaDesc;
    public $metaKeys;
    public $pageImage;
    
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			
		);
	}
    
	public function actionIndex()
	{
	    $seo=CommonClass::getSeoByPage('directory');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle=$seo['title'];
        
        if($seo['title'] ==''){
            $seo=CommonClass::getSeoByPage('generic');
            $this->metaDesc=$seo['desc'];
            $this->metaKeys=$seo['keys'];
            $this->pageTitle="Directory - ".$seo['title'];            
        }
        
        $filter = $_GET['filter'];
		$criteria = new CDbCriteria;
        $criteria->condition='status=1';
        if(isset($_POST['key']))
        {
            $criteria->addSearchCondition('name',$_POST['key'],true);
        }
        if(isset($_GET['filter']))
        {
            $filter=$_GET['filter'];
            $member_id=MemberType::model()->findByAttributes(array('slug'=>$filter))->id;
            $criteria->with='membership';
            $criteria->addCondition('membership.member_id='.$member_id);
            $criteria->together=true;
        }
        // $criteria->order='date_updated DESC';
        $criteria->order='name ASC';

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
                    'news'=>$data['news'],
                    'jobs'=>$data['jobs'],
                    'events'=>$data['events'],
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
            $data['news'] = Articles::model()->findAllByAttributes(array('company_id'=>$id,'is_approved'=>1,'visible'=>1),array('order'=>'publish_date desc'));
            $data['jobs'] = Jobs::model()->findAllByAttributes(array('company_id'=>$id,'visible'=>1),array('order'=>'display_order asc'));
            $data['events'] = Events::model()->findAllByAttributes(array('organiser'=>$id,'visible'=>1),array('order'=>'start_date asc'));
            return $data;
        }
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
        
        CommonClass::sendEmail("","", $model->email, $subject, $body, "noreply@exsa.co.za");
        
       }
       else
        $model->updateByPk($model->id, array('contact_clicked'=>$model->contact_clicked+1));
       
       if($model->id){
            $companyClicks = new CompanyClicks;
            $companyClicks->company_id =$model->id; 
            $companyClicks->date = date('Y-m-d');
            $companyClicks->save(false);
       }
       echo ucwords($model->name);return;
    }
    public function actionContact()
    {
        if($_POST['ContactForm'])
        {
            $_POST['ContactForm']['link']=$_POST['link'];
            $_POST['ContactForm']['for']=$_POST['contactFor'];
            
            $subject="New Enquiry from EXSA website";
            $body=$this->renderPartial('/email/contactEvent',array('data'=>$_POST['ContactForm']),true);
            if(CommonClass::sendEmail('EXSA','info@exsa.co.za',$_POST['toEmail'],$subject,$body,'info@exsa.co.za'))echo 1;
            else echo 0;
        }
    }
    public function actionPreview($slug)
    {
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        $data = $this->getCompanyInfo($slug);
        if($data)
        {
        $videos = Videos::model()->findAll('company_id='.$data['id']);
        
            $this->renderPartial('preview',array(
                'model'=>$data['company'],
                'id'=>$data['id'],
                'slug'=>$slug,
                'dataProvider'=>$dataProvider,
                'brochures'=>$data['brochures'],
                'videos'=>$videos,
                'gallery'=>$data['gallery'],
                'tradingHours'=>$data['trading'],
                'news'=>$data['news'],
                'jobs'=>$data['jobs'],
                'events'=>$data['events'],
            ),false,true);
        }
        else
       	    throw new CHttpException(404,'The requested page does not exist.');
    }

	public function actionService()
	{
        if(isset($_GET['slug']) && $_GET['slug']!='')
        {
            $slug = $_GET['slug'];    

            $serviceModel = Services::model()->find("slug='$slug'");
            
            $seo=CommonClass::getSeoByPage('service');
            $this->metaDesc=$seo['desc'];
            $this->metaKeys=$seo['keys'];
            $this->pageTitle=ucwords($serviceModel->service_name)." - ".$seo['title'];
            
            if($seo['title'] ==''){
                $seo=CommonClass::getSeoByPage('generic');
                $this->metaDesc=$seo['desc'];
                $this->metaKeys=$seo['keys'];
                $this->pageTitle=ucwords($serviceModel->service_name)." - ".$seo['title'];            
            }
            
    		$criteria = new CDbCriteria;
            $criteria->join = "LEFT JOIN tbl_com_services ON tbl_com_services.company_id=t.id";
            $criteria->join .= " LEFT JOIN tbl_services ON tbl_services.id=tbl_com_services.service_id";
            $criteria->condition="t.status=1 AND tbl_services.slug='".$slug."'";
            $criteria->order='t.date_updated DESC';
    
            $pages='';
            if(isset($_GET['showall'])){
                $dataProvider = new CActiveDataProvider('Company',array('criteria'=>$criteria, 'pagination'=>false));
                $pages = new CPagination($dataProvider->totalItemCount);
                $pages->pageSize = Yii::app()->params['items_pers_page'];
                $pages->applyLimit($criteria);
            }
            else
                $dataProvider= new CActiveDataProvider('Company',array('criteria'=>$criteria,'pagination' => array('pageSize' => Yii::app()->params['items_pers_page'])));
           
    		$this->render('service',array(
    			'dataProvider'=>$dataProvider,
                'pages'=>$pages,
                'serviceModel'=>$serviceModel,
    		));
        }
	}
}