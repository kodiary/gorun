<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'Ad Banners', 'url'=>array('/admin/banner'), 'active'=>(Yii::app()->controller->id=='banner' && Yii::app()->controller->action->id!='background' && Yii::app()->controller->action->id!='addbackground' && Yii::app()->controller->action->id!='editbackground')?true:false),
        array('label'=>'Landing Slider', 'url'=>array('/admin/slideshow'), 'active'=>(Yii::app()->controller->id=='slideshow')),
        array('label'=>'Patron Slider', 'url'=>array('/admin/patronslider'), 'active'=>(Yii::app()->controller->id=='patronslider')),
        array('label'=>'Background Banners', 'url'=>array('/admin/banner/background'), 'active'=>(Yii::app()->controller->action->id=='background' || Yii::app()->controller->action->id=='addbackground' || Yii::app()->controller->action->id=='editbackground')?true:false),
))); ?>