<?php
$this->breadcrumbs=array(
	'Newsletters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Newsletters','url'=>array('index')),
	array('label'=>'Create Newsletters','url'=>array('create')),
	array('label'=>'Update Newsletters','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Newsletters','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Newsletters','url'=>array('admin')),
);
?>

<h1>View Newsletters #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'pub_date',
		'detail',
		'number',
		'date_updated',
		'send_status',
		'send_date',
		'recipients_no',
	),
)); ?>
