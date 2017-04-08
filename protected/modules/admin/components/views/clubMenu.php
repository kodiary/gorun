<?php 

    $array=array(
        array('label'=>'Live Clubs', 'url'=>array('/admin/club'), 'active'=>Yii::app()->controller->id=='club' && Yii::app()->controller->action->id=='index' && !(isset($_GET['filter']) && ($_GET['filter']=='draft' || $_GET['filter']=='new'))),
        array('label'=>'Inactive Clubs', 'url'=>array('/admin/club/index/filter/draft'), 'active'=>Yii::app()->controller->id=='club' && (isset($_GET['filter']) && $_GET['filter']=='draft')),//Yii::app()->controller->action->id=='draft'),
        array('label'=>'New Clubs', 'url'=>array('/admin/club/index/filter/new'),'active'=>Yii::app()->controller->id=='club' && (isset($_GET['filter']) && $_GET['filter']=='new')),// && Yii::app()->controller->action->id=='expired'),
        
        );
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>$array,
));
?>