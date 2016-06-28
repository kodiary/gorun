<?php
$this->breadcrumbs=array(
	'Specials'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Specials','url'=>array('index')),
	array('label'=>'Create Specials','url'=>array('create')),
	array('label'=>'Update Specials','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Specials','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Specials','url'=>array('admin')),
);
?>

<h1>View Specials #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'title',
		'detail',
		'expiry_date',
		'date_updated',
		'display_order',
		'image',
		'image_caption',
		'filename',
		'slug',
		'seo_title',
		'seo_desc',
		'seo_keywords',
		'status',
	),
)); ?>
