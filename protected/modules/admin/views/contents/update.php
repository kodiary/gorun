<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

?>
<aside class="left_body addArticles contentPage">
<div class="line"></div>
<h1>Pages - <span class="green">List of pages under <?php echo $model->title; ?></span></h1>
<div class="line"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model,'editContent'=>'1')); ?>
</aside>

<aside class="right_body floatRight">
  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index'),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</aside>
<div class="clear"></div>