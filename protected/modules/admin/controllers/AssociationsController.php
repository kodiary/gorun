<?php

class AssociationsController extends Controller
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
	    $model = new Associations;
        
        if(isset($_POST['Associations']))
		{
			$model->attributes=$_POST['Associations'];
            if($id = $_POST['Associations']['id'])//for update
            {
                if($_POST['ImageName']!="")
                {
                   $filename = Associations::associationImage($id);
                   
                   $model->ass_logo=$_POST['ImageName'];
                   if(Yii::app()->file->set('images/temp/full/'.$model->ass_logo)->exists)
                   {
                        $full = Yii::app()->file->set('images/temp/full/'.$model->ass_logo);
                        $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$model->ass_logo);
                        $full->delete();
                   }
                   if(Yii::app()->file->set('images/temp/main/'.$model->ass_logo)->exists)
                   {
                        $main = Yii::app()->file->set('images/temp/main/'.$model->ass_logo);
                        $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->ass_logo);
                        $main->delete();
                   }
                   if(Yii::app()->file->set('images/temp/thumb/'.$model->ass_logo)->exists)
                   {
                        $thumb = Yii::app()->file->set('images/temp/thumb/'.$model->ass_logo);
                        $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->ass_logo);
                        $thumb->delete();
                   }
                   Associations::model()->updateByPk($id, array('ass_name'=>$model->ass_name, 'ass_logo'=>$model->ass_logo));
                   if($filename) $this->actionDeleteImages($filename);
                }
                else
                    Associations::model()->updateByPk($id, array('ass_name'=>$model->ass_name));
                
                CommonClass::makeSlug($model, $model->ass_name, $model->id);    
                Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your association has been successfully updated.');
            }
            else{
                if($_POST['ImageName']!="")
                {
                   $model->ass_logo=$_POST['ImageName'];
                   if(Yii::app()->file->set('images/temp/full/'.$model->ass_logo)->exists)
                   {
                        $full = Yii::app()->file->set('images/temp/full/'.$model->ass_logo);
                        $full->copy(Yii::app()->basePath.'/../images/frontend/full/'.$model->ass_logo);
                        $full->delete();
                   }
                   if(Yii::app()->file->set('images/temp/main/'.$model->ass_logo)->exists)
                   {
                        $main = Yii::app()->file->set('images/temp/main/'.$model->ass_logo);
                        $main->copy(Yii::app()->basePath.'/../images/frontend/main/'.$model->ass_logo);
                        $main->delete();
                   }
                   if(Yii::app()->file->set('images/temp/thumb/'.$model->ass_logo)->exists)
                   {
                        $thumb = Yii::app()->file->set('images/temp/thumb/'.$model->ass_logo);
                        $thumb->copy(Yii::app()->basePath.'/../images/frontend/thumb/'.$model->ass_logo);
                        $thumb->delete();
                   }
                }
                if($model->save()){
                    CommonClass::makeSlug($model, $model->ass_name, $model->id);
                    Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your association has been successfully added.');
                }
            }
            $this->redirect(array('index'));
		}
                
        $criteria = new CDbCriteria;
        $criteria->order = 't.id DESC';
        
        $pages='';
        if(isset($_GET['showall'])){
            $dataProvider= new CActiveDataProvider('Associations',array('criteria'=>$criteria, 'pagination'=>false));
            $pages = new CPagination($dataProvider->totalItemCount);
            $pages->pageSize = Yii::app()->params['items_pers_page'];
            $pages->applyLimit($criteria);
        }
        else
            $dataProvider= new CActiveDataProvider('Associations',array('criteria'=>$criteria));
       
		$this->render('index',array(
            'model'=>$model,
			'dataProvider'=>$dataProvider,
            'pages'=>$pages,
		));
	}

    public function actionGetAssociation()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $id = $_POST['id'];
            if($id)
            {
                $name = Associations::associationVal($id);
                $file = Yii::app()->baseUrl.'/images/frontend/thumb/'.Associations::associationImage($id);
                echo json_encode(array(
                    "name" => $name, 
                    "image" => $file
                ));
                die();
            }
            else{
                echo '';
                die();
            }
        }
    }
    
    public function actionDeleteAssociation($id)
    {
        if($id){
            $filename = Associations::associationImage($id);
            if($filename)
                $this->actionDeleteImages($filename);           
            Associations::model()->deleteByPk($id);
            Yii::app()->user->setFlash('success', '<strong>SUCCESS</strong> - Your association has been successfully deleted.');
            $this->redirect(array('index'));
        }
        $this->redirect(array('index'));
          
    }

    public function actionDeleteImages($filename)
    {
        if($filename){
            $filepath = Yii::app()->basePath.'/../images/frontend/';
            $temppath = Yii::app()->basePath.'/../images/temp/';
            
            if(file_exists($filepath.'full/'.$filename) && $filename)
                @unlink($filepath.'full/'.$filename);
            if(file_exists($filepath.'main/'.$filename) && $filename)
                @unlink($filepath.'main/'.$filename);
            if(file_exists($filepath.'thumb/'.$filename) && $filename)
                @unlink($filepath.'thumb/'.$filename);
            
            if(file_exists($temppath.'full/'.$filename) && $filename)
                @unlink($temppath.'full/'.$filename);
            if(file_exists($temppath.'main/'.$filename) && $filename)
                @unlink($temppath.'main/'.$filename);
            if(file_exists($temppath.'thumb/'.$filename) && $filename)
                @unlink($temppath.'thumb/'.$filename);  
        }
    }
    
    public function actionUpload($case)
    {
            Yii::import("ext.EAjaxUpload.qqFileUploader");
     
            $folder=Yii::app()->basePath.'/../images/temp/full/';// folder to upload file
            $allowedExtensions = array("jpg","jpeg",'gif','png');
            $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            if($result['success'])
            {
                 $file=$folder.$result['filename'];
                 $result['imageFull']=Yii::app()->baseUrl.'/images/temp/full/'.$result['filename'];
                 
                 Yii::import('application.extensions.image.Image');
                 $resize_detail=CommonClass::get_resize_details($case);
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
                 $result['imageThumb']=Yii::app()->baseUrl.'/images/temp/thumb/'.$result['filename'];  
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
}