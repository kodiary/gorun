<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="well">
<h3>Contact Notification Settings</h3>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'emailconfig-form',
    'type'=>'Vertical',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <div class="blue">Email sent to notify of contact clicks</div>
    <?php echo $form->error($configModel,'number'); ?>
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Submit',
		)); ?>
    <?php echo $form->textField($configModel,'number',array('class'=>'span5')); ?>  
<?php $this->endWidget(); ?>
</div>