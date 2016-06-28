<?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = Yii::app()->user->id;
?>
<input type="hidden" class="moduleType" value="<?php echo $this->module->getName(); ?>"/>
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'brochures-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->hiddenField($model,'company_id',array('value'=>$id));?>
<ul class="floating_lists">
<li><?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?></li>
<div class="line"></div>
<li class="full_label left" style="margin-top:0">
<span>Brochure Info - <span class="blue">Short description of item you are adding</span></span>
<div class="clear"></div>
</li>

<li>
    <?php if($this->module->getName()=='company'){ ?>
    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
    <?php
        $model->detail = trim(strip_tags($model->detail));
        $model->editor_type = 0;
    ?>
    <?php echo $form->hiddenField($model, 'editor_type'); ?>
    <?php echo $form->textArea($model,'detail',array('class'=>'span7 autotextarea')); ?>
    <?php }else{ ?>
    <div class="floatRight blue"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
    <div class="clear"></div>
    <div class="editor">
        <?php echo $form->hiddenField($model, 'editor_type'); ?>
        <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
            <textarea name="Brochures[basic_editor]" id="Brochures_basic_editor" class="span7 autotextarea"><?php if($model->detail) echo trim(strip_tags($model->detail)); ?></textarea>
        </div>
        <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'detail')); ?>
        </div> 
    </div>
    <?php } ?>
    <?php echo $form->error($model,'detail'); ?>
<div class="clear"></div>
</li>
</ul>
 
    <?php echo $form->hiddenField($model,'filename'); ?>
    
    <?php if($model->filename && !$model->isNewRecord){
    $upload = "display:none;";
    $fileDiv = "display:block";
    }
    elseif($model->isNewRecord){
        $upload = "display:block;";
        $fileDiv =  "display:none";
    }
    elseif(!$model->filename && !$model->isNewRecord){
        $upload = "display:block;";
        $fileDiv =  "display:none";
    }
?>
    <div id="uploadDiv" style=" <?php echo $upload;?>">
    <div class="border_line">
    <h2 style="margin-top: 5px !important;">Include a File - <span>(Optional) - Upload a PDF, JPG or Microsoft Word Doc</span></h2>
    
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
    array(
            'id'=>'uploadFile',
            'config'=>array(
                   'action'=>$this->createUrl('upload'),
                   'multiple'=> false,
                   'debug'=> true,
                   'allowedExtensions'=>array("pdf","doc","docx","jpeg","jpg"),//array("jpg","jpeg","gif","exe","mov" and etc...
                   'sizeLimit'=>10*1024*1024,// minimum file size in bytes
                    'onProgress'=>"js:function(id, fileName, loaded, total){
                        $('#uploadControl').text('Uploading...');
                    }",
                   'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#uploadControl').text('Select');
    				    	if(!responseJSON.error){
                                $('#fileInfo').html(fileName+' ('+responseJSON.fileSize+')');
                                $('#Brochures_filename').val(responseJSON.filename);
                                $('#uploadDiv').hide();
                                $('#fileDiv').show();
    						}
                            else
                            {
                                alert('something went wrong!');
                            }  
    					}",
                   'messages'=>array(
                                     'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                     'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                     'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                     'emptyError'=>"{file} is empty, please select files again without it.",
                                     'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                    ),
                   'showMessage'=>"js:function(message){ alert(message); }"
                  )
    )); ?>
    <div class="clear"></div>
    </div>
    </div>
  
  <div id="uploadDiv">
   <div id="fileDiv" class="border_line" style=" <?php echo $fileDiv;?>">
    <?php 
    $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
    if($model->filename!="" && file_exists($folder))$filesize = CommonClass::format_file_size(filesize($folder));else $filesize=0;;
    ?>
   	<h2 style="margin-top: 5px !important;">Inclued a file - <span id="fileInfo"><?php echo $model->title.' ('.$filesize.')'?></span></h2>
    
    <div id="uploadFile"><?php 
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#Brochures_filename").val("");$("#uploadDiv").show();$("#fileDiv").hide();'),
            ));?>
      </div>
      <div class="clear"></div>
    </div>    
   </div>

<div class="greybg">
	<div style="padding-left:120px;">
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
                'size'=>'large', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#show_'.$model->id.'").show();'),
            ));   
    } ?>
	</div>
</div>
<div class="clear"></div>    
<?php $this->endWidget(); ?>
<div class="clear"></div>

        <div style="display: none;" id="show_<?php echo $model->id?>" class="warning_blocks">
                    <div class="fl_left">
                   		<span class="bold">Warning:</span> This cannot be undone. Are you sure?
                    </div>
                    <div class="fl_right">
                     <?php
                     if(isset($_GET['id']))
                        $deleteUrl = array('delete', 'id'=>$id, 'bId'=>$model->id);
                     elseif(isset(Yii::app()->user->id))
                        $deleteUrl = array('delete', 'bId'=>$model->id);
                     else
                        $deleteUrl = '';
                     ?>
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
        
<script type="text/javascript">
// <![CDATA[
$(document).ready(function(){
    var module = $('.moduleType').val();
    var selected_editor = 'basic';
    error=false;
    
    if(module=='admin'){
        $('#Brochures_basic_editor').blur(function(){
            if($(this).val()!=''){
                var detail = $(this).val();
                detail = detail.replace(/\n/g, "<br />");
                CKEDITOR.instances['Brochures[detail]'].setData(detail);
                $('#Brochures_editor_type').val(0);
     
                $('#Brochures_detail_em_').html("");
                $('#Brochures_detail_em_').hide();
                error=false;
            }
            else{
                CKEDITOR.instances['Brochures[detail]'].setData('');
                $('#Brochures_detail_em_').html("Description cannot be blank.");
                $('#Brochures_detail_em_').show();
                error=true;
            }   
        });
        
        $('#basic-editor').click(function(){
            selected_editor = 'basic';
            $('#Brochures_editor_type').val(0);
            $('.basic-editor').show();
            $('.advance-editor').hide();
            
            if ($('#Brochures_basic_editor').val()!=''){
                $('#Brochures_detail_em_').html("");
                $('#Brochures_detail_em_').hide();
                error=false;
            }
            else{
                $('#Brochures_detail_em_').html("Description cannot be blank.");
                $('#Brochures_detail_em_').show();
                error=true;
            }
        });
        
        $('#advance-editor').click(function(){
            selected_editor = 'advance';
            $('#Brochures_editor_type').val(1);
            $('.advance-editor').show();
            $('.basic-editor').hide();
            $('#Brochures_detail_em_').html("");
            $('#Brochures_detail_em_').hide();
        });
        
        var editor = CKEDITOR.instances['Brochures[detail]'];
        editor.on("blur",function(e){
                var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
                if (editorcontent.length){
                    $('#Brochures_detail_em_').html("");
                    $('#Brochures_detail_em_').hide();
                    error=false;
                }
                else{
                    $('#Brochures_detail_em_').html("Description cannot be blank.");
                    $('#Brochures_detail_em_').show();
                    error=true;
                }
        });
     }
});  
/*]]>*/   
</script>