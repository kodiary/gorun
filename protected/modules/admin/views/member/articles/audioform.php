  <div class="subTitle">
    <h2>Audio - <span class="blue">Include audio with your news - (Optional)</span></h2>
  </div>
  <!--subTitle-->

<div class="addContentArea addAudio">
    <ul class="audio-lists">
        <?php if(!$model_audio->isNewRecord){
            foreach($model_audio as $i=>$model){
                $this->renderPartial('_addaudio', array(
    				'model' => $model,
    				'index' => $i,
    			));            
            }
        } ?>
	</ul>
</div><!--addCOntentArea-->
<div class="line"></div>    
<?php echo CHtml::button('+Add Audio', array('class' => 'btn audio-add'))?>
<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.qq-upload-audio-button').each(function(){
        var id=$(this).attr('id');
        var index = id.split('_')[1];
        initiateAudioUpload(index);
   });
   $(".audio-add").click(function(){
        var counter = $(".audio-lists li").size();
         
        if(counter<=0){
            counter = 100;
            var count = counter;
        }else{
            var last = $(".audio-lists li[id^=remove_audio_]:last").attr("id");
            var count = last.split('_')[2];
            count++;
        }

		 $(".audio-add").val('loading...');
			$.ajax({
				success: function(html){
					$(".audio-lists").append(html);
                    initiateAudioUpload(count);
				},
                complete: function(){
                     $(".audio-add").val('+Add Audio');
                },
				type: 'get',
				url: '<?php echo $this->createUrl('addAudioField')?>',
				data: {
					index: count
				},
				cache: false,
				dataType: 'html'
			});
        });
   
});
function initiateAudioUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadAudioFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("member/articles/uploadAudio/index");?>/'+index,
    'allowedExtensions':['wav','mp3'],
    'sizeLimit':<?php echo Yii::app()->params['audio_size']?> * 10485760,
    'template': '<div id="audio-file-uploader_'+index+'">'+    
                '<div class="qq-uploader">'+
                '<div id="uploadAudioFile_'+index+'">'+
                '<div class="qq-uploader" >'+
                '<div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>'+
                '<div class="qq-upload-button qq-upload-audio-button" id="audio_'+index+'" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>'+
                '<input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>'+
                '</div>'+
                '<ul style="display:none" class="qq-upload-list"></ul>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>',
    'onSubmit':function()
    {
        $('#uploadAudioFile_'+index).find('.uploadControl').text('Uploading...');
    },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadAudioFile_'+index).find('.uploadControl').text('Browse');
        $('#uploadControl_'+index).text('Browse');
            if(responseJSON.success)
            {
                //$('#image_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                $('#browseAudioFile_'+index).hide();
                $('#uploadAudioDiv_'+index).css('display','block');
                $('#audioFileInfo_'+index).html(fileName+' ('+responseJSON.fileSize+')');
                $('#ArticleFile_'+index+'_filename').val(responseJSON.filename);
            }
            else
            {
                alert('something went wrong!');
            }  
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>