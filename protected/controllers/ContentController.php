<?php
class ContentController extends Controller
{
    public $metaDesc;
    public $metaKeys;
    public $pageTitle;
    public function actionIndex()
    {
        $this->render('index');    
    }

    public function actionAbout()
	{
        $slug = 'about';
        $about = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$about)
            $this->render('invalid',array('model'=>$model));
        else{        
            $this->pageTitle=$about['meta_title'];        
            $this->metaDesc=trim(strip_tags($about['meta_desc']));
            $this->metaKeys=$about['meta_keywords'];
            $model=Contents::model()->find(array(
            'condition'=>"page_seo='$slug' AND status=1",
            ));
        $this->render('index',array('model'=>$model));
        }
    }
    
	public function actionTerms()
	{
        $slug = 'terms-and-conditions';
        $terms = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$terms)
            $this->render('invalid',array('model'=>$model));
        else{        
        $this->pageTitle=$terms['meta_title'];        
        $this->metaDesc=trim(strip_tags($terms['meta_desc']));
        $this->metaKeys=$terms['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
        $this->render('index',array('model'=>$model));
        }
    }

	public function actionPrivacy()
	{
        $slug = 'privacy-policy';
        $privacy = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$privacy)
            $this->render('invalid',array('model'=>$model));
        else{
        $this->pageTitle=$privacy['meta_title'];        
        $this->metaDesc=trim(strip_tags($privacy['meta_desc']));
        $this->metaKeys=$privacy['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
            $this->render('index',array('model'=>$model));
        }
    }
    
    public function actionNewsGuidelines()
	{
        $slug = 'news-guidelines';
        $guidelines = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$guidelines)
            $this->render('invalid',array('model'=>$model));
        else{
        $this->pageTitle=$guidelines['meta_title'];        
        $this->metaDesc=trim(strip_tags($guidelines['meta_desc']));
        $this->metaKeys=$guidelines['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
            $this->render('index',array('model'=>$model));
        }
    }
	public function actionAdvertise()
	{
        $slug = 'advertise';
        $advertise = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$advertise)
            $this->render('invalid',array('model'=>$model));
        else{
        $this->pageTitle=$advertise['meta_title'];        
        $this->metaDesc=trim(strip_tags($advertise['meta_desc']));
        $this->metaKeys=$advertise['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
            $this->render('index',array('model'=>$model));
        }
    }
    public function actionContract()
	{
        $slug = 'contract';
        $content = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$content)
            $this->render('invalid',array('model'=>$model));
        else{
        $this->pageTitle=$content['meta_title'];        
        $this->metaDesc=trim(strip_tags($content['meta_desc']));
        $this->metaKeys=$content['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
            $this->render('index',array('model'=>$model));
        }
    }
    
	public function actionMembership()
	{
        $slug = 'membership';
        $membership = Contents::model()->findByAttributes(array('page_seo'=>$slug,'status'=>'1'));
        if(!$membership)
            $this->render('invalid',array('model'=>$model));
        else{
        $this->pageTitle=$membership['meta_title'];        
        $this->metaDesc=trim(strip_tags($membership['meta_desc']));
        $this->metaKeys=$membership['meta_keywords'];
        $model=Contents::model()->find(array(
        'condition'=>"page_seo='$slug' AND status=1",
            ));
            $this->render('index',array('model'=>$model));
        }
    }
    
    public function actionSubPages($subpage)
	{
        $sub = Contents::model()->findByAttributes(array('page_seo'=>$subpage,'status'=>'1'));
        if(!$sub)
            $this->render('invalid',array('model'=>$model));
        else{
            $parentModel = Contents::model()->findByPk($sub->parent);
            
            $this->pageTitle= ucwords($sub->title)." | EXSA - Exhibition Association of Southern Africa";        
            $this->metaDesc=trim(strip_tags($sub['meta_desc']));
            $this->metaKeys=$sub['meta_keywords'];
                $this->render('view',array('model'=>$sub,'parent'=>$parentModel));
        }
    } 
}
?>