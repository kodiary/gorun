<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'select-template',
	'enableAjaxValidation'=>false,
)); ?>

<div class="greybg mar-bot-10">
<label style="float: left; margin-right: 15px; margin-top: 5px;"><strong>Template</strong></label>
    <select name="temp_id">
    <option value="">Select Template</option>
    <option value="1">EXSA EXPRESS</option>
    <option value="">Blank Template</option>
    <?php
	if($templates)
	{
    	foreach($templates as $val)
    	{
    		if($val->id!=1){ ?>
            <option value="<?php echo $val->id;?>"><?php echo $val->title;?></option>
    		<?php }
    	}?>
    </select>
</div>

    <div class="greybg">
    <div  style="margin-left: 68px;">
     <?php $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'submit',
    			'type'=>'primary',
    			'label'=>'Submit',
    			'size'=>'large',
                'htmlOptions'=>array('name'=>'submitTemplate')
    		)); ?>
     </div>
     </div>
    <?php 
    }
    ?>
 <?php $this->endWidget(); ?>