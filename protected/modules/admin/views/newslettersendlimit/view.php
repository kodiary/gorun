<?php
$this->breadcrumbs=array(
	'Newsletters Send Limits'=>array('index'),
	$model->id,
);
?>

<h1>View NewslettersSendLimit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'limit',
	),
)); ?>
