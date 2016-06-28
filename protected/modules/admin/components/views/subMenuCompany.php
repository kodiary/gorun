<?php
    $id=$_GET['id'];
    $model=Company::model()->findByPk($id);
    $membership=$model->membership;
    $member_type=array();
    if($membership)foreach($membership as $member)$member_type[]=$member->member_id;
    
    $menuarray[]=array('label'=>'Login', 'url'=>array('/admin/company/login/id/'.$_GET['id']), 'active'=>Yii::app()->controller->action->id=='login');
    $menuarray[]=array('label'=>'Company Info', 'url'=>array('/admin/company/update/id/'.$_GET['id']),'active'=>(Yii::app()->controller->id=='company' &&Yii::app()->controller->action->id=='update')? true: false);
    //if(!in_array(4,$member_type) && !in_array(3,$member_type) && !in_array(1,$member_type))
    if(in_array(2,$member_type))
    $menuarray[]=array('label'=>'Services', 'url'=>array('/admin/member/services/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='member/services');
    //if(!in_array(4,$member_type) && !in_array(2,$member_type) && !in_array(1,$member_type))
    if(in_array(3,$member_type))
    $menuarray[]=array('label'=>'Venues', 'url'=>array('/admin/company/venues/id/'.$_GET['id']),'active'=>Yii::app()->controller->action->id=='venues');
    $menuarray[]=array('label'=>'Brochures', 'url'=>array('/admin/brochures/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='brochures','linkOptions'=>array('id'=>'brochures'));
    $menuarray[]=array('label'=>'News', 'url'=>array('/admin/member/articles/index/id/'.$_GET['id']), 'active'=>Yii::app()->controller->id=='member/articles');
    $menuarray[]=array('label'=>'Gallery', 'url'=>array('/admin/gallery/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='gallery');
    $menuarray[]=array('label'=>'Videos', 'url'=>array('/admin/videos/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='videos');
    //if(!in_array(4,$member_type) && !in_array(3,$member_type) && !in_array(2,$member_type))
    if(in_array(1,$member_type))
    $menuarray[]=array('label'=>'Events', 'url'=>array('/admin/member/events/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='member/events','linkOptions'=>array('id'=>'events'));
    $menuarray[]=array('label'=>'Jobs', 'url'=>array('/admin/member/jobs/index/id/'.$_GET['id']), 'active'=>Yii::app()->controller->id=='member/jobs');
    $menuarray[]=array('label'=>'Resources', 'url'=>array('/admin/member/resources/index/id/'.$_GET['id']), 'active'=>Yii::app()->controller->id=='member/resources');
    $menuarray[]=array('label'=>'Stats', 'url'=>array('statistics/index/id/'.$_GET['id']),'active'=>Yii::app()->controller->id=='statistics');
    $menuarray[]=array('label'=>'Accounts', 'url'=>array('company/accounts/id/'.$_GET['id']),'active'=>Yii::app()->controller->action->id=='accounts');
        
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'htmlOptions'=>array('id'=>'rest-menu'),
    'items'=>$menuarray,
));  
?>