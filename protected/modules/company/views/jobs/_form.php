<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'jobs-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
)); ?>

    <ul class="floating_lists">
    <li>
    	<?php echo $form->textFieldRow($model,'title',array('class'=>'span4','maxlength'=>255)); ?>
    </li>
    </ul>  
    <div class="line"></div>
    
    <div class="jak mar-bot-10"><?php echo $form->labelEx($model,'desc');?><span class="blue"> - What will they be required to do and what renumeration can they expect?</span></div>
    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
    <?php
        $model->desc = trim(strip_tags($model->desc));
        $model->editor_type = 0;
    ?>
    <?php echo $form->hiddenField($model, 'editor_type'); ?>
    <?php echo $form->textArea($model,'desc',array('class'=>'span7 autotextarea')); ?>
    <?php echo $form->error($model,'desc'); ?>

      <ul class="floating_lists">
      <li class="greybg radioOption new-radio"  style="background: #CCE5F3;">
       <?php echo $form->radioButtonListRow($model, 'visible', array('1'=>'Publish Live', '0'=>'Draft Mode (Hidden)'));?>
        <div class="clear"></div>
        </li>
      </ul> 

<div class="greybg">
	<div style="margin-left:158px;">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'size'=>'large', // '', 'large', 'small' or 'mini'
			'label'=>'Submit',
		)); ?>
        
    <?php if(!$model->isNewRecord){
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#show_'.$model->id.'").show();'),
            ));   
    } ?>
	</div>
    </div>
<div class="clear"></div>

<?php $this->endWidget(); ?>

    <div style="display: none;" id="show_<?php echo $model->id?>" class="warning_blocks">
        <div class="fl_left">
            <span class="bold">Warning:</span> This cannot be undone. Are you sure?
        </div>
        <div class="fl_right">
            <?php $deleteUrl = array('jobs/delete/'.$model->slug);?>
            <?php $this->widget('bootstrap.widgets.BootButton', array(
            //'fn'=>'ajaxLink',
            'url' => $deleteUrl,
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
            ));?>
            
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $model->id?>" onclick="$('#show_<?php echo $model->id?>').hide();">Cancel</a> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>