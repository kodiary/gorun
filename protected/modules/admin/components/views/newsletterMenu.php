<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'Newsletter Builds', 'url'=>array('/admin/newsletters'), 'active'=>(Yii::app()->controller->id=='newsletters' && Yii::app()->controller->action->id!='send')?true:false),
        array('label'=>'Send Newsletter', 'url'=>array('/admin/newsletters/send'), 'active'=>Yii::app()->controller->action->id=='send'),
        array('label'=>'Newsletter Templates', 'url'=>array('/admin/newslettertemplate'), 'active'=>Yii::app()->controller->id=='newslettertemplate'),
        array('label'=>'Subscribers', 'url'=>array('/admin/subscribers'), 'active'=>Yii::app()->controller->id=='subscribers'),
        array('label'=>'Send Limit', 'url'=>array('/admin/newslettersendlimit'), 'active'=>Yii::app()->controller->id=='newslettersendlimit'),
        array('label'=>'Lists', 'url'=>array('/admin/subscriberslist'), 'active'=>Yii::app()->controller->id=='subscriberslist'),
))); 
?>