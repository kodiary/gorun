<div class="greybg mar-bot-10">

<?php if($model->file && !$model->isNewRecord){
$upload = "display:none;";
$fileDiv = "display:block";
}
elseif($model->isNewRecord){
    $upload = "display:block;";
    $fileDiv =  "display:none";
}
elseif(!$model->file && !$model->isNewRecord){
    $upload = "display:block;";
    $fileDiv =  "display:none";
} //echo $model->file.">>file:".$fileDiv."<br>upload:".$upload;
if((!$model->isNewRecord && $model->file && file_exists(Yii::app()->basePath.'/../documents/'.$model->file)) ||  $model->isNewRecord || !$model->file && !$model->isNewRecord)
{
?>
<li id="remove_<?php echo $index?>">

<div id="uploadDiv_<?php echo $index;?>" style="<?php echo $fileDiv?>">
   <div id="fileDiv">
   <?php $folder=Yii::app()->basePath.'/../documents/'.$model->file;
   $filesize = CommonClass::format_file_size(filesize($folder));?>
   	<h4 class="floatLeft">Included a file <span class="blue">(optional) - </span><span id="fileInfo_<?php echo $index;?>"><?php echo $model->file.' ('.$filesize.')'?></span></h4>
    
    <div id="uploadFile" class="floatRight"> <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Remove',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$index,
                'onClick'=>'$("#ArticleFile_'.$index.'_file").val("");$("#browseFile_'.$index.'").show();$("#uploadDiv_'.$index.'").hide();$("#event_file").val("null")'),
            ));?>
      </div>
      <div class="clear"></div>
    </div>    
</div>

<div id="browseFile_<?php echo $index;?>" class="browse" style="<?php echo $upload?>">
    <h4 class="floatLeft">Included a file <span class="blue">(optional) - Upload a PDF or Microsoft Word Doc</span></h4>
    <div class="buttons_for_img floatRight">
    <div id="file-uploader_<?php echo $index;?>">
    <div class="qq-uploader">
        <div id="uploadFile_<?php echo $index;?>">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="qq-upload-button" id="<?php echo $index;?>" style="position: relative; overflow: hidden; direction: ltr; margin-bottom:0 !important" ><span class="uploadControl">Browse</span>
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

</li>
<?php
}
?>

<input type="hidden" name="file" value="" id="event_file" />
    </div>
    <div class="clear"></div>
