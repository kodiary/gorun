<script type="text/javascript">
$(function(){
    initiateUpload1('uploadControl1');
});

function initiateUpload1(index)
{
    //var index=0;
    new qq.FileUploader({'element':document.getElementById('uploadFile1'),
    'debug':true,
    'multiple':false,
	'action':'<?php echo Yii::app()->request->baseUrl.'/gallery/upload?type='.$type;?>',
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
   
    'onSubmit':function()
            {
                //$(this).http://github.com/valums/file-uploader
                 $('#uploadFile1').children().find('.uploadControl').text('Uploading...');
                $('#crop1').css({'pointer-events':'none'});
            },
    'onComplete':function(id, fileName, responseJSON){
            if(responseJSON.success)
            {
                //if(index==0)
                //{
                    $('#upimage_1').html('<img src="'+responseJSON.imageThumb+'"/>');
                    $('.uploaded_cover').val(responseJSON.filename);
                    $('.main_cover').val(responseJSON.filename);
                    setTimeout(function(){ $('#crop1').css({'pointer-events':'auto'}); }, 2000);
                    //$('#Gallery_'+index+'_name').val(responseJSON.filename);    
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
            $('#uploadFile1').children().find('.uploadControl').text('Upload'); 
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','minHeightError': "{file} dimension is too small, minimum Height is {minHeight}.",
            'minWidthError': "{file} dimension is too small, minimum Width is {minWidth}.",'emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
qq.attach(document, 'dragenter', function(e) {
    $('.qq-upload-drop-area').hide();
});
}
</script>

<div class="" style="margin-bottom: 10px;">
    
    <div class="image_rows">
    <?php //echo CHtml::activeHiddenField($model, "[0]name")?>
    <input type="hidden" name="cover" class="main_cover" value=""/>
    <input type="hidden" class="uploaded_cover" value="<?php if(isset($model))echo $model->cover;?>"/>
     
   
    
    <div class="button_rows">
     <div id="file-uploader_1">
         <div class="qq-uploader1">
            <div>
                <div id="uploadFile1">
                    <a href="javascript:void(0)" class="qq-upload-button btn btn-black uploadControl1" id="1" style="font-weight: bold;"><span class="fa fa-picture-o"></span>Upload Image</a>
                       
                </div>    
            </div>
        </div>
    </div>
    </div>
 	<div class="clear"></div>   
     
    </div>

 <ul id="uploadList"></ul>


    </div>
     

