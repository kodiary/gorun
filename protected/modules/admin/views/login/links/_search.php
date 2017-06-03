<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'LinkId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'AreaId',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'Headline',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'Url',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
