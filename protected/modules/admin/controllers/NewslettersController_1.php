<?php
class NewslettersController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
			
				'users'=>array('@'),
			)
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->redirect('index');
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(isset($_POST['submitTemplate']))
		{ 
			$temp = $_POST['temp_id'];
            if($temp!="") $this->redirect(array('/admin/newsletters/details/template/'.$temp));
            else $this->redirect(array('/admin/newsletters/details'));
		}
        $templates=NewslettersTemplate::model()->findAll();
		$this->render('create',array(
            'templates'=>$templates
		));
	}
    
    public function actionLists($nid='')
    {
        if(isset($_POST['submit']))
        {
            if(isset($_POST['Newsletter_list']['list_id']))
            {
                $nid = $_GET['nid'];
                NewsletterList::model()->deleteAllByAttributes(array('newsletter_id'=>$nid));
                foreach($_POST['Newsletter_list']['list_id'] as $list)
                {
                    $s = new NewsletterList;
                    $s->newsletter_id = $nid;
                    $s->list_id = $list;
                    $s->save();
                }
                $this->redirect(array('/admin/newsletters/preview/nid/'.$nid));        
            }
        }
        $this->render('chooseList', array('listModel'=>$listModel));    
    }
    
    public function actionDetails($nid="")
    {
        if($nid)$model=$this->loadModel($nid);
        else $model=new Newsletters;
       
       if(isset($_GET['template']))
            $template=$_GET['template'];
       else
            $template = "";    
        if($template!="")
        {
            $t = NewslettersTemplate::model()->findByPk($template);
			$model->detail = $t->content;
			$model->subject = $t->title; 
        }
         // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if(isset($_POST['Newsletters']))
		{
			if(!$nid)
            {
    			 $number=Newsletters::findmaxnumber()+1;
    			 $model->number = $number;
			}
			$model->attributes=$_POST['Newsletters'];
			$model->pub_date = date('Y-m-d', strtotime($model->pub_date));
			 //if(strpos($model->detail,'src="http://exsa.co.za')==false)
			  if(strpos($model->detail,'src="/files/')!=false)
			$model->detail = str_replace('src="', 'src="http://exsa.co.za', $model->detail);
			
            $model->template_id=$_POST['template'];
			if($model->save())
            {
                //pre-build newsletter
                $model=$this->loadModel($model->id);
                $content=$this->renderPartial('_buildNewsletter',array('model'=>$model),true);
                $file = "newsletter".$model->number.'.html';
                $handler = fopen(Yii::app()->basePath.'/../newsletters/'.$file,'w+') or die('cant create file');
                fwrite($handler,$content);
                fclose($handler);
                
                $this->redirect(array('/admin/newsletters/items/nid/'.$model->id));
            }
		}
    	$this->render('details',array(
        'model'=>$model
	   ));
    }
    public function actionItems($nid)
    {
        $model=$this->loadModel($nid);
        $itemModel=new NewsletterItems;
        
        if(isset($_POST['addArticles']))
        {
           $itemModel->attributes= $_POST['NewsletterItems'];
           $itemModel->item_type=1;
           $itemModel->newsletter_id=$nid;
           if($itemModel->save())
           Yii::app()->user->setFlash('info', '<strong>Success!</strong> Your changes have been saved successfully .');
        }  
        if(isset($_POST['addEvents']))
        {
           $itemModel->attributes= $_POST['NewsletterItems'];
           $itemModel->item_type=2;
           $itemModel->newsletter_id=$nid;
           if($itemModel->save())
           Yii::app()->user->setFlash('info', '<strong>Success!</strong> Your changes have been saved successfully .');
        }          
       	$nitems['articles'] = NewsletterItems::getAllNewsletterItemsByType($nid,1); 
        $nitems['events'] = NewsletterItems::getAllNewsletterItemsByType($nid,2); 
		        
   	    $this->render('items',array(
        'model'=>$model,
        'nitems'=>$nitems,
        'itemModel'=>$itemModel,
	   ));
    }
    
    public function actionDeleteitem($id)
    {
        if(NewsletterItems::model()->deleteByPk($id))
        Yii::app()->user->setFlash('info', '<strong>Success!</strong> Your item has been deleted successfully.');
        $this->redirect(Yii::app()->request->urlReferrer);
    }
    function actionBuild($nid)
    {
        $model=$this->loadModel($nid);
        $nitems['articles'] = NewsletterItems::getAllNewsletterItemsByType($nid,1);
        $nitems['events'] = NewsletterItems::getAllNewsletterItemsByType($nid,2);
        $content=$this->renderPartial('_buildNewsletter',array('model'=>$model,'nitems'=>$nitems),true);
        $file = "newsletter".$model->number.'.html';
        $handler = fopen(Yii::app()->basePath.'/../newsletters/'.$file,'w+') or die('cant create file');
        fwrite($handler,$content);
        fclose($handler);
        $this->redirect(array('/admin/newsletters/preview/nid/'.$nid));
    }
    
    public function actionPreview($nid)
    {
        $model=$this->loadModel($nid);
        $this->render('preview',array('model'=>$model));
    }
    
    public function actionTestnewsletter($nid)
    {
        if(isset($_POST['btnSubmit']))
        {
            $email=$_POST['email'];
            if($email!="")
            {
                $model=$this->loadModel($nid);
                $subject=$model->subject;
                $file=Yii::app()->basePath.'/../newsletters/newsletter'.$model->number.".html";
                if(file_exists($file))
                {
                    $body=file_get_contents($file);
                    if(CommonClass::sendEmail('','',$email, $subject, $body,'noreply@exsa.co.za'))
                     Yii::app()->user->setFlash('info', '<strong>Success!</strong> Your test email has been sent successfully. Please check your mail.');
                }
            }
        }
        $this->render('testNewsletter');
    }
    
    public function actionSend()
    {
        $criteria = new CDbCriteria;
        $criteria->order="id desc";
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Newsletters',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Newsletters',array('criteria'=>$criteria));
       
		$this->render('sendNewsletter',array(
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
    }
    
    public function actionSendNewsletter($nid)
    {
        $model=$this->loadModel($nid);
        $subscribers = Subscribers::getActiveSubscribers($model->id);
        $file = Yii::app()->basePath.'/../newsletters/newsletter'.$model->number.".html";
        if(file_exists($file) && $subscribers)
        {
            $content=file_get_contents($file);
            
             if($subscribers)
            {
                $receivers="";
                $receivers_array = array();
                foreach($subscribers as $recipient)
                {
                   $receivers_array[] = $recipient->email;
                   $receivers.= $recipient->email.",";
                }
            }

            $subject = $model->subject;
            $body = file_get_contents($file);
            $reply_to = 'exsa@exsa.co.za';
            
            //if($receivers!='' && CommonClass::sendEmail('','',$receivers, $subject, $body, $reply_to))
            if($receivers!='' && CommonClass::sendNewsletter('','',$receivers_array, $subject, $body, $reply_to))
            {
               Yii::app()->user->setFlash('info', '<strong>Success!</strong> You newsletter has been sent successfully.');
               $model->send_status = 2;
               $model->send_date = date('Y-m-d');
               $model->recipients_no = count($subscribers);
               $model->save(); 
            }
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if($id)
        {
		  $model=$this->loadModel($id);
          
		  //delete the generated newsletter if exists
          if(file_exists(Yii::app()->basePath.'/../newsletters/newsletter'.$model->number.".html"))
          @unlink(Yii::app()->basePath.'/../newsletters/newsletter'.$model->number.".html");
          
          //delete the newsletter items
          NewsletterItems::deleteAllItemsByNewsletter($id);
          
          //delete newsletter
          $model->delete();
		}
        $this->redirect(array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $criteria = new CDbCriteria;
        $criteria->order="id desc";
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Newsletters',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Newsletters',array('criteria'=>$criteria));
       
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
		$model=Newsletters::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    function actionCountEmail()
    {
        $arr = explode(',',$_POST['ids']);
        $count = count($arr);
        $condition = '';
        for($i=0;$i<($count-1);$i++)
        {
            if($i!=($count-2))
            $condition = $condition.'list_id = '.$arr[$i].' OR ';
            else
            $condition = $condition.'list_id = '.$arr[$i];
        }
        if($condition != '')
        $nl = SubscribersDetail::model()->findAll(array('condition'=>$condition));
        else
        $nl = SubscribersDetail::model()->findAll();
        if($nl)
        {
            $i = 0;
            foreach($nl as $n)
            {
                $i++;
                if($i == 1)
                {
                    $array[] = $n->subscriber_id;
                }
                else
                {
                    if(!in_array($n->subscriber_id,$array))
                    {
                        $array[] = $n->subscriber_id;
                    }
                }
            }
        }
        if(isset($array) && !empty($array))
        {
            echo $c = count($array);
        }
        else
        echo 0;
    }

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='newsletters-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}