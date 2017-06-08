<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<div class="contact-new">
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery-ui.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/jquery.ui.touch.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/QapTcha.jquery.js';?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl.'/css/QapTcha.jquery.css';?>" media="screen" />

<h2>CONTACT FORM</h2>

<div class="form contact_form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<p><?php echo $form->textField($model, 'name', array('placeholder'=>'Your Name')); ?>
<?php echo $form->error($model,'name');?></p>
<p><?php echo $form->textField($model, 'contact', array('placeholder'=>'Contact Number')); ?>
<?php echo $form->error($model,'contact');?></p>
<p><?php echo $form->textField($model, 'email', array('placeholder'=>'E-mail Address')); ?>
<?php echo $form->error($model,'email');?></p>
<p><?php echo $form->textArea($model, 'body', array('placeholder'=>'Message')); ?>
<?php echo $form->error($model,'body');?></p>


 <?php //Captcha
 if(CCaptcha::checkRequirements()): ?>
	<div class="control-group captcha" style="margin:0 0 10px;">
        <div class="fl_left">
            <div class="margintop5" style="color: #FFF; font-size: 15px; font-weight:bold">Human Check: Slide the arrow right</div>
            <div class="QapTcha" style="margin-top: 8px;"></div>
            <div class="clear"></div>
		</div>
        <div class="clear"></div>
	</div>
    
	<?php endif; 
    //--end captcha?>

<div class="control-group" style="margin: 0;">
<div class="controls smbtns" style="margin: 0;">
<?php /*$this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'submit',
    'label'=>'Send Message',
    'type'=>'primary', 
    'size'=>'large', 
));*/ ?>
       <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-large" style="margin: 5px 0 0;"/>
        
</div>
</div>

<?php $this->endWidget(); ?>

</div>

</div>