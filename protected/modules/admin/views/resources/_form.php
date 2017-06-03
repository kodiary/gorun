    <?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
    	'id'=>'resource-form',
    		'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
    )); ?>
    
    <?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>   
    <ul>
        <li>
            <?php echo $form->labelEx($model,'cat_id'); ?>
            <?php 
            if(isset($category)){
                $default = array('label'=>ucwords($category->title), 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown','class'=>'show_label'));    
            }
            else{
                $default = array('label'=>'Select Category', 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown','class'=>'show_label'));                
            }

            if(!empty($categoryModel))
            {
                foreach($categoryModel as $category)
                {
                    $array[]=array('label'=>ucwords($category->title), 'url'=>'javascript:void(0);','linkOptions'=>array('class'=>'category', 'id'=>$category->id)); 
                }
            }
            $this->widget('bootstrap.widgets.BootButtonGroup', array(
                    'type'=>'primary', 
                    'buttons'=>array(
                        $default,            
                        array('items'=>$array),
                    ),
                    'htmlOptions'=>array('class'=>'widerButton span6 right mar-bot-10'),
            ));
            ?>
            <?php echo $form->hiddenField($model,'cat_id'); ?>
            <?php echo $form->error($model,'cat_id'); ?>
            <div class="clear"></div>
        </li>
        
        <li>
            <?php echo $form->textFieldRow($model,'title',array('class'=>'span6 mar-bot-10','maxlength'=>255,'placeHolder'=>'Document Title','style'=>'margin-left:20px;')); ?>
            <div class="clear"></div>
        </li>
        
        <li>
            <div class="control-group greybg">   
                <div class="controls">
                <?php echo $form->hiddenField($model,'filename',array('value'=>$model->filename)); ?>
                
                <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                        'id'=>'filename',
                        'config'=>array(
                               'action'=>$this->createUrl('/admin/resources/upload'),
                               'allowedExtensions'=>array("pdf","doc","docx","txt"),//array("jpg","jpeg","gif","exe","mov" and etc...
                               'sizeLimit'=>Yii::app()->params['doc_size'] * 1024 * 1024,// maximum file size in bytes
                               //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                               'onComplete'=>"js:function(id, fileName, responseJSON){
                				    	if(!responseJSON.error){
                							$('span#docFile').show().html(fileName +' ( '+ responseJSON.fileSize +' )');
                							$('#Resources_filename').val(responseJSON.filename);
                                            $('#filename').hide();
                                            $('#removeDoc').show();
                						}
                					}",
                               'messages'=>array(
                                    'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                    'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                    //'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                    'emptyError'=>"{file} is empty, please select files again without it.",
                                    'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                               ),
                               'showMessage'=>"js:function(message){ alert(message); }"
                        )
                )); ?>
            
                <?php
                    $folder = Yii::app()->basePath.'/../documents/'.$model->filename;
                    $filesize = CommonClass::format_file_size(filesize($folder));
                ?>
                <span id="docFile"><?php if($model->filename){ echo ($model->title!="")?$model->title:reset(explode('.',$model->filename));echo ".".end(explode('.',$model->filename)); ?> ( <?php echo $filesize; ?> ) <?php } ?></span>
                
                <div id="removeDoc" class="floatRight" style="display: none;"> <?php 
                $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Remove',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete',
                        'onClick'=>'$("#Resources_filename").val("");$("#docFile").html("");$("#removeDoc").hide();$("#filename").show();'),
                    ));?>
                </div>
                
                <div class="clear"></div>
                </div><!--browse document-->
                
                <div class="controls">
                    <?php echo $form->error($model, 'filename'); ?>
                </div>
            </div>
        </li>
        
        <li>
            <div class="greybg">
            <div style="margin-left: 120px;">
            	<?php $this->widget('bootstrap.widgets.BootButton', array(
                        'buttonType'=>'submit',
                        'label'=>'Submit',
                        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        'size'=>'large', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'btnsubmit','class'=>''),
                )); ?>
                <?php if(!$model->isNewRecord){
                    $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Delete',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'delete','class'=>'right',
                        'onClick'=>'$("#show").show();'),
                    ));
                }?>
                </div>
        	</div>
            <div style="display: none;" id="show" class="warning_blocks">
                    <div class="fl_left">
                   		<span class="bold">Warning:</span> This cannot be undone. Are you sure?
                    </div>
                    <div class="fl_right">
                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                        //'fn'=>'ajaxLink',
                        'url' => $this->createUrl('delete', array('id'=>$model->id)),
                        'label'=>'Delete',
                        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'small' or 'large'
                    ));?>
                    <a class="cancel_button btn info" href="javascript:void(0)" id="cancel" onclick="$('#show').hide();">Cancel</a> 
                    <div class="clear"></div>
                    </div>
            <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </li>
    </ul>
	
    <?php $this->endWidget(); ?>


<script>
$(document).ready(function(){
    if($("#Resources_filename").val()!=''){
        $('#filename').hide();
        $('#removeDoc').show();
    }
    
    $('.dropdown-menu li').click(function(){
        var value=$(this).children('a').html();
        var id = $(this).children('a').attr('id');
        $('.show_label').html(value);
        $('#Resources_cat_id').val(id);
    });
});
</script>