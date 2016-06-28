<h3 class="admin_top_list_headings">Add or Edit Admin Links</h3>

<div class="div600">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="right_bar_blocks">
<!-- start right side bar-->
<div class="right_btns">
<?php echo CHtml::link('Cancel',array('/admin/links'),array('class'=>'btn')); ?>
</div>
</div>
<div class="clear"></div>