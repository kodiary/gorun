<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<div class="s_height_d">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="left_body">
	<div class="line"></div>
    <h2>Add/Edit Background Banner</h2>
    <div class="line"></div>
    <div class="restaurant_menus_wrapper"><?php echo $this->renderPartial('_backgroundForm',array('model'=>$model));?></div>
</div>
<div class="right_body banner_adding_sec">
<p class="head_port well" style="width: 90%;"><span>Clicks: <?php echo number_format($model->clicks);?></span></p>
</div>
<div class="clear"></div>
</div>