<?php
$this->breadcrumbs=array(
	'Newsletters Send Limit',
);
?>
<div class="line"></div>
<h1>Send Limit - <span class="green">Limit of emails per hour</span></h1>
<div class="line"></div>

<div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'newsletters-send-limit-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'enableAjaxValidation'=>false,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  
		<?php echo $form->labelEx($model,'Send Limit'); ?>
		<?php echo $form->textField($model,'limit',array('class'=>'span5 mar-bot-10','maxlength'=>60,'id'=>'newsletter_send_limit')); ?>
		<?php echo $form->error($model,'limit'); ?>

        <div class="greybg">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Submit',
		));?>
        </div>
<?php $this->endWidget(); ?>
</div>