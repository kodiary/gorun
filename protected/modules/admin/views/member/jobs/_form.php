<?php $companyId = $_GET['id']; ?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'jobs-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
)); ?>

    <ul class="floating_lists">
    <li>
    	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>
    </li>
    </ul>  
    <div class="line"></div>
    
    <div class="jak left"><?php echo $form->labelEx($model,'desc');?><span class="blue"> - What will they be required to do and what renumeration can they expect?</span></div>
    <div class="floatRight blue" style="margin: 5px 0;"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
    <div class="clear"></div>
    <div class="editor">
        <?php echo $form->hiddenField($model, 'editor_type'); ?>
        <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
            <textarea name="Jobs[basic_editor]" id="Jobs_basic_editor" class="span7 autotextarea"><?php if($model->desc) echo trim(strip_tags($model->desc)); ?></textarea>
        </div>
        <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'desc')); ?>
        </div> 
    </div>
    <?php echo $form->error($model,'desc'); ?>
    
      <ul class="floating_lists">
      <li class="greybg radioOption new-radio" style=" background:#CCE5F3;">
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
              //  'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
				'class'=>'right',
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
            <?php $deleteUrl = array('delete', 'id'=>$companyId, 'jobsid'=>$model->id);?>
            <?php $this->widget('bootstrap.widgets.BootButton', array(
            //'fn'=>'ajaxLink',
            'url' => $deleteUrl,
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
            ));?>
            
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $model->id?>">Cancel</a> 
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