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
if((!$model->isNewRecord && $model->filename && file_exists(Yii::app()->basePath.'/../documents/'.$model->filename)) ||  $model->isNewRecord)
{
?>
<li id="remove_<?php echo $index?>">
<?php echo CHtml::activeLabel($model,"title"); ?>
<?php echo CHtml::activeTextField($model,"[$index]title", array('class'=>'inputwidth mar-bot-10')); ?>
<div class="clear"></div>
<?php echo CHtml::activeHiddenField($model, "[$index]filename");?>
<div class="margintop10 greybg mar-bot-10">
<div id="uploadDiv_<?php echo $index;?>" style="<?php echo $fileDiv?>">
   <div id="fileDiv">
   <?php $folder=Yii::app()->basePath.'/../documents/'.$model->filename;
   $filesize = CommonClass::format_file_size(filesize($folder));?>
   	<h4 class="floatLeft" style="margin-top:6px;">Inclued a file - <span id="fileInfo_<?php echo $index;?>"><?php echo $model->title.' ('.$filesize.')'?></span></h4>
    
    <div id="uploadFile" class="floatRight"> <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Remove',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$index,
                'onClick'=>'$("#ArticleFile_'.$index.'_title").val("");$("#ArticleFile_'.$index.'_filename").val("");$("#browseFile_'.$index.'").show();$("#uploadDiv_'.$index.'").hide();$("#remove_'.$index.'").hide();'),
            ));?>
      </div>
      <div class="clear"></div>
    </div>    
</div>
    <div id="browseFile_<?php echo $index;?>" style="<?php echo $upload?>">
        <div class="buttons_for_img">
     			<div id="file-uploader_<?php echo $index;?>">
     <div class="qq-uploader">
        <div id="uploadFile_<?php echo $index;?>">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="qq-upload-button" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>
                    <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                </div>
                <ul style="display:none" class="qq-upload-list"></ul>
            </div>
        </div>    
    </div>
    </div>
    </div>
       
        <div class="clear"></div>
	</div>
    </div><!--greybg-->
</li>
<?php
}
?>