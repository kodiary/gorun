<script type="text/javascript">
$(document).ready(function(){
    $('.qq-upload-image-button').each(function(){
        var counter=$("#uploadList li").size();
        if(counter<=0){
            counter = 0;
            var index = counter;
        }else{
            var last = $("#uploadList li[id^=image_]:last").attr("id");
            var index = last.split('_')[1];
            index++;
        }
        
        //var index=$(this).attr('id');
        initiateUpload(index);
    });   
});
function initiateUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadFile'),
    'debug':true,
    'multiple':true,
	'action':'<?php echo $this->createUrl('news/upload')?>',
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
    'onSubmit':function()
            {
                $('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('.uploadControl').text('Add Photos');
            if(responseJSON.success)
            {
                $('#uploadList').append('<li class="items" id="image_'+index+'"><div><img src="'+responseJSON.imageThumb+'"/><a href="javascript:void(0);" class="btn btn-danger" onclick="$(this).closest(\'li\').remove();">Remove</a><textarea placeholder="Caption" name="ArticleFile['+index+'][title]"></textarea><input type="hidden" name="ArticleFile['+index+'][filename]" value="'+responseJSON.filename+'"/></div></li>');
                index++;
            }
            else
            {
                alert('something went wrong!');
            }  
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>
<div class="form">
	<?php $this->renderPartial('_imageform',array('model'=>$model_image));?>
</div>