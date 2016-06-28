<div class="left_body">
<div class="line"></div>
    <h1>Add Company</h1>
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

	<?php echo $form->passwordFieldRow($model,'password_real',array('class'=>'span4','maxlength'=>30)); ?>
    
    <?php echo $form->passwordFieldRow($model,'repeat_password',array('class'=>'span4','maxlength'=>30)); ?>
    <div class="line"></div>
    <div class="control-group">
    	<div class="controls">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Save',
		)); ?>
        </div>
    </div>
  
<?php $this->endWidget(); ?> 
</div>
    <div class="right_body">
      <div><a class="btn" href="<?php echo $this->createUrl('/admin/company');?>">Cancel</a></div> 
    </div>
    <div class="clear"></div>