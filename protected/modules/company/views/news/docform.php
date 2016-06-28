  <div class="subTitle">
    <h2>Documents - <span class="blue">Include a document with your article - (Optional)</span></h2>
  </div>
  <!--subTitle-->

<?php if($model_document->filename && !$model_document->isNewRecord){
$upload = "display:none;";
$fileDiv = "display:block";
}
elseif($model_document->isNewRecord){
    $upload = "display:block;";
    $fileDiv =  "display:none";
}
elseif(!$model_document->filename && !$model_document->isNewRecord){
    $upload = "display:block;";
    $fileDiv =  "display:none";
}?>


<div class="addContentArea addAudio">
    <ul class="doc-lists">
        <?php if(!$model_document->isNewRecord){
            foreach($model_document as $i=>$model){
                $this->renderPartial('_adddoc', array(
    				'model' => $model,
    				'index' => $i,
    			));            
            }
        } ?>
    </ul>
</div><!--addContentAreas-->
<div class="line"></div>
<?php echo CHtml::button('+Add Document', array('class' => 'btn doc-add'))?>
<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.qq-upload-doc-button').each(function(){
        var id=$(this).attr('id');
        var index = id.split('_')[1];
        initiateDocUpload(index);
   });
   $(".doc-add").click(function(){
    var counter = $(".doc-lists li").size();

    if(counter<=0){
        counter = 150;
        var count = counter;
    }else{
        var last = $(".doc-lists li[id^=remove_doc_]:last").attr("id");
        var count = last.split('_')[2];
        count++;
    }
		 $(".doc-add").val('loading...');
			$.ajax({
				success: function(html){
					$(".doc-lists").append(html);
                    initiateDocUpload(count);
				},
                complete: function(){
                     $(".doc-add").val('+Add Document');
                },
				type: 'get',
				url: '<?php echo $this->createUrl('addDocField')?>',
				data: {
					index: count
				},
				cache: false,
				dataType: 'html'
			});
        });
   
});
function initiateDocUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadDocFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("news/uploadDoc/index");?>/'+index,
    'allowedExtensions':['pdf','doc','jpg','jpeg','docx'],
    'sizeLimit':<?php echo Yii::app()->params['doc_size']?>*10485760,
    'template': '<div id="doc-file-uploader_'+index+'">'+
                '<div class="qq-uploader">' +
                '<div id="uploadDocFile_'+index+'">'+
                '<div class="qq-uploader">'+
                '<div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>'+
                '<div class="qq-upload-button qq-upload-doc-button" id="doc_'+index+'" style="position: relative; overflow: hidden; direction: ltr;" ><span class="uploadControl">Browse</span>'+
                '<input type="file" name="file" style="position: absolute; right: 0pt; top: 0pt; font-family: Arial; font-size: 118px; margin: 0pt; padding: 0pt; cursor: pointer; opacity: 0;"/>'+
                '</div>'+
                '<ul style="display:none" class="qq-upload-list"></ul>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>',
    'onSubmit':function()
            {
                $('#uploadDocFile_'+index).find('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadDocFile_'+index).find('.uploadControl').text('Browse');
        $('#uploadControl_'+index).text('Browse');
            if(responseJSON.success)
            {
                //$('#image_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                $('#browseDocFile_'+index).hide();
                $('#uploadDocDiv_'+index).css('display','block');
                $('#docFileInfo_'+index).html(fileName+' ('+responseJSON.fileSize+')');
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
