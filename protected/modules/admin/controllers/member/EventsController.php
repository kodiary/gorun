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
	public function actionCreate()
	{
	    $company_id=$_GET['id'];
        $model=Company::model()->findByPk($company_id);
        $model->scenario="companyInfo";
	   //$company_id=Yii::app()->user->getId();
       
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_events.js"));
        //Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        
        $event_model  = new Events;
        $event_model->visible=1;
        $venue  = new Venues;
         
        $events_link= new EventsLink;
        
		if(isset($_POST['Events']))
		{
		   $event_model->attributes=$_POST['Events'];
           $event_model->file = $_POST['file'];
           $event_model->start_date = date('Y-m-d', strtotime($_POST['Events']['start_date']));
           $event_model->end_date = date('Y-m-d', strtotime($_POST['Events']['end_date']));
           $event_model->organiser=$company_id;
           
           if($event_model->start_date > $event_model->end_date){$event_model->end_date=$event_model->start_date;}
           
           $event_model->editor_type = $_POST['Events']['editor_type'];
           if($event_model->editor_type==0 && $_POST['Events']['basic_editor']!=''){
                $event_model->description = nl2br($_POST['Events']['basic_editor']);
           }
           
           //getSlug
           $slug=CommonClass::getSlug($_POST['Events']['title']);
           $count=0;
           while(Events::model()->findAllByAttributes(array('slug'=>$slug)))
           {
                $count++;
                $slug=$slug."-".$count;
           }
           $event_model->slug=$slug;
   
                
           if($_POST['logo']!='')
           {
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
                
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                $event_model->logo = $_POST['logo'];                
           }
           
            if($_POST['file']!="" )
            {
                @copy(Yii::app()->basePath.'/../documents/temp/'.$_POST['file'],Yii::app()->basePath.'/../documents/'.$_POST['file']);
                @unlink(Yii::app()->basePath."/../documents/temp/".$_POST['file']);   
                $event_model->file=$_POST['file'];
            }       
			if($event_model->save())
            {   
                $id = $event_model->id;      
                
                $events_link->attributes = $_POST['EventsLink'];
                $events_link->event_id = $id;
                $events_link->save();
                               
                
                if($event_model->venue_id=='0')
                {
                    $venue->attributes = $_POST['Venues'];
                    $venue->event_id = $id;
                    $venue->save();
                } 
            
                if($_POST['times'] == 'on')
                {
                    foreach($_POST['on_date'] as $key=>$date)
                    {
                        $time = new EventsTime;
                        $time->on_date = $date;
                        $time->from = $_POST['from'][$key];
                        $time->to = $_POST['to'][$key];
                        $time->event_id = $id;
                        $time->save();
                    }
                }
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - A new event has been added successfully!');
				$this->redirect(array('index','id'=>$model->id));
            }   
		}
        
		$this->render('create',array(
			'model'=>$model,'event_model'=>$event_model,'venue'=>$venue,'events_link' =>$events_link
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
        //$company_id=Yii::app()->user->getId();
		$company_id=$_GET['id'];
        $model=Company::model()->findByPk($company_id);
        $model->scenario="companyInfo";
        
        //get event id
        $id=$_GET['eventId'];
        $event_model=$this->loadModel($id);
       
        Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=false");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.components')."/gmap/gmap_events.js"));
        if($event_model->venue_id=="0")
        {
            Yii::app()->clientScript->registerScript('init','initialize();',CClientScript::POS_LOAD);
        }
        if(Venues::model()->check_venue_in_db($event_model->id))
        {
            $venue = Venues::model()->findByAttributes(array('event_id'=>$id));
        }
        else
        {
            $venue= new Venues;  
        }
        
        $events_link= EventsLink::model()->findByAttributes(array('event_id'=>$event_model->id));
        if(!$events_link)
        {
            $events_link=new EventsLink;
        }
            
		if(isset($_POST['Events']))
		{		
			$event_model->attributes=$_POST['Events'];
            $event_model->start_date = date('Y-m-d', strtotime($_POST['Events']['start_date']));
            $event_model->end_date = date('Y-m-d', strtotime($_POST['Events']['end_date']));
            $event_model->organiser=$company_id;
            
            if($event_model->start_date > $event_model->end_date){$event_model->end_date=$event_model->start_date;}
            
            $event_model->editor_type = $_POST['Company']['editor_type'];
            if($event_model->editor_type==0 && $_POST['Events']['basic_editor']!=''){
                $event_model->description = nl2br($_POST['Events']['basic_editor']);
            }
            
            $slug=CommonClass::getSlug($_POST['Events']['title']);
            $count=0;
            
            $newSlug=$slug;
            while(Events::model()->findAllByAttributes(array('slug'=>$newSlug)))
            {
                $count++;
                $newSlug=$slug."-".$count;
            }
            $event_model->slug=$newSlug;
            
            if($_POST['logo']!='')
            {
                @copy(Yii::app()->basePath.'/../images/temp/full/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/full/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/main/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/main/'.$_POST['logo']);
                @copy(Yii::app()->basePath.'/../images/temp/thumb/'.$_POST['logo'],Yii::app()->basePath.'/../images/frontend/thumb/'.$_POST['logo']);
               
                @unlink(Yii::app()->basePath."/../images/temp/main/".$_POST['logo']);
                @unlink(Yii::app()->basePath."/../images/temp/thumb/".$_POST['logo']);
                
                if($event_model->logo!=$_POST['logo'])
                {
                    @unlink(Yii::app()->basePath."/../images/frontend/original/".$event_model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/full/".$event_model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/main/".$event_model->logo);
                    @unlink(Yii::app()->basePath."/../images/frontend/thumb/".$event_model->logo);
                }
                $event_model->logo = $_POST['logo'];                
            }
                
            $id = $event_model->id;                
                                    
            if($_POST['file']!="" )
            {
                @copy(Yii::app()->basePath.'/../documents/temp/'.$_POST['file'],Yii::app()->basePath.'/../documents/'.$_POST['file']);
                @unlink(Yii::app()->basePath."/../documents/temp/".$_POST['file']);   
                if($event_model->file!=$_POST['file'])
                {
                    @unlink(Yii::app()->basePath."/../documents/".$event_model->file);   
                }
                $event_model->file=$_POST['file'];
            } 
             
            if($event_model->save())
            {
                $events_link->attributes = $_POST['EventsLink'];
                $events_link->event_id = $id;
                $events_link->save();
                
                if($event_model->venue_id=='0'){
                    $venue->attributes = $_POST['Venues']; 
                    $venue->event_id = $id;
                    $venue->save();
                }else{
                    Venues::model()->deleteAllByAttributes(array('event_id'=>$event_model->id));
                }
                
                if($event_model->organiser!='0'){
                    Organisers::model()->deleteAllByAttributes(array('event_id'=>$event_model->id));    
                } 
                
                if($_POST['times'] == 'on')
                {
                    foreach($_POST['on_date'] as $key=>$date)
                    {
                        if(EventsTime::check_event_time_in_db($event_model->id,$date))
                        {
                            $time=EventsTime::model()->findByAttributes(array('event_id'=>$event_model->id,'on_date'=>$date));
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
			    $this->redirect(array('update','id'=>$model->id,'eventId'=>$event_model->id));
            }  
		}
        
		$this->render('create',array(
			'model'=>$model,'venue'=>$venue,'events_link' =>$events_link,'event_model'=>$event_model
		));
	}

 public function actionEvent_time()
    {
        $sel_from = " \t ".
            '<select id="From" class="span2" name="from[]">
                <option value="11:30 AM">11:30 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="12:30 PM">12:30 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="1:30 PM">1:30 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="2:30 PM">2:30 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="3:30 PM">3:30 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="4:30 PM">4:30 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="5:30 PM">5:30 PM</option>
                <option value="6:00 PM">6:00 PM</option>
                <option value="6:30 PM">6:30 PM</option>
                <option value="7:00 PM">7:00 PM</option>
                <option value="7:30 PM">7:30 PM</option>
                <option value="8:00 PM">8:00 PM</option>
                <option value="8:30 PM">8:30 PM</option>
                <option value="9:00 PM">9:00 PM</option>
                <option value="9:30 PM">9:30 PM</option>
                <option value="10:00 PM">10:00 PM</option>
                <option value="10:30 PM">10:30 PM</option>
                <option value="11:00 PM">11:00 PM</option>
                <option value="11:30 PM">11: 30 PM</option>
                <option value="12:00 AM">12:00 AM</option>
                <option value="12:30 AM">12:30 AM</option>
                <option value="1:00 AM">1:00 AM</option>
                <option value="1:30 AM">1:30 AM</option>
                <option value="2:00 AM">2:00 AM</option>
                <option value="2:30 AM">2:30 AM</option>
                <option value="3:00 AM">3:00 AM</option>
                <option value="3:30 AM">3:30 AM</option>
                <option value="4:00 AM">4:00 AM</option>
                <option value="4:30 AM">4:30 AM</option>
                <option value="5:00 AM">5:00 AM</option>
                <option value="5:30 AM">5:30 AM</option>
                <option value="6:00 AM">6:00 AM</option>
                <option value="6:30 AM">6:30 AM</option>
                <option value="7:00 AM">7:00 AM</option>
                <option value="7:30 AM">7:30 AM</option>
                <option value="8:00 AM">8:00 AM</option>
                <option value="8:30 AM">8:30 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="9:30 AM">9:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                </select>'. '  -  ';
        $sel_to= '<select id="To" class="span2" name="to[]">
                <option value="11:30 AM">11:30 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="12:30 PM">12:30 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="1:30 PM">1:30 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="2:30 PM">2:30 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="3:30 PM">3:30 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="4:30 PM">4:30 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="5:30 PM">5:30 PM</option>
                <option value="6:00 PM">6:00 PM</option>
                <option value="6:30 PM">6:30 PM</option>
                <option value="7:00 PM">7:00 PM</option>
                <option value="7:30 PM">7:30 PM</option>
                <option value="8:00 PM">8:00 PM</option>
                <option value="8:30 PM">8:30 PM</option>
                <option value="9:00 PM">9:00 PM</option>
                <option value="9:30 PM">9:30 PM</option>
                <option value="10:00 PM">10:00 PM</option>
                <option value="10:30 PM">10:30 PM</option>
                <option value="11:00 PM">11:00 PM</option>
                <option value="11:30 PM">11: 30 PM</option>
                <option value="12:00 AM">12:00 AM</option>
                <option value="12:30 AM">12:30 AM</option>
                <option value="1:00 AM">1:00 AM</option>
                <option value="1:30 AM">1:30 AM</option>
                <option value="2:00 AM">2:00 AM</option>
                <option value="2:30 AM">2:30 AM</option>
                <option value="3:00 AM">3:00 AM</option>
                <option value="3:30 AM">3:30 AM</option>
                <option value="4:00 AM">4:00 AM</option>
                <option value="4:30 AM">4:30 AM</option>
                <option value="5:00 AM">5:00 AM</option>
                <option value="5:30 AM">5:30 AM</option>
                <option value="6:00 AM">6:00 AM</option>
                <option value="6:30 AM">6:30 AM</option>
                <option value="7:00 AM">7:00 AM</option>
                <option value="7:30 AM">7:30 AM</option>
                <option value="8:00 AM">8:00 AM</option>
                <option value="8:30 AM">8:30 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="9:30 AM">9:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                </select>';
        if(isset($_POST['id']))
        {
            $id= $_POST['id'];
            $times = EventsTime::model()->findAllByAttributes(array('event_id'=>$id));
            
            foreach($times as $time)
            { 
               
                $test_from='<option value="'.$time->from.'">'.$time->from.'</option>';
                $replace_from='<option value="'.$time->from.'" selected>'.$time->from.'</option>';
                $sel_from=str_replace($test_from,$replace_from,$sel_from);//select that is saved in db -- from
               
                $test_to='<option value="'.$time->to.'">'.$time->to.'</option>';
                $replace_to='<option value="'.$time->to.'" selected>'.$time->to.'</option>';
                $sel_to=str_replace($test_to,$replace_to,$sel_to);//select that is saved in db -- to
                echo "<div><input type='hidden' name='on_date[]' value='".date('Y-m-d',strtotime($time->on_date))."' />";
                echo "<div class='event_date'>".date('l, d F Y' ,strtotime($time->on_date))."</div>".$sel_from.$sel_to."</div>";
                
            }
             
        }
        else
        {
            $start = $_POST['start'];
            $end = $_POST['end'];
            $day = $_POST['day'];
            
            echo "<div><input type='hidden' name='on_date[]' value='".date('Y-m-d', strtotime($start))."' />";        
            echo "<div class='event_date'>".date('l, d F Y' ,strtotime($start))."</div>".$sel_from.$sel_to."</div>";
            
            for($i=1; $i<=$day; $i++)
            {
                echo "<div><input type='hidden' name='on_date[]' value='".date('Y-m-d',strtotime($start)+($i*24*60*60))."' />";
                echo "<div class='event_date'>".date('l, d F Y' ,strtotime($start)+($i*24*60*60))."</div>".$sel_from.$sel_to."</div>";
            }
        }
        
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$eventId)
	{
       //echo $id;die();
		if($eventId)//Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            Venues::model()->deleteAllByAttributes(array('event_id'=>$eventId));
            Organisers::model()->deleteAllByAttributes(array('event_id'=>$eventId));
            EventsTime::model()->deleteAllByAttributes(array('event_id'=>$eventId)); 
            EventsLink::model()->deleteAllByAttributes(array('event_id'=>$eventId));
            $this->actionDeleteImages($eventId);
            $this->actionDeleteDocuments($eventId);
			$this->loadModel($eventId)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - The event has been deleted successfully!'); 
			
            if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('member/events/index/','id'=>$id));
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
	   $id=$_GET['id'];
	   $model=Company::model()->findByPk($id);
        $model->scenario="companyInfo";
 
        
        //$id=Yii::app()->user->getId();
        
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
            'model'=>$model,
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
}
