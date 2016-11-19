<?php

class EventsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
	   $for = array('create','update','delete');
       
	   if(in_array($this->action->Id,$for)){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
        }
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
	   $for = array('create','update','delete');
       
	   if(in_array($this->action->Id,$for)){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
        }
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($slug)
	{
	   //die('here');
	   $e = Events::model()->findByAttributes(array('slug'=>$slug));
       if(isset($e->end_date) && $e->end_date)
       {
            $date = new DateTime($e->end_date);
            $now = new DateTime();
            if($date < $now)
            {
                $past = 1;
            }
            else
            $past = 0;
       }
       else
       {
        if(isset($e->start_date) && $e->start_date)
        {
            $date = new DateTime($e->start_date);
            $now = new DateTime();
            if($date < $now)
            {
                $past = 1;
            }
            else
            $past = 0;
        }
        else
        $past = 0;
       }
       $et = EventsType::model()->findByAttributes(array('id'=>$e->event_type));
       $check = array();
       if(Yii::app()->user->id){
       $em = MemberEvent::model()->findByAttributes(array('event_id'=>$e->id,'member_id'=>Yii::app()->user->id));
       
       if(count($em))
       {
        $check['going'] = $em->going;
        if($check['going'] == 1)
        {
            $er = EventResult::model()->findAllByAttributes(array('event_id'=>$e->id,'user_id'=>Yii::app()->user->id));
            if(count($er))
            $check['result'] = $er;
            
            if($e->event_cat == 3)
            {
                $etr = EventTriResult::model()->findAllByAttributes(array('event_id'=>$e->id,'user_id'=>Yii::app()->user->id));
                if(count($etr))
                $check['tri_result'] = $etr;
            }
        }
       }
       }
       
       //var_dump($check);
       $etime = EventsTime::model()->findAllByAttributes(array('event_id'=>$e->id));
		$this->render('detail',array(
			'model'=>$this->loadModel($e->id),
            'm_type'=>$et,
            'm_time'=>$etime,
            'past'=>$past,
            'check'=>$check
		));
        
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id=0)
	{
	   //$created_by=Yii::app()->user->getId();
		//var_dump($_POST['EventsTime']);die();
        
               
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));
        //Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
        $model  = new Events;
        $model_type  = new EventsType;
        $event_type = EventsType::model()->findAll();
        
        
        
        
        
        
        
		if(isset($_POST['Events']['title']))
		{
		  $model->created_by = Yii::app()->user->id;
          $model->visible=0;
		   foreach($_POST['Events'] as $k=>$p)
           {
            if($k == 'start_date' || $k == 'end_date')
            $model->$k = date('Y-m-d', strtotime($p));
            else
            $model->$k = $p;
           }
           if($_POST['Events']['latitude'] && $_POST['Events']['longitude'])
           {
            $array = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$_POST['Events']['latitude'].','.$_POST['Events']['longitude'].'&sensor=false');
            $array = json_decode($array);
            $array = (array)$array;
            //  = get_province($arr);
            $model->province = $this->get_province($array);
           }
		   
           
           
           //getSlug
           $slug=CommonClass::getSlug($_POST['Events']['title']);
           $count=0;
           while(Events::model()->findAllByAttributes(array('slug'=>$slug)))
           {
                $count++;
                $slug=$slug."-".$count;
           }
           $model->slug=$slug;
            if(isset($_POST['logo']) && $_POST['logo']){
            $logo_arr = explode('?',$_POST['logo']);
            $_POST['logo'] = $logo_arr[0];
            
            }
            //echo Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'];die();    
           if($_POST['logo']!='')
           {
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/events/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/events/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/events/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $model->logo = $_POST['logo'];                
           }
           
                  
			if($model->save())
            {   
                
                $id = $model->id;                     
                if(isset($_POST['EventsTime'])){
                
                foreach($_POST['EventsTime'] as $k=>$p)
                {
                    
                    foreach($p as $k1=>$v)
                    {
                        $arr[$k1][$k] = $v;
                    }
                    
                }
                
                foreach($arr as $a)
                {
                   $events_time= new EventsTime;
                   $events_time->event_id = $model->id;
                   foreach($a as $k=>$v)
                   {
                        $events_time->$k = $v;
                   } 
                   $events_time->save();
                   
                   unset($events_time);
                }
                if(isset($arr))
                unset($arr);
                }
                
                if(isset($_POST['EventsFile'])){
                
                foreach($_POST['EventsFile'] as $k=>$p)
                {
                    
                    foreach($p as $k1=>$v)
                    {
                        $arr[$k1][$k] = $v;
                    }
                    
                }
                foreach($arr as $a)
                {
                   $events_file= new EventsFile;
                   $events_file->event_id = $model->id;
                   foreach($a as $k=>$v)
                   {
                        $events_file->$k = $v;
                   } 
                   $events_file->save();
                   
                   unset($events_file);
                }
                
                }
                
                
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - A new event has been added successfully!');
                //die();
				$this->redirect(array('index'));
            }
            else
            {
                var_dump($model);
            }   
		}
        
		$this->render('create',array(
			'model'=>$model,'event_type'=>$event_type
		));
	}
    
   
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
	   //get company id
        $company_id=Yii::app()->user->getId();
		
        //get event id
        $model=$this->loadModel($id);
       
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_events.js"));
        if($model->venue_id=="0")
        {
            Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        }
        if(Venues::model()->check_venue_in_db($model->id))
        {
            $venue = Venues::model()->findByAttributes(array('event_id'=>$id));
        }
        else
        {
            $venue= new Venues;  
        } 
        
        $events_link= EventsLink::model()->findByAttributes(array('event_id'=>$model->id));
        if(!$events_link)
        {
            $events_link=new EventsLink;
        }
        
		if(isset($_POST['Events']))
		{
			$model->attributes=$_POST['Events'];
            $model->start_date = date('Y-m-d', strtotime($_POST['Events']['start_date']));
            $model->end_date = date('Y-m-d', strtotime($_POST['Events']['end_date']));
            $model->organiser=$company_id;
            $model->description = nl2br($model->description);
            
            if($model->start_date > $model->end_date){$model->end_date=$model->start_date;}
            
            $slug=CommonClass::getSlug($_POST['Events']['title']);
            $count=0;
            
            $newSlug=$slug;
            while(Events::model()->findAllByAttributes(array('slug'=>$newSlug)))
            {
                $count++;
                $newSlug=$slug."-".$count;
            }
            $model->slug=$newSlug;
            
            if($_POST['logo']!='')
            {
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
               
                //@unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                //@unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                
                if($model->logo!=$_POST['logo'] && $id!=0)
                {
                    
                    //@unlink(Yii::app()->basePath."/../images/frontend/full/".$model->logo);
                    //@unlink(Yii::app()->basePath."/../images/frontend/main/".$model->logo);
                    //@unlink(Yii::app()->basePath."/../images/frontend/thumb/".$model->logo);
                }
                $model->logo = $_POST['logo'];                
            }
                
            $id = $model->id;                
                                    
            if($_POST['file']!="" )
            {
                @copy(Yii::app()->basePath.'/../documents/temp/'.$_POST['file'],Yii::app()->basePath.'/../documents/'.$_POST['file']);
                @unlink(Yii::app()->basePath."/../documents/temp/".$_POST['file']);   
                if($model->file!=$_POST['file'])
                {
                    @unlink(Yii::app()->basePath."/../documents/".$model->file);   
                }
                $model->file=$_POST['file'];
            } 
             
            if($model->save())
            {
                $events_link->attributes = $_POST['EventsLink'];
                $events_link->event_id = $id;
                $events_link->save();
                
                if($model->venue_id=='0'){
                    $venue->attributes = $_POST['Venues']; 
                    $venue->event_id = $id;
                    $venue->save();
                }else{
                    Venues::model()->deleteAllByAttributes(array('event_id'=>$model->id));
                }
                
                if($model->organiser!='0'){
                    Organisers::model()->deleteAllByAttributes(array('event_id'=>$model->id));    
                } 
                
                if($_POST['times'] == 'on')
                {
                    foreach($_POST['on_date'] as $key=>$date)
                    {
                        if(EventsTime::check_event_time_in_db($model->id,$date))
                        {
                            $time=EventsTime::model()->findByAttributes(array('event_id'=>$model->id,'on_date'=>$date));
                        }
                        else
                        {
                            $time = new EventsTime;
                        }
                        $time->on_date = $date;
                        $time->from = $_POST['from'][$key];
                        $time->to = $_POST['to'][$key];
                        $time->event_id = $id;
                        $time->save();
                    }
                }
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The event has been updated successfully!');
            $this->redirect(array('update','id'=>$model->id));
            }  
		}
        
		$this->render('create',array(
			'model'=>$model,'venue'=>$venue,'events_link' =>$events_link
		));
	}

    public function actionEvent_time()
    {
        $id = $_POST['id'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $day = $_POST['day'];
        
        $this->renderPartial('application.modules.admin.views.events._event_times',array(
            'id'=>$id,
            'start'=>$start,
            'end'=>$end,
            'day'=>$day,
        ));        
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
       //echo $id;die();
		if($id)//Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            Venues::model()->deleteAllByAttributes(array('event_id'=>$id));
            Organisers::model()->deleteAllByAttributes(array('event_id'=>$id));
            EventsTime::model()->deleteAllByAttributes(array('event_id'=>$id)); 
            EventsLink::model()->deleteAllByAttributes(array('event_id'=>$id));
            $this->actionDeleteImages($id);
            $this->actionDeleteDocuments($id);
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The event has been deleted successfully!'); 
			
            if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/company/events/'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    public function actionDeleteImages($id)
	{
		if($id)
		{
            $filepath = Yii::app()->basePath.'/../images/frontend/';
            $temppath = Yii::app()->basePath.'/../images/temp/';
            
            $model = $this->loadModel($id);
            if($model){
                if($model->logo!=''){
                  # delete photo
                  if(file_exists($filepath.'full/'.$model->logo) && $model->logo)
                    @unlink($filepath.'full/'.$model->logo);
                  if(file_exists($filepath.'main/'.$model->logo) && $model->logo)
                    @unlink($filepath.'main/'.$model->logo);  
                  if(file_exists($filepath.'thumb/'.$model->logo) && $model->logo)
                    @unlink($filepath.'thumb/'.$model->logo);
                    
                  if(file_exists($temppath.'original/'.$model->logo) && $model->logo)
                    @unlink($temppath.'original/'.$model->logo);
                  if(file_exists($temppath.'full/'.$model->logo) && $model->logo)
                    @unlink($temppath.'full/'.$model->logo);
                  if(file_exists($temppath.'main/'.$model->logo) && $model->logo)
                    @unlink($temppath.'main/'.$model->logo);
                  if(file_exists($temppath.'thumb/'.$model->logo) && $model->logo)
                    @unlink($temppath.'thumb/'.$model->logo); 
                }
            }
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    public function actionDeleteDocuments($id)
	{
		if($id)
		{
            $filepath = Yii::app()->basePath.'/../documents/';
            $temppath = Yii::app()->basePath.'/../documents/temp/';
            
            $model = $this->loadModel($id);
            if($model){
                if($model->file!=''){
                  # delete photo
                  if(file_exists($filepath.$model->file) && $model->file)
                    @unlink($filepath.$model->file);
                    
                  if(file_exists($temppath.$model->file) && $model->file)
                    @unlink($temppath.$model->file); 
                }
            }
        }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $id=Yii::app()->user->getId();
        $condition="organiser='$id'";
        $order='start_date DESC';      
      
    	$dataProvider=new CActiveDataProvider('Events',
        array( 
            'criteria'=>array(
            'order'=>$order,
            'condition'=>$condition,
            ),
            'pagination'=>array(
            'pageSize'=>10
            ),
        ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,

		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Events('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Events']))
			$model->attributes=$_GET['Events'];

		$this->render('admin',array(
			'model'=>$model,
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
    
    function actionCropLogo()
    {
        if($_POST['fileName']!="")
        {
            Yii::app()->clientScript->scriptMap=array(
        	   (YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false,
        	);
        	$imageUrl = Yii::app()->baseUrl.'/images/temp/original/'. $_POST['fileName'];
        	$this->renderPartial('_cropImg', array('imageUrl'=>$imageUrl,'image'=>$_POST['fileName']), false, true);
         }
         else
            echo "";
    }
     public function actionCrop()
    {
       $x=$_POST['cropX'];
       $y=$_POST['cropY'];
       $width=$_POST['cropW'];
       $height=$_POST['cropH'];
       $src_file=Yii::app()->basePath.'/../images/temp/original/'.$_POST['filename'];
       $temp_file=Yii::app()->basePath.'/../images/temp/'.$_POST['filename'];
       
       Yii::import('application.extensions.image.Image');
       
       $image = new Image($src_file);
       $image->crop($width,$height,$y,$x)->quality(90);
       $image->save($temp_file);
       
       $cropped_image= new Image($temp_file);
       
       $cropped_image->resize(90,67);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['filename']);
       
       $cropped_image->resize(120,90);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/main/'.$_POST['filename']);
       
       $cropped_image->resize(250,190);
       $cropped_image->save(Yii::app()->basePath.'/../images/temp/full/'.$_POST['filename']);
       
       if(Yii::app()->file->set($temp_file)->exists)
       {
            $temp = Yii::app()->file->set($temp_file);
            $temp->delete();
       }
       
       echo Yii::app()->baseUrl.'/images/temp/full/'.$_POST['filename'].'?id='.rand();
    }
    
    public function actionUploaddoc()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
     
        $folder=Yii::app()->basePath.'/../documents/';// folder to upload file
        $allowedExtensions = array('pdf','doc','docx');
        $sizeLimit = Yii::app()->params['doc_size'] * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder, false,'file' );
        if($result['success'])
        {
             $result['fileSize']=CommonClass::format_file_size(filesize($folder.$result['filename']));//GETTING FILE SIZE
             $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
             echo $return;// it's array
        }
        else
        {
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }
    }    
    
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder=Yii::app()->basePath.'/../images/temp/full/';// folder to upload file
        $allowedExtensions = array("jpg","jpeg",'gif','png');
        $sizeLimit = Yii::app()->params['image_size'] * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        if($result['success'])
        {
             $file=$folder.$result['filename'];
             $result['imageFull']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filename'];
             
             Yii::import('application.extensions.image.Image');
             $resize_detail=CommonClass::get_resize_details('event_logo');
             if (is_array($resize_detail))
             {
                foreach($resize_detail as $resize_item)
                {
                    list($width,$height) = getimagesize($file);
                    list($resize_width,$resize_height)=CommonClass::get_resized_width_height($width, $height,$resize_item);
                    if($width < $resize_item["width"])
                    {
                        $resize_item["crop"]= "false";
                        $resize_width = $width;
                        $resize_height = $height;
                    }
                    //load image library for resizing
                     $image = new Image($file);
                     $image->resize($resize_width,$resize_height)->quality(90);
                     $image->save($resize_item["new_path"].$result['filename']);
                     
                    if($resize_item["crop"]=="true")
                    {
                        switch($resize_item["crop_type"])
                        {
                            case "center":
                                $top_offset='center';
                                $left_offset='center';
                                break;
                            case "top_left":
                                $top_offset='top';
                                $left_offset='left';
                                break;
                        }
                        //load image library for cropping
                         $image = new Image($resize_item["new_path"].$result['filename']);
                         $image->crop($resize_item["width"],$resize_item["height"],$top_offset,$left_offset)->quality(90);
                         $image->save();
                    }
                } 
                $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filename'];  
            }
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }
        else
        {
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
            echo $return;// it's array
        }
    }        
    
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='events-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionLoadVenueForm()
    {
       //$form=$_POST['form'];
       
        $id=$_POST['id'];
       if(Venues::model()->check_venue_in_db($id))
        {
            $venue = Venues::model()->findByAttributes(array('event_id'=>$id));
        }
        else
        {
            $venue= new Venues;  
        }
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_events.js"));
        Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        $this->renderPartial('application.modules.admin.views.events._formVenue',array('venue'=>$venue));
    }
    public function actionLoadTime()
    {
        $s = $_GET['s'];
        $e = $_GET['e'];
        $this->renderPartial('_loadTime',array('s'=>$s,'e'=>$e));
    }
    
    public function actionRenderForm()
    {
        if(isset($_POST['type']))
        $type= $_POST['type'];
        else
        $type = 'running';
        
        if($type!='triathlon')
        $type = 'running';
        $this->renderPartial('_'.$type.'_form');
    }
    public function get_province($arr){
        foreach($arr['results'] as $a)
        {
            $a = (array)$a;
            $b[] =$a;
        }
        foreach($b[0]['address_components'] as $c)
        {
            $c = (array)$c;
            $d[] = $c;
        }
        foreach($d as $e)
        {
            if($e['types']['0'] =='administrative_area_level_1')
            return $e['short_name'];
        }
        return false;
    }
    public function actionSubmitresult()
    {
        $last =0;
        $checker = $_POST['checker'];
        unset($_POST['checker']);
        
        $arr = explode('_',$checker);
        if($arr[0] == $arr[1])
        {
            $last =1;
            echo 'last';
        }
        
        $_POST['EventResult'] = $_POST;
        $_POST['EventResult']['dist_time'] = $this->createResultTime($_POST['dist_hour'],$_POST['dist_min'],$_POST['dist_sec']);
        $_POST['EventResult']['distance'] = $this->createDistance($_POST['distance']);
        //$_POST['EventResult']['result_date'] = date('Y-m-d');
        if($_POST['is_tri_swim'] || $_POST['is_tri_run'] || $_POST['is_tri_bike'])
        {
            $is_triathlon = 1;
            $model  = new EventTriResult;
        }
        else
        {
           $model  = new EventResult; 
        }
        
        $model->attributes=$_POST['EventResult'];
        $model->save();
        if($last == 1 && isset($is_triathlon))
        {
            $this->saveTri($_POST['EventResult']['event_id'],$_POST['EventResult']['user_id'],$_POST['EventResult']['event_type'],$_POST['EventResult']['result_date']);
        }
        die();
    }
    public function createResultTime($h,$m,$s){
        if(strlen($h)<2)
        $h = '0'.$h;
        if(strlen($m)<2)
        $m = '0'.$m;
        if(strlen($s)<2)
        $s = '0'.$s;
        return $h.':'.$m.':'.$s;
        
    }
    public function createDistance($d)
    {
        $d = str_replace(array(' ','k',','),array('','','.'),$d);
        return $d;
    }
    public function saveTri($id,$uid,$type,$rdate)
    {
        $result = EventTriResult::model()->findAllByAttributes(array('event_id'=>$id));
        if(count($result))
        {
            $arr['user_id'] = $uid;
            $arr['event_id']=$id;
            $arr['event_category'] = 3;
            $arr['event_type'] = $type;
            $arr['result_date'] = $rdate;
            $h = 0;
            $m = 0;
            $s = 0;
            $d = 0;
            $swim = 0;
            $run = 0;
            $tri = 0;
            foreach($result as $r)
            {
                $h = $h+$r->dist_hour;
                $m = $m+$r->dist_min;
                $s = $s+$r->dist_sec;
                if($r->is_tri_swim)
                {
                    $swim = $r->distance;
                }
                if($r->is_tri_run)
                {
                    $run = $r->distance;
                }
                if($r->is_tri_bike)
                {
                    $bike = $r->distance;
                }
                $d = $d+$r->distance;
            }
            $s = $s+($m*60)+($h*60*60);
            $h = $s/3600;
            $h = (int)$h;
            
            $m = ($s - ($h*3600))/60;
            $m = (int)$m;
            
            $s = $s -($h*3600)-($m*60);
            
            $arr['dist_time'] = $this->createResultTime($h,$m,$s);
            $arr['dist_hour'] = $h;
            $arr['dist_min'] = $m;
            $arr['dist_sec'] = $s;
            
            $distance_tri = $swim.'/'.$bike.'/'.$run;
            $arr['distance_tri'] = str_replace('.',',',$distance_tri);
            $arr['distance'] = str_replace(',','.',$d);
            $model  = new EventResult;            
            $model->attributes=$arr;
            $model->save();
            //var_dump($arr);
            return true;
        }
    }
}
