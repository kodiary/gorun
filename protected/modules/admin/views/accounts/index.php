<div class="left_body">
    <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
    <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
    	'id'=>'accounts-form',
        'type'=>'horizontal',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));?>
    <div class="line"></div>
    <h1>Accounts Page <span class="blue"> - Accounts page in member section</span></h1>
    <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'detail')); ?>
    <?php echo $form->error($model,'detail'); ?>
    
    <?php echo $form->hiddenField($model,'filename',array('value'=>$model->filename)); ?>
    <?php if($model->filename && !$model->isNewRecord){
            $upload = "display:none;";
            $fileDiv = "";
        }
        elseif($model->isNewRecord){
            $upload = "";
            $fileDiv =  "display:none";
        }
        elseif(!$model->filename && !$model->isNewRecord){
            $upload = "";
            $fileDiv =  "display:none";
        }
    ?>
    <div id="uploadDiv" class="border_line" style=" <?php echo $upload;?>"> 
        <div class="fl_left">Include a file - <span class="blue"><span class="Bold">(Optional)</span> - Upload a PDF or Microsoft Word Doc</span></div>
        <div class="fl_right">
            <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'filename',
                'config'=>array(
                       'action'=>$this->createUrl('accounts/upload'),
                       'allowedExtensions'=>array("pdf","doc","docx"),//array("jpg","jpeg","gif","exe","mov" and etc...
                       'sizeLimit'=>Yii::app()->params['image_size']*1024*1024,// maximum file size in bytes
                       'onProgress'=>"js:function(id, fileName, loaded, total){
                                $('#uploadControl').text('Uploading...');
                            }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                 $('#uploadControl').text('Select');
            			    	if(!responseJSON.error){	                           
                                    $('#fileInfo').html(fileName+' ('+responseJSON.fileSize+')');
                                        $('#Accounts_filename').val(responseJSON.filename);
                                        $('#uploadDiv').hide();
                                        $('#fileDiv').show();
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
        </div>
        <div class="clear"></div>
    </div>

    <div id="fileDiv" class="border_line" style=" <?php echo $fileDiv;?>">
        <?php $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
        $filesize = CommonClass::format_file_size(filesize($folder));?>
        <div class="floatLeft">
            <h2>Inclued a file - <span id="fileInfo" class="blue"><?php echo 'Debit Order Form ('.$filesize.')'?></span></h2>
        </div>
    
        <div class="floatRight">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#Accounts_filename").val("");$("#uploadDiv").show();$("#fileDiv").hide();'),
        ));?>
        </div>
        <div class="clear"></div>
    </div>    

    <div class="line"></div>
    <?php $this->widget('bootstrap.widgets.BootButton', array(
		'buttonType'=>'submit',
		'size'=>'large', // '', 'large', 'small' or 'mini'
		'type'=>'primary',
		'label'=>'Submit',
        'htmlOptions'=>array('id'=>'submit'),
	)); ?>
<?php $this->endWidget(); ?>
</div>
<div class="right_body">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        //'fn'=>'ajaxLink',
        'url' => array('/admin/contents/index'),
        'label'=>'Cancel',
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'small' or 'large'
    ));?>
</div>
<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
    var error = false;
    var editor = CKEDITOR.instances['Accounts[detail]'];
    editor.on("blur",function(e){
            var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
            if (editorcontent.length){
                $('#Accounts_detail_em_').html("");
                $('#Accounts_detail_em_').hide();
                error = false;
            }
            else{
                $('#Accounts_detail_em_').html("Accounts detail cannot be blank.");
                $('#Accounts_detail_em_').show();
                error = true;
            }
    });
    
    $('#submit').click(function(){
        if(error==true) return false;
        else return true; 
    });
});
</script>