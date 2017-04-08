<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="restaurant_menus_wrapper">
<h2>Company Login - <span>Your login details to manage your listing</span></h2>
<div class="line"></div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'company-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'contact_person',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'number',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span4')); ?>
    <div class="control-group ">
    <label class="control-label">Password</label>
    	<div class="controls"><?php echo ($section)?str_repeat('*',strlen($model->password_real)-3).substr($model->password_real,strlen($model->password_real)-3,strlen($model->password_real)):$model->password_real ;?><span>
        <a style="float:right; margin-right:140px;" href="javascript:void(0);" onclick="toggleChangePass();" class="btn btn-medium">Change Password</a>
        <div class="clear"></div>
        </span></div></div>
    <div id="changePassword" style="display: none;">
		<?php echo $form->passwordFieldRow($model,'password_real',array('class'=>'span4','maxlength'=>30)); ?>
        <?php echo $form->passwordFieldRow($model,'repeat_password',array('class'=>'span4','maxlength'=>30,'value'=>$model->password_real)); ?>
    </div>

    <label class="control-label">&nbsp;</label>
    <div class=" greybg">
    <div class="controls">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Submit',
		)); ?>
     </div>
     </div>
     <div class="clear"></div>
     
  
<?php $this->endWidget(); ?>

<div class="clear"></div>
<script type="text/javascript">
function toggleChangePass()
{
    if($("#changePassword").css("display")=="none")
    {
       $("#Company_password_real").attr('value','');
        $("#Company_repeat_password").attr('value','');
        $("#changePassword").css("display","block");
    }
    else
    {
       $("#Company_password_real").attr('value','<?php echo $model->password_real?>');
        $("#Company_repeat_password").attr('value','<?php echo $model->password_real?>');
        $("#changePassword").css("display","none");
    }
}
</script>
</div>