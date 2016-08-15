<script type="text/javascript">
$(function(){
   $('.qq-upload-button').each(function(){
        var index=$(this).attr('id');
        initiateUpload(index);
   });   
});
function initiateUpload(index)
{
    var index=0;
    new qq.FileUploader({'element':document.getElementById('uploadFile'),
    'debug':true,
    'multiple':false,
	'action':'<?php echo $this->createUrl('gallery/upload?type='.$type)?>',
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
    'minHeight':215,
    'minWidth':215,
    'onSubmit':function()
            {
                //$(this).http://github.com/valums/file-uploader
                $('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
            if(responseJSON.success)
            {
                //if(index==0)
                //{
                    $('#upimage_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                    $('.uploaded_image').val(responseJSON.filename);
                    $('.main_logo').val(responseJSON.filename);
                    $('#Gallery_'+index+'_name').val(responseJSON.filename);    
                //}
                //else
                //$('#uploadList').append('<li class="items"><div class="thumbnail" style="width: 80px;height:80px;  float:left;"><img src="'+responseJSON.imageThumb+'"/></div><div class="button_rows"><a herf="javascript:void(0);" class="btn btn-danger" onclick="$(this).closest(\'li\').remove();">Remove</a></div><div class="clear"></div><div style="margin:10px 0;"><textarea placeholder="Caption" name="Gallery['+index+'][caption]"></textarea><input type="hidden" name="Gallery['+index+'][name]" value="'+responseJSON.filename+'"/></div></li>');
                //index++;
            }
            /*
            else if(responseJSON.error)
            {
                alert(responseJSON.error);
            }
            else
            {
                alert('something went wrong!');
            } */
            $('.uploadControl').text('Upload'); 
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','minHeightError': "{file} dimension is too small, minimum Height is {minHeight}.",
            'minWidthError': "{file} dimension is too small, minimum Width is {minWidth}.",'emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>

<div class="" style="margin-bottom: 10px;">
    
    <div class="image_rows">
    <?php //echo CHtml::activeHiddenField($model, "[0]name")?>
    <input type="hidden" name="logo" class="main_logo" value=""/>
    <input type="hidden" class="uploaded_image" value="<?php echo $member->logo;?>"/>
     
   
    
    <div class="button_rows">
     <div id="file-uploader_0">
     <div class="qq-uploader">
    <div>
        <div id="uploadFile">
            <div class="qq-uploader" >
                <div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>
                <div class="image_rows">
                	<div class="qq-upload-button btn-primary" id="0" style="position: relative; overflow: hidden; direction: ltr;" >
                    <span class="uploadControl">Upload</span>
                    <input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>
                </div>
                </div>
                <ul style="display:none" class="qq-upload-list"></ul>
            </div>
        </div>    
    </div>
    </div>
    </div>
    </div>
 	<div class="clear"></div>   
     
    </div>

 <ul id="uploadList"></ul>


    <div class="line"></div>
    <?php //echo CHtml::activeHiddenField($model, "[0]id");?>

     

</div>