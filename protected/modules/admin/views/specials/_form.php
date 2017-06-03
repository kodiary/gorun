<?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = Yii::app()->user->id;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'specials-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($model); ?>
<ul class="floating_lists">

<li><?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?></li>
<li>
	<?php echo $form->labelEx($model, 'expiry_date');?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model'=>$model,
    'attribute'=>'expiry_date',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'dd MM yy',
        'minDate'=>0,
        'maxDate'=>'+2M', // 2 months further
        'buttonImage'=>Yii::app()->baseUrl.'/images/calender.png',
        'buttonImageOnly'=>true,
        'showOn'=>"both",
        'constrainInput'=>false,
        //'buttonText'=>'17',
        //'altFormat' => 'dd-mm-yy', // show to user format
    ),
    'htmlOptions'=>array(
        'class'=>'span5',
        'value'=>($model->expiry_date)?CommonClass::formatDate($model->expiry_date):'',
    ),
));?>
<?php echo $form->error($model, 'expiry_date');?>
<div class="clear"></div>
</li>

<li class="full_label">
<?php echo $form->labelEx($model,'detail');?>
<div class="clear"></div>
</li>

<li>
<?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'detail')); ?>
<?php echo $form->error($model,'detail'); ?>
<div class="clear"></div>
</li>

<h2>Category - <span>Tag your special to a Product or Service (required)</span></h2>
<div class="line"></div>
</li>
<li>
<?php if($comSpecials=CompanySpecials::listSpecialsProducts($id)){ ?>
<div class="margintopbot10">
    <?php 
    if(!$model->isNewRecord)$specials->product_id=CompanySpecials::getProductBySpecial($model->id);
    ?>
    <h2><label for="CompanySpecials_product_id">Product</label></h2>
    <div class="fl_left" style="width: 435px;"><?php echo $form->radioButtonList($specials,'product_id',$comSpecials,array('empty'=>'Select Product'));?></div>
 <div class="clear"></div>
<div class="line"></div>
<?php } ?>
<?php if($comProducts=CompanySpecials::listSpecialsServices($id)){ ?>    
    <div class="margintopbot10">    
    <?php 
    if(!$model->isNewRecord)$specials->service_id=CompanySpecials::getServiceBySpecial($model->id);
    ?>
    <label for="CompanySpecials_product_id">Service</label>
    <div class="fl_left" style="width: 435px;"> <?php echo $form->radioButtonList($specials,'service_id', $comProducts, array('empty'=>'Select Service')); ?></div>
    <div class="clear"></div>
    <div class="line"></div>
    </div>
<?php } ?>
</li>
</ul>

<h2>Photo - <span>Include an image with your special - (Optional)</span></h2>
<div class="line"></div>
<div class="news_image_listing">
<div class="buttons_for_img"> 
<div>
    <div class="item_img thumbnail" id="logo">
        <?php
        $logo = $model->image;
        if($logo!="")
        {
             if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$logo)) 
             //if(Yii::app()->file->set('/images/frontend/thumb/'.$logo)->exists)
             {
                $logoUrl=Yii::app()->baseUrl.'/images/frontend/thumb/'.$logo;
            ?>
            <input type="hidden" name="recrop" id="recrop" value="0"/>
            <img src="<?php echo $logoUrl;?>"/>
            <?php }}else{echo CHtml::image(Yii::app()->baseUrl.'/images/blank_images.gif');}?>
    </div>
</div>
</div>
 
<div class="submit_buttons_img">
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload', //select file button
                array(
                    'id'=>'uploadFile',
                    'config'=>array(
                                   'action'=>$this->createUrl('upload', array('case'=>'specials')),
                                   'multiple'=> false,
                                   'debug'=> true,
                                   'allowedExtensions'=>array("jpg","jpeg",'gif','png'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                   'sizeLimit'=>200*1024*1024,// maximum file size in bytes (10 MB))
                                   //'minSizeLimit'=>1024,// minimum file size in bytes
                                   'onProgress'=>"js:function(id, fileName, loaded, total){
                                        $('#uploadControl').text('Uploading...');
                                    }",
                                   'onComplete'=>"js:function(id, fileName, responseJSON){
                                            $('#uploadControl').text('Select');
                                            if(responseJSON.success)
                                            {
                                                $('#logo').html('<img src=\"'+responseJSON.imageThumb+'\"/>');
                                                $('#logoFilename').val(responseJSON.filename);
                                                //$('#cropImg').load('". $this->createUrl('cropImg') ."/fileName/'+fileName);
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
                  ));
    ?>
    <?php
    //crop button
     echo CHtml::ajaxLink('Crop',
                $this->createUrl('cropLogo'),
                 array( //ajax options
                 'data'=>array('fileName'=>'js:$("#logoFilename").val()'),
                 'type'=>'POST',
                'success'=>"js:function(data){
                            $('#cropImg').html(data);
                            }",
                'complete'=>"js:function(){
                             $('#crop').val('Crop');
                            }",
                ),
                array('id'=>'crop','class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#logoFilename").val()=="")alert("Please upload the logo and try cropping");else $("#crop").val("loading...");')//html options
    );
    ?>    
</div>

    <div class="image_captions_holders">    
        <?php echo $form->labelEx($model, "image_caption");?>
    	<?php echo $form->textArea($model, "image_caption");?> 
    </div>
    
    <div class="fl_right remv">
     <?php
    //clear button
     $this->widget('bootstrap.widgets.BootButton', array(
                'buttonType'=>'ajaxLink',
                'url' => array('clearCroppedImage','id'=>$model->id),
                'label'=>'Remove',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'normal', // '', 'small' or 'large'
                'ajaxOptions'=>array(
                        'success' => 'function(data){
                            $("#logo").html("");
                            $("#logoFilename").val("");
                            //$("#crop").html("");
                            $("#logo").html("<img src=/signdirectory/images/blank_images.gif>");
                        }',
                ),
                'htmlOptions'=>array(
                        //'class' => 'pull-right',
                        'id'=>'clearLogo',
                ),
                ));?>
    </div>

<div class="clear"></div>
</div>
    
    <div id="cropImg" style="display:none;"></div>
    
    <input type="hidden" name="image" id="logoFilename" value="<?php echo $logo?>"/>
    <div class="line"></div>  
    
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
    <h2>Include a File - <span>(Optional) - Upload a PDF, Microsoft Word Doc</span></h2>
    
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
    array(
            'id'=>'uploadPdfFile',
            'config'=>array(
                   'action'=>$this->createUrl('uploaddoc'),
                   'multiple'=> false,
                   'debug'=> true,
                   'allowedExtensions'=>array("pdf","doc","docx"),//array("jpg","jpeg","gif","exe","mov" and etc...
                   'sizeLimit'=>200*1024*1024,// maximum file size in bytes
                   //'minSizeLimit'=>10*1024*1024,// minimum file size in bytes
                    'onProgress'=>"js:function(id, fileName, loaded, total){
                        $(this).find('.selectCtrl').text('Uploading...');
                    }",
                   'onComplete'=>"js:function(id, fileName, responseJSON){
                            $(this).find('.selectCtrl').text('Select');
    				    	if(!responseJSON.error){
                                $('#fileInfo').html(fileName+' ('+responseJSON.fileSize+')');
                                $('#Specials_filename').val(responseJSON.filename);
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
    <?php $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
   $filesize = CommonClass::format_file_size(filesize($folder));?>
   	<h2>Inclued a file - <span id="fileInfo"><?php echo $model->title.' ('.$filesize.')'?></span></h2>
    
    <div id="uploadFile"><?php 
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#Specials_filename").val("");$("#uploadDiv").show();$("#fileDiv").hide();'),
            ));?>
      </div>
      <div class="clear"></div>
    </div>    
   </div>
   
<div class="line"></div>
	<div style="padding-left:156px;">
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
                        $deleteUrl = array('delete', 'id'=>$id, 'specId'=>$_GET['specId']);
                     elseif(isset(Yii::app()->user->id))
                        $deleteUrl = array('delete', 'specId'=>$_GET['specId']);
                     else
                        $deleteUrl = '';?>
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
$(document).ready(function(){
    
    var editor = CKEDITOR.instances['Specials[detail]'];
    editor.on("blur",function(e){
            var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
            if (editorcontent.length){
                $('#Specials_detail_em_').html("");
                $('#Specials_detail_em_').hide();
                error=false;
            }
            else{
                $('#Specials_detail_em_').html("Special detail cannot be blank.");
                $('#Specials_detail_em_').show();
                error=true;
            }
    });
});
</script>