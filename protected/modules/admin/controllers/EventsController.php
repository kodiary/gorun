<?php

class EventsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin';

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
				'users'=>array('@'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
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
        if(!$id){
                $model  = new Events;
                $flash = "Your event has been created. You will be notified once your event in approved.";
            }
        else{
                $model = $this->loadModel($id);
                $flash = "Your event has been updated successfully";
            }
        $model_type  = new EventsType;
        $event_type = EventsType::model()->findAll();
        
        
        
        
        
        
        
        if(isset($_POST['Events']['title']))
        {
          $model->created_by = Yii::app()->user->id;
          if(!$id)
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
           if(!$id)
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
                EventsTime::model()->deleteAllByAttributes(array('event_id'=>$id));
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
                EventsFile::model()->deleteAllByAttributes(array('event_id'=>$id));
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
                
                
                
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - '.$flash);
                if(!$id){
                                $this->sendEventEmail($model->title,$model->slug,$model->created_by);
                                $this->sendAdminEventEmail($model->title,$model->slug,$model->id);
                            }
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

        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_events.js"));
        
        $model=$this->loadModel($id);
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
        
        if(Organisers::model()->check_org_in_db($model->id))
        { 
            $org = Organisers::model()->findByAttributes(array('event_id'=>$id));
        }                
        else
        {
            $org= new Organisers;
            
        }
        $org->setScenario('organiser');
        
        $events_link= EventsLink::model()->findByAttributes(array('event_id'=>$model->id));
        if(!$events_link)
        {
            $events_link=new EventsLink;
        }
	
		if(isset($_POST['Events']))
		{		
			$model->attributes=$_POST['Events'];
            //$model->file = $_POST['file'];
            $model->start_date = date('Y-m-d', strtotime($_POST['Events']['start_date']));
            $model->end_date = date('Y-m-d', strtotime($_POST['Events']['end_date']));
            if($model->start_date > $model->end_date){$model->end_date=$model->start_date;}
            
            if($model->editor_type==0 && $_POST['Events']['basic_editor']!=''){
                $model->description = nl2br($_POST['Events']['basic_editor']);
            }
            
            $slug=CommonClass::getSlug($_POST['Events']['title']);
            $count=0;
            
            $newSlug=$slug;
             //while(Events::model()->findAllByAttributes(array('slug'=>$newSlug)))
            while(Events::model()->findAll(array('condition'=>'id NOT IN ( "'.$model->id.'" ) AND slug = "'.$newSlug.'"')))
            {
                $count++;
                $newSlug=$slug."-".$count;
            }
            $model->slug=$newSlug;
            
            if($_POST['logo']!='')
            {
            //echo $_POST['logo']; die();
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                
                if($model->logo!=$_POST['logo'])
                {
                    @unlink(Yii::app()->basePath."/../images/frontend/original/".$model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/full/".$model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/main/".$model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/thumb/".$model->logo);
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
                
                if($model->organiser== '0'){
                    $org->attributes = $_POST['Organisers'];
                    $org->event_id = $id;
                    $org->save();
                }else{
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
			'model'=>$model,'venue'=>$venue,'org'=>$org,'events_link' =>$events_link
		));
	}


	public function actionExport()
	{
		$model = new Events;
		$this->render('_eventexport',array('model'=>$model));
	}
	
	public function actionExporttoExcel()
    {
	//die('sss');
        if(isset($_POST['submit']))
        {
        	$from = date('Y-m-d', strtotime($_POST['Events']['start_date']));
        	
        	$to = date('Y-m-d', strtotime($_POST['Events']['end_date']));
        		
        	
		$sql = "SELECT e.*, ety.title as `type` ,et.`from` as start_time, et.`to` as end_time ,  ec.title as category ,v.title as venue_title, v.address as venue_address, v.city as venue_city, o.title as organiser
FROM tbl_events as e
  JOIN tbl_events_link as el ON el.event_id = e.id 
 JOIN tbl_events_category as ec ON ec.id = el.category_id 
 JOIN tbl_events_type as ety ON ety.id = el.type_id
LEFT JOIN tbl_events_time as et ON et.event_id = e.id
LEFT  JOIN tbl_venues as v ON v.id = e.venue_id 
 LEFT JOIN tbl_organisers as o ON o.id = e.organiser WHERE start_date >= '$from' AND end_date <= '$to'";

//die($sql);
$DATA = new CSqlDataProvider($sql, array('pagination'=>false));        

        //$c->condition='event_id='.$eventid;
        //$DATA = new CActiveDataProvider('Company', array('criteria'=>$criteria, 'pagination'=>false));
        //var_dump($DATA);die();
        $this->widget('ext.EExcelView', array(
             'dataProvider'=> $DATA,
             'title'=>"EXSA Events",
             'autoWidth'=>false,
             //'filename'=>'',
             'stream'=>true,
             //'exportType'=>'Excel5',
             'grid_mode'=>'export',
             'columns'=>array(
                'title',
                'type',
                'category',
                'description',
                'start_date',
                'end_date',
                //'venue_title',
                //'venue_address',
                //'venue_city',
                //'organiser',
                'start_time',
                'end_time',
                
            ),
        ));
        //ExcelExporter::sendAsXLS($DATA, true, 'data.xlsx');
        Yii::app()->end();
        }
    }

    public function actionEvent_time()
    {
        $id = $_POST['id'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $day = $_POST['day'];
        
        $this->renderPartial('_event_times',array(
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

             Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The event has been deleted successfully!'); 
             
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/events/'));
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
	public function actionIndex($filter="")
	{
        $condition="(start_date<>'0000-00-00' AND visible = 1 AND (end_date <>'0000-00-00' AND end_date<>'1970-01-01') AND end_date >='".date('Y-m-d')."' ) OR  ((end_date ='0000-00-00' OR end_date<='1970-01-01') AND start_date>= '".date('Y-m-d')."')";
        
        if(isset($_GET['keyword']))$condition=" title like '%".$_GET['keyword']."%' OR id ='".$_GET['keyword']."'";
        if($filter=="") $order='title ASC';
        if($filter=="expired")
        {
          $condition="(start_date<>'0000-00-00' AND (end_date <>'0000-00-00' AND end_date<>'1970-01-01') AND end_date < '".date('Y-m-d')."' ) OR  ((end_date ='0000-00-00' OR end_date<='1970-01-01') AND start_date< '".date('Y-m-d')."')";
          $order='title ASC';
        } 
        if($filter=="oldest") $order='id ASC';

        if($filter=="draft")
        {
            $condition="visible = 0";
            $order='title ASC';
        } 
        
        $criteria = new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order = $order;
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Events',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Events',array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>Yii::app()->params['items_pers_page'])));  

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'filter'=>$filter,
            'pages'=>$pages
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
     
        $folder=Yii::app()->basePath.'/../documents/temp/';// folder to upload file
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
        $this->renderPartial('_formVenue',array('venue'=>$venue));
    }
    
    public function actionLoadOrganiserForm()
    {
        $id=$_POST['id'];
        if(Organisers::model()->check_org_in_db($id))
        { 
            $org = Organisers::model()->findByAttributes(array('event_id'=>$id));
         
        }                
        else
        {
            $org= new Organisers;
            
        }
        $org->setScenario('organiser');
        $this->renderPartial('_formOrganiser',array('org'=>$org));
    }

    public function actionPostFB()
    {
        $back = $_GET['back_url'];
        $id = $_GET['id'];
        if($id)
        {            
            $url="";
            $model = Events::model()->findByPk($id);
            if($model)
            {                
                $url=$this->createAbsoluteUrl('/events/'.$model->slug);
                $filename = $model->logo;
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$filename) && $filename)
                {
                    $imageUrl = $this->createAbsoluteUrl('/images/frontend/thumb/'.$filename);
                }
                else
                {
                    $imageUrl = $this->createAbsoluteUrl('/images/article_fallback_80x80.png');
                }
            }           
            if($model)
            {
                //initilization
                $info['title'] = $model->title;
                $detail = strip_tags($model->description);
                $info['link'] = $url;
                $info['description'] = CommonClass::limit_text($detail,'100');
                $info['image'] = $imageUrl;

                $success_msg = '';
                $error_msg = '';
                $fb_report = false;

                    //autopost for facebook
                    if(CommonClass::autoFacebookPost($info)){
                        //$model = new Articles;
                        //$model->updateByPk($id, array('fb_post'=>1));
                        $success_msg = 'Your item has been successfully posted in your facebook page.';
                        $fb_report = true;
                    }
                    else{
                        $error_msg = 'Your item could not be posted to your facebook page.';
                        $fb_report = false;
                    }           
                if($fb_report==true) {
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> '.$success_msg);
                    $model->is_facebook = 1;
                    $model->save();
                }
                
                elseif($fb_report==false)
                    Yii::app()->user->setFlash('error', '<strong>Error!</strong> '.$error_msg);
                    
                else
                    Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> '.$success_msg.$error_msg);
            }
            $this->redirect(array($back, 'id'=>$id));
        }        
    }

    public function actionPostTwit()
    {
        $back = $_GET['back_url'];
        $id = $_GET['id'];
        if($id)
        {
            $url="";
            $model = Events::model()->findByPk($id);
            if($model)
            {
                $url=$this->createAbsoluteUrl('/events/'.$model->slug);
                $filename = $model->logo;
                if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$filename) && $filename)
                {
                    $imageUrl = $this->createAbsoluteUrl('/images/frontend/thumb/'.$filename);
                }
                else
                {
                    $imageUrl = $this->createAbsoluteUrl('/images/events_fallback_thumb.png');
                }
            }            
            if($model)
            {
                //initilization
                $info['title'] = $model->title;
                $detail = strip_tags($model->description);
                $info['link'] = $url;
                $info['description'] = CommonClass::limit_text($detail,'100');
                $info['image'] = $imageUrl;

                $success_msg = '';
                $error_msg = '';
                    //autopost for twitter
                    if(CommonClass::autoTwitterPost($info)){
                        //$model = new Articles;
                        //$model->updateByPk($id, array('twitter_post'=>1));
                        $success_msg .= '<br />Your item has been successfully posted in your twitter page.';
                        $twitter_report = true;
                    }
                    else{
                        $error_msg .= '<br />Your item could not be posted to your twitter page.';
                        $twitter_report = false;
                    }    
                //conditional check
                if($twitter_report==true) {
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> '.$success_msg);
                    $model->is_twitter = 1;
                    $model->save();
                }
                elseif($twitter_report==false)
                    Yii::app()->user->setFlash('error', '<strong>Error!</strong> '.$error_msg);                
                else
                    Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> '.$success_msg.$error_msg);
            }
        }
        $this->redirect(array($back, 'id'=>$id));
    }
}