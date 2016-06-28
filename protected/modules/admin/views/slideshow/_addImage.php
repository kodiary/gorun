<script type="text/javascript">
$(document).ready(function(){
     var count='<?php echo Slideshow::getMaxId(); ?> '; 
     
   $('.qq-upload-button').each(function(){
        var index=$(this).attr('id');
        initiateUpload(index);
   });
   $(".image-add").click(function(){
    count++;
    $(".image-add").val('loading...');
    	$.ajax({
    		success: function(html){
    			$(".images").append(html);
                initiateUpload(count);
    		},
            complete: function(){
                 $(".image-add").val('+Add Slide');
            },
    		type: 'get',
    		url: '<?php echo $this->createUrl('addfield')?>',
    		data: {index: count},
    		cache: false,
    		dataType: 'html'
    	});
    });
});
function initiateUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("slideshow/upload/index");?>/'+index,
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
    'onSubmit':function()
            {
                $('#uploadFile_'+index).find('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadFile_'+index).find('.uploadControl').text('Browse');
        $('#uploadControl_'+index).text('Browse');
            if(responseJSON.success)
            {
                if(responseJSON.errorSize)
                {
                    alert(responseJSON.errorMsg);
                }
                else
                {
                    $('#image_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                    $('#Slideshow_'+index+'_image').val(responseJSON.filename);
                }
            }
            else
            {
                alert('something went wrong!');
            }  
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>