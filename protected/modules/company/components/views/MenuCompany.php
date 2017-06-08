<script type="text/javascript">
$(document).ready(function(){
  $('#rest-menu li:last-child').addClass('preview');
});
</script>
<?php 
    $id=Yii::app()->user->id;
    $model=Company::model()->findByPk($id);
    $membership=$model->membership;
    $member_type=array();
    if($membership)foreach($membership as $member)$member_type[]=$member->member_id;
    
    $menuarray[]=array('label'=>'Login', 'url'=>array('/company/login/details'), 'active'=>Yii::app()->controller->action->id=='details');
    $menuarray[]=array('label'=>'Company Info', 'url'=>array('/company/info'),'active'=>(Yii::app()->controller->id=='info' && Yii::app()->controller->action->id=='index')? true: false);
    //if(!in_array(4,$member_type) && !in_array(3,$member_type) && !in_array(1,$member_type))
    if(in_array(2,$member_type))
    $menuarray[]=array('label'=>'Services', 'url'=>array('/company/services'),'active'=>Yii::app()->controller->id=='services','linkOptions'=>array('id'=>'brochures'));
    //if(!in_array(4,$member_type) && !in_array(2,$member_type) && !in_array(1,$member_type))
    if(in_array(3,$member_type))
    $menuarray[]=array('label'=>'Venue', 'url'=>array('/company/venues'),'active'=>Yii::app()->controller->id=='venues','linkOptions'=>array('id'=>'brochures'));
    $menuarray[]=array('label'=>'Brochures', 'url'=>array('/company/brochures'),'active'=>Yii::app()->controller->id=='brochures','linkOptions'=>array('id'=>'brochures'));
    $menuarray[]=array('label'=>'News', 'url'=>array('/company/news'),'active'=>Yii::app()->controller->id=='news');
    $menuarray[]=array('label'=>'Gallery', 'url'=>array('/company/gallery'),'active'=>Yii::app()->controller->id=='gallery');
    $menuarray[]=array('label'=>'Videos', 'url'=>array('/company/videos'),'active'=>Yii::app()->controller->id=='videos');
    //if(!in_array(4,$member_type) && !in_array(3,$member_type) && !in_array(2,$member_type))
    if(in_array(1,$member_type))
    $menuarray[]=array('label'=>'Events', 'url'=>array('/company/events'),'active'=>Yii::app()->controller->id=='events','linkOptions'=>array('id'=>'specials'));
    $menuarray[]=array('label'=>'Jobs', 'url'=>array('/company/jobs'),'active'=>Yii::app()->controller->id=='jobs');
    $menuarray[]=array('label'=>'Resources', 'url'=>array('/company/resources'),'active'=>Yii::app()->controller->id=='resources');
    $menuarray[]=array('label'=>'Stats', 'url'=>array('/company/statistics'),'active'=>Yii::app()->controller->id=='statistics');
    $menuarray[]=array('label'=>'Accounts', 'url'=>array('/company/accounts'),'active'=>Yii::app()->controller->id=='accounts');
    $menuarray[]=array('label'=>'preview','url'=>array('/directory/preview/'.$model->slug),'linkOptions'=>array('class'=>'menuPreview','target'=>'_blank')); 
    
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'htmlOptions'=>array('id'=>'rest-menu'),
    'items'=>$menuarray,
));  
     
?>