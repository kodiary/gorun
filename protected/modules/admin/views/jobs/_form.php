<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'jobs-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
)); ?>

    <ul class="floating_lists">
    <li>
        <?php echo $form->labelEx($model,'company_id'); ?>
    	<?php echo $form->dropDownList($model,'company_id', Company::getAll(), array('empty'=>'Select Company', 'class'=>'span5')); ?>
        <?php echo $form->error($model,'company_id'); ?>
        <div class="clear"></div>
    </li>
    </ul> 
    <div class="line"></div>  
      
    <ul class="floating_lists">
    <li>
    	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    </li>
    </ul>  
    <div class="line"></div>
    
    <?php echo $form->labelEx($model,'desc', array('class'=>'left')); ?>
    <div class="floatRight blue"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
    <div class="clear"></div>
    <div class="editor">
        <?php echo $form->hiddenField($model, 'editor_type'); ?>
        <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
            <textarea name="Jobs[basic_editor]" id="Jobs_basic_editor" class="span7 autotextarea mar-bot-10"><?php if($model->desc) echo trim(strip_tags($model->desc)); ?></textarea>
        </div>
        <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'desc')); ?>
        </div> 
    </div>
    <?php echo $form->error($model,'desc'); ?>
    <div class="clear"></div>
    
    
      <ul class="floating_lists">
      <li class="light-blue-bg radioOption">
       <?php echo $form->radioButtonListRow($model, 'visible', array('1'=>'Publish Live', '0'=>'Draft Mode (Hidden)'));?>
        <div class="clear"></div>
        </li>
      </ul> 
   
    <div class="greybg">
	<div style="margin-left:120px;">
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
                //'size'=>'', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id, 'class'=>'right',
                'onClick'=>'$("#show_'.$model->id.'").show(400);'),
            ));   
    } ?>
	</div>
    </div>

<?php $this->endWidget(); ?>

  <div style="display: none;" id="show_<?php echo $model->id?>" class="alert">
    <div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="floatRight">
      <?php 
            $deleteUrl = array('delete', 'id'=>$_GET['id']);
            $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'danger',
                //'size'=>'', // '', 'large', 'small' or 'mini'
                'url' => $deleteUrl,
                'label'=>'Delete',
        ));?>
      <?php
            $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'cancel',
    			//'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'', // '', 'large', 'small' or 'mini'
    			'label'=>'Cancel',
                'htmlOptions'=>array('id'=>'delete_'.$model->id,            
                'onClick'=>'$("#show_'.$model->id.'").hide(400);'),            
		));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
  
<script>
// <![CDATA[
$(document).ready(function(){
    var selected_editor = 'basic';
    error=false;
    
    $('#Jobs_basic_editor').blur(function(){
        if($(this).val()!=''){
            var detail = $(this).val();
            detail = detail.replace(/\n/g, "<br />");
            CKEDITOR.instances['Jobs[desc]'].setData(detail);
            $('#Jobs_editor_type').val(0);
 
            $('#Jobs_desc_em_').html("");
            $('#Jobs_desc_em_').hide();
            error=false;
        }
        else{
            CKEDITOR.instances['Jobs[desc]'].setData('');
            $('#Jobs_desc_em_').html("Description cannot be blank.");
            $('#Jobs_desc_em_').show();
            error=true;
        }   
    });
    
    $('#basic-editor').click(function(){
        selected_editor = 'basic';
        $('#Jobs_editor_type').val(0);
        $('.basic-editor').show();
        $('.advance-editor').hide();
        
        if ($('#Jobs_basic_editor').val()!=''){
            $('#Jobs_desc_em_').html("");
            $('#Jobs_desc_em_').hide();
            error=false;
        }
        else{
            $('#Jobs_desc_em_').html("Description cannot be blank.");
            $('#Jobs_desc_em_').show();
            error=true;
        }
    });
    
    $('#advance-editor').click(function(){
        selected_editor = 'advance';
        $('#Jobs_editor_type').val(1);
        $('.advance-editor').show();
        $('.basic-editor').hide();
        $('#Jobs_desc_em_').html("");
        $('#Jobs_desc_em_').hide();
    });
    
    var editor = CKEDITOR.instances['Jobs[desc]'];
    editor.on("blur",function(e){
        var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
        if (editorcontent.length){
            $('#Jobs_desc_em_').html("");
            $('#Jobs_desc_em_').hide();
            error=false;
        }
        else{
            $('#Jobs_desc_em_').html("Description cannot be blank.");
            $('#Jobs_desc_em_').show();
            error=true;
        }
    });
});
/*]]>*/  
</script>