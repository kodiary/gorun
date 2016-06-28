<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->LinkId,
);

$this->menu=array(
	array('label'=>'List Links','url'=>array('index')),
	array('label'=>'Create Links','url'=>array('create')),
	array('label'=>'Update Links','url'=>array('update','id'=>$model->LinkId)),
	array('label'=>'Delete Links','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->LinkId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Links','url'=>array('admin')),
);
?>

<h1>View Links #<?php echo $model->LinkId; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'LinkId',
		'AreaId',
		'Headline',
		'Url',
	),
)); ?>
