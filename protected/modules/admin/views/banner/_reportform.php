<div class="outer_popups" style="height:auto;">
<div class="inner">
<div class="inner_borders">
<div class="top_titles" style="border-top:0; border-left:0; border-right:0;">
	<div class="titles_left" style="width:270px; padding-top:5px;">
		<h2 style="margin-left:15px; padding-left:0;">Send Banner Report</h2>
	</div>
    <div class="title_right">
    	<a onclick="$('#banner_popup').dialog('close');" href="javascript:void(0)">Close</a>
    </div>
</div>

<div class="pop_up_forms">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'report-form',
	//'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    //'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
    'action'=>array('report'),
)); ?>
<?php echo CHtml::hiddenField('banner_id', $banner_id);?>
<div class="flt_frms">
	<div class="fl_left">Name</div>
    <div class="fl_right"><?php echo $form->textField($model, 'name');?></div>
    <div class="clear"></div>
</div>

<div class="flt_frms">
	<div class="fl_left">Email</div>
    <div class="fl_right"><?php echo $form->textField($model, 'email');?></div>
    <div class="clear"></div>
</div>
<div class="flt_frms" style="margin-bottom:0;">
	<div class="fl_left">&nbsp;</div>
    <div class="fl_right"><?php //echo CHtml::ajaxSubmitButton('Submit', array('report'), array('ajax'=>array('type'=>'post', 'success'=>'function(data){$("#banner_popup").dialog("close");}')), array('onclick'=>'if(("#Banner_name").val()=="") return false;')); ?>
    <?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary'));?></div>
    <div class="clear"></div>
</div>
<?php $this->endWidget();?>
</div>
</div>
</div>
</div>