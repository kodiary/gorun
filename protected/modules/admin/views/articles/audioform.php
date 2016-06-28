<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h1>Audio - <span class="blue">Include audio with your article - (Optional)</span></h1>
  </div>
  <!--subTitle-->
  <div class="line"></div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articleAudio-form',
));?>
<div class="addContentArea addAudio">
<?php //echo $form->hiddenField($model,'filename'); ?>
  
    <ul class="images">
		<?php for($i=0; $i<count($model); $i++):?>
			<?php $this->renderPartial('_addaudio', array(
				'model' => $model[$i],
				'index' => $i,
			))?>
		<?php endfor ?>
	</ul>
    </div><!--addCOntentArea-->
    
<?php echo CHtml::button('+Add Audio', array('class' => 'btn audio-add'))?>
<div class="greybg margintopbot10">
<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large','style'=>'margin-left:120px'));?>
</div><!--greybg-->
<?php $this->endWidget();?>

</aside>
<!--addArticles-->

<aside class="rightContainer floatRight">
    <?php 
  if(isset($_GET['id'])) {
    $this->renderPartial('_social'); 
  }
  ?>
</aside>
<!--rigtCOntainer-->
<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.qq-upload-button').each(function(){
        var index=$(this).attr('id');
        initiateUpload(index);
   });
   $(".audio-add").click(function(){
    var count=$(".images li").size(); 

		 $(".audio-add").val('loading...');
			$.ajax({
				success: function(html){
					$(".images").append(html);
                    initiateUpload(count);
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
function initiateUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("articles/uploadAudio/index");?>/'+index,
    'allowedExtensions':['wav','mp3'],
    'sizeLimit':<?php echo Yii::app()->params['audio_size']?> * 10485760,
    'onSubmit':function()
            {
                $('#uploadFile_'+index).find('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadFile_'+index).find('.uploadControl').text('Browse');
        $('#uploadControl_'+index).text('Browse');
            if(responseJSON.success)
            {
                //$('#image_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                $('#browseFile_'+index).hide();
                $('#uploadDiv_'+index).css('display','block');
                $('#fileInfo_'+index).html(fileName+' ('+responseJSON.fileSize+')');
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
