<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.js"));
        Yii::app()->clientScript->registerCssFile(Yii::app()->assetManager->publish(Yii::app()->basePath."/../js/fileuploader.css"));?>

     			<div id="file-uploader">
     <div class="qq-uploader">

        <div id="uploadFile">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="qq-upload-button" id="" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Upload</span>
                    <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                </div>
                <ul style="display:none" class="qq-upload-list"></ul>
            </div>
        </div>

    </div>
    </div>
     <?php //echo CHtml::activeHiddenField($model, "[$index]image");?>

<script type="text/javascript">
$(document).ready(function(){
   $('.banner_type').change(function(){

           var size = $(this).val();//$("input:radio['id'='Banner_size']:checked").val();
           //alert(size);
       initiateUpload(size);

   });
   initiateUpload(0);
});
function initiateUpload(size)
{
    //var size = $("#Banner_size").val();
    //alert(size);
    new qq.FileUploader({'element':document.getElementById('uploadFile'),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("banner/upload/size");?>/'+size,
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
    'onSubmit':function()
            {
                $('#uploadFile').find('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadFile').find('.uploadControl').text('Browse');
        $('#uploadControl').text('Browse');
            if(responseJSON.success)
            {
                $('#banner').html('<img src="'+responseJSON.imageThumb+'"/>');
                $('#Banner_image').val(responseJSON.filename);
            }
            else
            {
                alert('something went wrong!');
            }
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>