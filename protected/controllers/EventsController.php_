<?php
class EventsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;
    
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
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
	   //$rsvp = new EventRsvp;
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
		
        if(isset($_GET['slug'])){
		  $slug = $_GET['slug'];
		  $event = Events::model()->findByAttributes(array('slug'=>$slug));
          if($event)
          {
               //$this->metaDesc=$event['seo_desc'];
               //$this->metaKeys=$event['keywords'];
               $this->pageTitle="Event - ".$event->title." | EXSA - Exhibition Association of Southern Africa";
    	       
        	   $criteria = new CDbCriteria;
              // $criteria->with = array('event_file');
               $criteria->addCondition('t.slug="'.$slug.'"');
               $dataProvider = Events::model()->find($criteria);
               
               $event_time=EventsTime::model()->findAllByAttributes(array('event_id'=>$dataProvider->id));
               $event_venue=Events::get_venue_details($dataProvider->id,$dataProvider->venue_id);
               
               Events::model()->updateByPk($event->id,array('readcount'=>$event->readcount+1));
        	   $this->render('view',array(
        			'model'=>$dataProvider,
                    'event_time'=>$event_time,
                    'event_venue'=>$event_venue
        		));
            }
          else
            throw new CHttpException(404,'The requested page does not exist.');
        }
        else
            throw new CHttpException(404,'The requested page does not exist.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	    $seo=CommonClass::getSeoByPage('exhibitions');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle=$seo['title'];
        
        if($seo['title'] ==''){
            $seo=CommonClass::getSeoByPage('generic');
            $this->metaDesc=$seo['desc'];
            $this->metaKeys=$seo['keys'];
            $this->pageTitle="Events - ".$seo['title'];            
        }
        
        $criteria = new CDbCriteria;
        $criteria->addCondition('t.visible=1 AND t.end_date>CURDATE()');
        $criteria->order = 't.start_date ASC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Events',array('criteria'=>$criteria, 'pagination'=>false));
           
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['articles_pers_page'];
            $pages->applyLimit($criteria);
        }
        
        else
            $dataProvider= new CActiveDataProvider('Events',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>Yii::app()->params['articles_pers_page'])));

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
		$model=Events::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='RSVPForm')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
	/**
	 * Lists all models in timeline view.
	 */
	public function actionTimeline()
	{
        $seo=CommonClass::getSeoByPage('generic');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle="Events - ".$seo['title'];
        
        $eventsModel = Events::model()->getActiveUpcomingEvents();

        $this->render('timeline',array(
        	'eventsModel'=>$eventsModel,
            'event_type'=>$event_type,
            'event_category'=>$event_category,
            'event_profile'=>$event_profile,
        ));
	}
    
    public function actionListRemaining()
    {
        $offset = $_GET['offset'];
        if($offset)
        {
            $model = Events::model()->getActiveUpcomingEvents($offset);
            $index = $offset++;
    		$this->renderPartial('_timelinelisting',array('eventsModel'=>$model,'index'=>$index));
        }
    }
    
    public function actionSearch()
    {
        $seo=CommonClass::getSeoByPage('generic');
        $this->metaDesc=$seo['desc'];
        $this->metaKeys=$seo['keys'];
        $this->pageTitle="Events - ".$seo['title'];
       
      // echo "here";
        //print_r($_GET['update']);die();
        if($_GET['update'] || $_GET['submit'])// if searched
        {
            $criteria = new CDbCriteria;
            
            $type_array=array();
            $cat_array=array();
            $profile_array=array();
            $date = date('Y-m-d');
            
            if($_GET['update'])// if update result is clicked
            {
               
                $event_type=(isset($_GET['eventtype']))?$_GET['eventtype']:array();
                $event_category=(isset($_GET['eventcat']))?$_GET['eventcat']:array();
                $event_profile=(isset($_GET['eventprofile']))?$_GET['eventprofile']:array();
                 
                $criteria->with="event_link";
                
                if(isset($event_type))
                {
                    $criteria->addInCondition('type_id',$event_type,'OR');
                }
                
                if(isset($event_category))
                {
                    $criteria->addInCondition('category_id',$event_category,'OR');
                }
                
                if(isset($event_profile))
                {
                    $criteria->addInCondition('profile_id',$event_profile,'OR');
                }
                
                if($_GET['date']!="")
                {
                    $date=explode(" ",$_GET['date']);
                    $month = $date[0];
                    $year= $date[1];
                    $criteria->addCondition("MonthName(t.start_date)= '".$month."'",'AND');
                    $criteria->addCondition("Year(t.start_date)= '".$year."'",'AND');
                }
                
            }
            
            $pages='';
            if($_GET['submit'])
            {
                $string = $_GET['string'];
                $criteria->addSearchCondition('t.title',$string,true,'OR');
                $criteria->addSearchCondition('t.description',$string,true,'OR');
            }
            
            $criteria->addCondition('t.visible=1 AND t.end_date>CURDATE()');
            $criteria->order = 't.start_date ASC';
            
            if(isset($_GET['showall']))
            {
                
                $dataProvider = new CActiveDataProvider('Events',array('criteria'=>$criteria, 'pagination'=>false));
                
                $pages = new CPagination($dataProvider->totalItemCount);
                $pages->pageSize = Yii::app()->params['articles_pers_page'];
                $pages->applyLimit($criteria);
                if(isset($_GET['page'])){ echo $_GET['page'];}

            }
            
            else
                $dataProvider = new CActiveDataProvider('Events',array('criteria'=>$criteria,'pagination'=>array('pageSize'=>Yii::app()->params['articles_pers_page'])));
      		
           // echo "<pre>";print_r($pages);echo '</pre><br><pre>'.print_r($dataProvider);echo "</pre>";die();
          $this->render('index',array(
        			'dataProvider'=>$dataProvider,
                    'pages'=>$pages,
                    'event_type'=>$event_type,
                    'event_category'=>$event_category,
                    'event_profile'=>$event_profile,
        		));
        }
        else{
            $this->redirect($this->createUrl('/events'));
        }
	}
}