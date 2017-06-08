<?php
$this->breadcrumbs=array(
	'Banners'=>array('index'),
	'Create',
);?>

<aside class="col-md-8">
<div class="line"></div>
<h2>Advertising Banners - <span class="blue">Add or Edit Banners Here</span></h2>

<div class="line"></div>
<div class="restaurant_menus_wrapper bannerAdd"><?php echo $this->renderPartial('_form', array('model'=>$model));?></div>
</aside>

<aside class="col-md-4">
<div class="right_btns">
<?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Back to List',
                'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('index'),
)); ?>
</div>

</aside>

<div class="clear"></div>
