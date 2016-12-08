<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="line"></div>
<h1>Password Reminder</h1>
<p style="margin-top: 10px; color:#1C5EA8; font-size:15px;">Use this to retrieve your password. Password will be sent to registered email.</p>
<div class="password_reminder">
<div class="line"></div>
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'password-reminder',
        'type' =>'horizontal',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
    )); ?>
     
    <?php echo $form->textFieldRow($model, 'emailAdd', array('class'=>'span4')); ?>
 <div class="line"></div>
 <label class="control-label">&nbsp;</label>
 <div class="controls">   
    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Send Password','type'=>'primary','size'=>'large','htmlOptions'=>array('name'=>'btnRemindPass'))); ?>
 </div>
 <div class="clear"></div>
 <div class="line" style="margin-top:10px;"></div>
    <?php $this->endWidget(); ?>
</div>