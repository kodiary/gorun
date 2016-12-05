<?php
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
 	public $layout='column2';
    public $metaDesc;
    public $metaKeys;
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
		public function actionIndex()
    	{
           $seo=CommonClass::getSeoByPage('home-page');
           $this->metaDesc=$seo['desc'];
           $this->metaKeys=$seo['keys'];
           $this->pageTitle=$seo['title'];
           
           if($seo['title'] ==''){
               $seo=CommonClass::getSeoByPage('generic');
               $this->metaDesc=$seo['desc'];
               $this->metaKeys=$seo['keys'];
               $this->pageTitle="GoRun Home - ".$seo['title'];            
           }
        
           $patronSliderVisibility = PatronSetting::model()->findByPk(1)->visible;
           if($patronSliderVisibility == 1){
                $patronslider = PatronSlider::model()->findAll(array('order'=>'display_order ASC'));                 
           }else{
                $patronslider = '';
           }

           $sliders = Slideshow::model()->findAll(array('order'=>'display_order ASC'));
           $model = Contents::model()->getBySlug('home-page');
           
           $events = Events::model()->findAllByAttributes(array('event_cat'=>1,'visible'=>1),array('order'=>'id desc','limit'=>2));
                      
           $criteria = new CDbCriteria;
           $criteria->addCondition('t.is_approved=1 AND t.visible=1 AND publish_date<=CURDATE()');
           $criteria->order = 't.publish_date DESC,t.id DESC'; 
           $criteria->limit=10;

           $articlesData = new CActiveDataProvider('Articles', array('criteria'=>$criteria, 'pagination'=>false));
           $this->render('index', array('model'=>$model, 'sliders'=>$sliders, 'articlesData'=>$articlesData, 'patronslider'=>$patronslider,'events'=>$events));
        }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->renderPartial('error', $error);
	    }
	}
    //load the google doc in external page
    public function actionMenu($url, $title,$filename)
    {
        Yii::app()->clientScript->scriptMap=array(
        (YII_DEBUG ? 'jquery.js':'jquery.min.js')=>false,);
        if($url){
            $this->renderPartial('googledoc',array('url'=>$url, 'title'=>$title,'filename'=>$filename), false, true);
        }
            
    }
    
    public function actionContact()
    {
        $contact = Contents::model()->findByPk(5);
        $this->pageTitle = $contact->meta_title;
        $this->metaDesc = trim(strip_tags($contact->meta_desc));
        $this->metaKeys = $contact->meta_keywords;
        $model=new ContactForm('contactAdmin');
        $sent=false;
        if($_POST['ContactForm'])
        {
            $email = AdminEmail::model()->findByPk(1);
            $e[0] = $email->email1;
            $e[1] = $email->email2;
            $e[2] = $email->email3;
            $e[3] = $email->email4;
            $e[4] = $email->email5;
            $admin_email=$e[0];
            for($i=1; $i<5;$i++)
            {
                if($e[$i])
                {
                    $admin_email.=",".$e[$i];
                }
            }
            $subject = "Somebody Contacted on ".Yii::app()->params['site_name'];
            $body = $this->renderPartial('/email/contact',array('data'=>$_POST['ContactForm']),true);
            //if(CommonClass::sendEmail($_POST['ContactForm']['name'],$_POST['ContactForm']['email'],$admin_email,$subject,$body,$_POST['ContactForm']['email']))
            if(CommonClass::sendEmail('GoRun','info@gorun.co.za',$admin_email,$subject,$body,$_POST['ContactForm']['email']))
            {
                Yii::app()->user->setFlash('info', '<strong>SUCCESS!</strong> Your Message has been sent.');
            }
        }
        $this->render('contact',array('model'=>$model,'contact'=>$contact));
    }
    
    public function actionDownload($filename)
    {
      if($filename && Yii::app()->file->set('documents/'.$filename)->exists)
       {
            $orderForm = Yii::app()->file->set('documents/'.$filename, true);
            $orderForm->download($filename);
       }  
    }
    
    public function actionDownloadOrderForm()
    {
        $filename = Accounts::model()->findByPk(1)->filename;
        if(Yii::app()->file->set('documents/'.$filename)->exists && $filename!='')
        {
            $orderForm = Yii::app()->file->set('documents/'.$filename, true);
            $orderForm->download();
        }  
    }
    
    public function actionFeed() //specials feed
    {
        $specials=Specials::model()->getAllActiveCompanyActiveSpecials("",'id DESC');
        if($specials)
        {
            $image_url=$this->createAbsoluteUrl('/images/logo.png');
            $feed_url=$this->createAbsoluteUrl('/feed');
            $site_url=$this->createAbsoluteUrl('/');
            Yii::import('ext.feed.*');
            // RSS 2.0 is the default type
            $feed = new EFeed();
             
            $feed->title= 'GoRun';
            $feed->description = 'List of Company Specials all around the world';
             
            $feed->setImage('Sign African Directory Specials',$site_url,$image_url);
             
            $feed->addChannelTag('language', 'en-us');
            $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
            $feed->addChannelTag('link', $site_url );
             
            // * self reference
            //$feed->addChannelTag('atom:link',$feed_url);
            
            foreach($specials as $data)
            {
                $company = Company::model()->companyInfo($data->company_id);              
                $link=$this->createAbsoluteUrl("companies/".$company->slug.'#'.$data->slug);
                $item = $feed->createNewItem();
             
                $item->title = htmlspecialchars($data->title,ENT_QUOTES);
                $item->link = $link;
                $item->date = time();
                $item->description = $data->detail;
                if($data->image!="" && file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$data->image))
                {
                    $file=Yii::app()->basePath.'/../images/frontend/thumb/'.$data->image;
                    $file_url=$this->createAbsoluteUrl('/images/frontend/thumb/'.htmlspecialchars($data->image, ENT_QUOTES));
                    $vals=@getimagesize($file);
                    $size=@filesize($file);
                   $item->setEncloser($file_url, $size, $vals['mime']); 
                }
                 
                $item->addTag('author', 'info@gorun.co.za(GoRun)');
                $item->addTag('guid', $link,array('isPermaLink'=>'true'));
                 
                $feed->addItem($item);
            }  
            $feed->generateFeed();
            Yii::app()->end();
        }
    }
    protected function getSitemapUrl($list)
    {
        $urls="";
        if(!empty($list)&& is_array($list))
        {
            foreach($list as $link):
            $urls.=" <url>
                    <loc>". CHtml::encode($link['loc'])."</loc>";
                   // $urls.="<lastmod>".date('Y-m-d')."</lastmod>";
                    //if($link['frequency']!="")$urls.=" <changefreq>".$link['frequency']."</changefreq>";
                   // if($link['priority']!="")$urls.="<priority>".$link['priority']."</priority>";
                   // else $urls.="<priority>0.5</priority>";
                    $urls.="</url>";
            endforeach; 
        }
        return $urls;
    }
    public function actionSavedoc()
    {
        $path='documents/'.$_GET['filename'];
         if(file_exists($path))
         {
            $file= Yii::app()->file->set($path);
            if($_GET['title']!="")$file->download($_GET['title'].'.'.$file->extension);
            else $file->download();
         }
    }
    
	public function actionSupplierList()
	{
        if(isset($_GET['page']))
        {
            $this->pageTitle="Page ".$_GET['page'].": ".$this->pageTitle;    
            $this->metaDesc="Page ".$_GET['page']." of ".$this->metaDesc;
            $this->metaKeys="Page ".$_GET['page'].', '.$this->metaKeys;
        }
                
        $product = $_GET['products'];
        $service = $_GET['services'];
        $order= $_GET['order'];
        
        if($product)
        {
            $products = Products::model()->findByAttributes(array('slug'=>$product));
            $supplierName = $products->product_name;
            $getProductId = $products->id;
            $section = 'products';
        }

        if($service){
            $services = Services::model()->findByAttributes(array('slug'=>$service));
            $supplierName = $services->service_name;
            $getServiceId = $services->id;
            $section = 'services';
        }
        
        
        $seo = CommonClass::getSeoByPage('generic');
        $this->metaDesc = $seo['desc'];
        $this->metaKeys = $supplierName.", ".$seo['keys'];
        if($seo['title']!="")$this->pageTitle=ucwords($supplierName)." Suppliers - ".$seo['title'];
        else $this->pageTitle=ucwords($supplierName)." Suppliers - Sign Africa Directory";


        $criteria = new CDbCriteria;
        
        if($getProductId)
        {
            $criteria->addInCondition('id',CompanyProducts::getCompanyByProduct($getProductId));
        }
        if($getServiceId)
        {
            $criteria->addInCondition('id',CompanyServices::getCompanyByService($getServiceId));
        }

        if($order=='alphabetical') $criteria->order='name ASC';
        elseif($order=='date-added') $criteria->order='date_added DESC';
        elseif($order=='last-updated' || $order=="") $criteria->order='date_updated DESC';
        elseif($order=='with-specials') $criteria->addInCondition('id',Specials::model()->getCompanyActiveSpecials());
        
        $criteria->addCondition('status=1 AND (valid_until >= curdate() OR never_expire=1)');
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Company',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Company',array('criteria'=>$criteria,'pagination' => array('pageSize' => Yii::app()->params['items_pers_page'])));
        
        $specials = Specials::getAllActiveCompanyActiveSpecials(3,'id DESC');
         
        $this->render('_supplierlist',array(
            'dataProvider'=>$dataProvider,
            'pages'=>$pages,
            'specials'=>$specials,
            'supplierName'=>$supplierName,
            'section'=>$section,
            'specials'=>$specials,
        ));
    }
    
    public function actionImport()
    {
        $this->render('importfromarray');
    }
    
    public function actionSlider($id,$type='')
    {
        if($type!=''){
          $model = PatronSlider::model()->findByPk($id);
        }else{
          $model = Slideshow::model()->findByPk($id);  
        }
          if($model)
          {
            $model->count_click+=1;
            $model->save(false);
            if($model->slide_link)$this->redirect($model->slide_link);
          }
          $this->redirect(Yii::app()->request->urlReferrer);
    }
    
    //load the google doc in external page
    public function actionViewDoc($url, $title,$model="",$id="")
    {
        if($model) //increment the document download counter
        {
            $data=CActiveRecord::model($model)->findByPk($id);
            $data->save();
        }
        Yii::app()->clientScript->scriptMap=array(
        (YII_DEBUG ? 'jquery.js':'jquery.min.js')=>false,);
        if($url){
            $this->renderPartial('_googledoc',array('url'=>$url, 'title'=>$title), false, true);
        }
    }
}