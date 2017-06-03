<?php

class SearchController extends Controller
{
    /*
     * search the suppliers and specials
     */
 	public $layout='column2';
    public $metaDesc;
    public $metaKeys;
    
    public function actionIndex()
    {
        $seo = CommonClass::getSeoByPage('generic');
        $this->metaDesc = $seo['desc'];
        $this->metaKeys = $seo['keys'];
        if($seo['title']!="")$this->pageTitle="Search - ".$seo['title'];
        else $this->pageTitle="Search - EXSA";
            
        $keyword = trim($_GET['q']);
        if($keyword!="")
        {
            $c1 = new CDbCriteria;
            $c1->addSearchCondition('name',$keyword,true,'OR');
            $c1->addSearchCondition('detail',$keyword,true,'OR');
            $c1->addSearchCondition('tagline',$keyword,true,'OR');
            $c1->addCondition('status=1');
            
            $c2 = new CDbCriteria;
            $c2->addSearchCondition('title',$keyword,true,'OR');
            $c2->addSearchCondition('detail',$keyword,true,'OR');
            $c2->addCondition('is_approved=1 AND  visible=1');
            //$c2->limit = '10';
            $c3 = new CDbCriteria;
            $c3->addSearchCondition('title',$keyword,true,'OR');
            $c3->addSearchCondition('t.desc',$keyword,true,'OR');
            $c3->addCondition('visible=1');
            //$c3->limit = '10';
            
            $c4 = new CDbCriteria;
            $c4->addSearchCondition('title',$keyword,true,'OR');
            $c4->addSearchCondition('description',$keyword,true,'OR');
            $c4->addCondition('visible=1');
        }
        
        $company=new CActiveDataProvider(Company, array('criteria'=>$c1, 'pagination'=>false));
        $news=new CActiveDataProvider(Articles, array('criteria'=>$c2, 'pagination'=>false));
        $jobs=new CActiveDataProvider(Jobs, array('criteria'=>$c3, 'pagination'=>false));
        $events = new CActiveDataProvider(Events, array('criteria'=>$c4, 'pagination'=>false));
        
        $this->render('index',array('company'=>$company,
        'news'=>$news,
        'events'=>$events,
        'jobs'=>$jobs));
    }
}

?>