<?php 

    $array=array(
        array('label'=>'MEMBERS', 'url'=>array('/admin/members'), 'active'=>Yii::app()->controller->id=='members' && Yii::app()->controller->action->id=='index' ),
        array('label'=>'SEARCH', 'url'=>array('/admin/members/search'), 'active'=>Yii::app()->controller->id=='club' && (isset($_GET['filter']) && $_GET['filter']=='draft')),//Yii::app()->controller->action->id=='draft'),
        
        
        );
    $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>$array,
));
?>