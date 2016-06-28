<?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = Yii::app()->user->id;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'featured-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<?php echo $form->hiddenField($model,'company_id',array('value'=>$id)); ?>

<?php echo $form->errorSummary($model); ?>
<ul class="floating_lists">
<li><?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?></li>
<div class="line"></div>

<li class="full_label">
<?php echo $form->labelEx($model,'detail');?>
<div class="clear"></div>
</li>

<li>
<?php echo $form->textArea($model,'detail',array('class'=>'span7','rows'=>5)); ?>
<?php echo $form->error($model,'detail'); ?>
<div class="clear"></div>
</li>
</ul>

<div class="line"></div>
<div class="news_image_listing">

 
<div class="submit_buttons_img fl_left ftdimcup">
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload', //select file button
                array(
                    'id'=>'uploadFile',
                    'config'=>array(
                                   'action'=>$this->createUrl('upload', array('case'=>'featured')),
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
                                                $('#logo').html('<img src=\"'+responseJSON.imageMain+'\"/>');
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
    <div class="clear"></div>
    <div>    
     <?php
    //clear button
     $this->widget('bootstrap.widgets.BootButton', array(
                'buttonType'=>'ajaxLink',
                'url' => array('clearCroppedImage','id'=>$model->id),
                'label'=>'Clear',
                'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'normal', // '', 'small' or 'large'
                'ajaxOptions'=>array(
                        'success' => 'function(data){
                            $("#logo").html("");
                            $("#logoFilename").val("");
                            //$("#crop").html("");
                            $("#logo").html("<img src=/signdirectory/images/blank_imagesx200x200.gif>");
                        }',
                ),
                'htmlOptions'=>array(
                        //'class' => 'pull-right',
                        'id'=>'clearLogo',
                ),
                ));?>
     </div>
</div>

<div class="fl_left"> 

    <div class="" id="logo">
        <?php
        $logo = $model->image;
        if($logo!="")
        {
             if(file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$logo)) 
             {
                $logoUrl=Yii::app()->baseUrl.'/images/frontend/main/'.$logo;
            ?>
            <input type="hidden" name="recrop" id="recrop" value="0"/>
            <img src="<?php echo $logoUrl;?>"/>
            <?php }}else{echo CHtml::image(Yii::app()->baseUrl.'/images/blank_imagesx200x200.gif');}?>
    </div>

</div>

<div class="clear"></div>
</div>
    
    <div id="cropImg" style="display:none;"></div>
    
    <input type="hidden" name="image" id="logoFilename" value="<?php echo $logo?>"/>
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
                        $deleteUrl= array('delete', 'id'=>$_GET['id'], 'featId'=>$model->id);
                     elseif(isset(Yii::app()->user->id))
                        $deleteUrl = array('delete', 'featId'=>$model->id);
                     else
                        $deleteUrl= '';
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