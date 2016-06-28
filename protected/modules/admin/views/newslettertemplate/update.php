<?php
$this->breadcrumbs=array(
	'Newsletters Templates'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewslettersTemplate', 'url'=>array('index')),
	array('label'=>'Create NewslettersTemplate', 'url'=>array('create')),
	array('label'=>'View NewslettersTemplate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NewslettersTemplate', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>