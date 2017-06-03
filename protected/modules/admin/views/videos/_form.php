<?php 
$form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'video-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true)
)); 
?>
<?php echo $form->textFieldRow($model, "title",array('placeholder'=>'Video Title'));?>
<div class="mar-bot-10"></div>
<?php echo $form->textAreaRow($model, "code", array('placeholder'=>'YouTube Video URL'));?>
<input type="hidden" name="id" value="" id="videoId"/>
<p style="margin-top: 6px;color: #999999;">Add in the URL for the You Tube video here</p>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large', // '', 'large', 'small' or 'mini'
			'label'=>'Submit',
		)); ?>
<?php $this->endWidget(); ?>
