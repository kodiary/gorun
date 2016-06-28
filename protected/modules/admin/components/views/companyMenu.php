<?php 

    $array=array(
        array('label'=>'Live Members', 'url'=>array('/admin/company'), 'active'=>Yii::app()->controller->id=='company' && Yii::app()->controller->action->id=='index' && !(isset($_GET['filter']) && ($_GET['filter']=='draft' || $_GET['filter']=='new'))),
        array('label'=>'Inactive Members', 'url'=>array('/admin/company/index/filter/draft'), 'active'=>Yii::app()->controller->id=='company' && (isset($_GET['filter']) && $_GET['filter']=='draft')),//Yii::app()->controller->action->id=='draft'),
        array('label'=>'New Members', 'url'=>array('/admin/company/index/filter/new'),'active'=>Yii::app()->controller->id=='company' && (isset($_GET['filter']) && $_GET['filter']=='new')),// && Yii::app()->controller->action->id=='expired'),
        array('label'=>'Member Types', 'url'=>array('/admin/membertype'),'active'=>Yii::app()->controller->id=='membertype'),
        array('label'=>'Service Categories', 'url'=>array('/admin/services'), 'active'=>Yii::app()->controller->id=='services'),
        array('label'=>'Resources', 'url'=>array('/admin/resources'), 'active'=>Yii::app()->controller->id=='resources'),
        array('label'=>'Categories', 'url'=>array('/admin/resourcecategory'), 'active'=>Yii::app()->controller->id=='resourcecategory'),
        array('label'=>'Export', 'url'=>array('/admin/company/export'), 'active'=>Yii::app()->controller->action->id=='export'),
        );
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>$array,
));
?>