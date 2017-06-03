 <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="login_pannels">
<h1>COMPANY LOGIN</h1>
<p>Company login here to update your listing</p>

    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'login-form',
        'type' =>'horizontal',
        //'htmlOptions'=>array('class'=>'well'),
        'enableClientValidation'=>true,
        'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
        'action'=>array('index'),
    )); ?>
     
    <?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
    <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
    <label class="control-label">&nbsp;</label>
    <div class="controls">
	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'label'=>'Submit','type'=>'primary','size'=>'large','htmlOptions'=>array('name'=>'login'))); ?>
    </div>
    <div class="clear"></div>
    <?php $this->endWidget(); ?>
    <p style="margin-bottom:0;">Forgot your password? Use reminder on left.</p>
</div>