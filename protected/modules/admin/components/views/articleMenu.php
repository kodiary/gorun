<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>array(
        array('label'=>'View Articles', 'url'=>array('/admin/articles'), 'active'=>Yii::app()->controller->id=='articles' && Yii::app()->controller->action->id=='index'),
        array('label'=>'Add Article', 'url'=>array('/admin/articles/create'), 'active'=>Yii::app()->controller->id=='articles' && Yii::app()->controller->action->id=='create'),
        array('label'=>'Pending Approval', 'url'=>array('/admin/articles/approval'),'active'=>Yii::app()->controller->id=='articles' && Yii::app()->controller->action->id=='approval'),
        array('label'=>'Inactive/Draft Mode', 'url'=>array('/admin/articles/inactive'),'active'=>Yii::app()->controller->id=='articles' && Yii::app()->controller->action->id=='inactive'),
        array('label'=>'Common Topics', 'url'=>array('/admin/tags'), 'active'=>Yii::app()->controller->id=='tags'),
))); ?>