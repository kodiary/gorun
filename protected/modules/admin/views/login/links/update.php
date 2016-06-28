<h2><span class="bold">Add or Edit Admin Links</span></h2>
<div class="left_body">
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
<div class="right_body">
<?php echo CHtml::link('Cancel',Yii::app()->request->urlReferrer,array('class'=>'btn')); ?>
</div>
<div class="clear"></div>