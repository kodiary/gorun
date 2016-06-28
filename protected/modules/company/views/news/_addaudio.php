<div class="line"></div>
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
if((!$model->isNewRecord && $model->filename && file_exists(Yii::app()->basePath.'/../audio/'.$model->filename)) || $model->isNewRecord)
{
?>
<li id="remove_audio_<?php echo $index?>">
<?php echo CHtml::activeLabel($model,"title"); ?>
<?php echo CHtml::activeTextField($model,"[$index]title", array('class'=>'full-width mar-bot-10')); ?>
<div class="clear"></div>
<?php echo CHtml::activeHiddenField($model, "[$index]filename");?>
<div class="greybg margintop10">
<aside id="browseAudioFile_<?php echo $index;?>" class="" style="<?php echo $upload?>">

    <div class="buttons_for_img">
		<div id="audio-file-uploader_<?php echo $index;?>">
            <div class="qq-uploader">
                <div id="uploadAudioFile_<?php echo $index;?>">
                    <div class="qq-uploader" >
                        <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                        <div class="qq-upload-button qq-upload-audio-button" id="audio_<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
                            <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                        </div>
                        <ul style="display:none" class="qq-upload-list"></ul>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="clear"></div>
    
</aside>

<aside id="uploadAudioDiv_<?php echo $index;?>" style="<?php echo $fileDiv?>" class="">
   <div id="audiofileDiv">
   <?php 
   if(!empty($model->filename)){
   $folder=Yii::app()->basePath.'/../audio/'.$model->filename;
   $filesize = CommonClass::format_file_size(filesize($folder));}?>
   	<h4  style="margin-top:6px" class="floatLeft" id="audioFileInfo_<?php echo $index;?>"><strong><?php echo $model->title;?></strong> <?php echo '('.$filesize.')'?></span></h4>
    <div id="uploadAudioFile" class="floatRight">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Remove',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_audio_'.$index,
                'onClick'=>'$("#ArticleFile_'.$index.'_filename").val("");$("#browseAudioFile_'.$index.'").show();$("#uploadAudioDiv_'.$index.'").hide();'),
            ));?>
    </div>
    <div class="clear"></div>
    </div>    
</aside>

<div class="clear"></div>

</div><!--greybg-->
</li>
<?php
}
?>