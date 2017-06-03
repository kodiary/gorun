<h2><span class="bold">Add or Edit Admin Links</span></h2>
<div class="col-md-8">
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>
<div class="col-md-4">
<?php echo CHtml::link('Cancel',Yii::app()->request->urlReferrer,array('class'=>'btn')); ?>
</div>
<div class="clear"></div>