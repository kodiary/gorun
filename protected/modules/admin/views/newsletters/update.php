<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Newsletters','url'=>array('index')),
	array('label'=>'Create Newsletters','url'=>array('create')),
	array('label'=>'View Newsletters','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Newsletters','url'=>array('admin')),
);
?>

<aside class="leftContainer"><h1>Update Newsletters <?php echo $model->id; ?></h1>

<div class="addContentArea"><?php echo $this->renderPartial('_form',array('model'=>$model)); ?></div>
</aside>