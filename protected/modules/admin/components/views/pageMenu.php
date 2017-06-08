<?php

$pages = Contents::model()->listParent();
$arr = array();
foreach($pages as $menu) 
{
    $arr[] = array('label'=>$menu->title, 'url'=>array('contents/manage/id/'.$menu->id), 'active'=>Yii::app()->controller->id=='contents' && Yii::app()->controller->action->id=='display');
}
$arr[] = array('label'=>'Accounts Page', 'url'=>array('/admin/accounts'), 'active'=>Yii::app()->controller->id=='accounts');
?>
<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
	'htmlOptions'=>array('class'=>'admin_extra02'),
    'items'=>$arr,
));
?>