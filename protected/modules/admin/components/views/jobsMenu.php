<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'Job Lists ', 'url'=>array('/admin/jobs'), 'active'=>Yii::app()->controller->id=='jobs' && Yii::app()->controller->action->id=='index'),
        array('label'=>'Inactive Jobs', 'url'=>array('/admin/jobs/inactive'),'active'=>Yii::app()->controller->id=='jobs' && Yii::app()->controller->action->id=='inactive'),
))); 
?>