<?php
$this->breadcrumbs=array(
	'Branches'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Branches','url'=>array('index')),
	array('label'=>'Create Branches','url'=>array('create')),
	array('label'=>'Update Branches','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Branches','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Branches','url'=>array('admin')),
);
?>

<h1>View Branches #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'number',
		'fax',
		'email',
		'manager',
		'display_address',
		'suburb',
		'province',
		'latitude',
		'longitude',
		'slug',
	),
)); ?>
