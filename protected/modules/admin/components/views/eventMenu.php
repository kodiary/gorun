<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'Live Events', 'url'=>array('/admin/events'), 'active'=>Yii::app()->controller->id=='events' && Yii::app()->controller->action->id=='index' && !(isset($_GET['filter']) && ($_GET['filter']=='draft' || $_GET['filter']=='expired'))),
        array('label'=>'Draft Mode', 'url'=>array('/admin/events/index/filter/draft'), 'active'=>Yii::app()->controller->id=='events' && (isset($_GET['filter']) && $_GET['filter']=='draft')),
        array('label'=>'Expired', 'url'=>array('/admin/events/index/filter/expired'),'active'=>Yii::app()->controller->id=='events' && (isset($_GET['filter']) && $_GET['filter']=='expired')),/*
        array('label'=>'Event Types', 'url'=>array('/admin/eventstype'),'active'=>Yii::app()->controller->id=='eventstype'),
        array('label'=>'Event Categories', 'url'=>array('/admin/eventscategory'), 'active'=>Yii::app()->controller->id=='eventscategory'),
        array('label'=>'Visitors Profile', 'url'=>array('/admin/eventsvisitors'), 'active'=>Yii::app()->controller->id=='eventsvisitors'),
        array('label'=>'Export Events', 'url'=>array('/admin/events/export'), 'active'=>Yii::app()->controller->id=='events' && Yii::app()->controller->action->id == 'export'),*/
))); ?>