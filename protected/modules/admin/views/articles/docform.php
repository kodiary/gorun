<aside class="leftContainer floatLeft addArticles">
<div class="line"></div>
<?php $this->renderPartial('_articlesmenu');?>
  <div class="line"></div>
  <div class="subTitle">
    <h2>Documents - <span class="blue">Include a document with your article - (Optional)</span></h2>
  </div>
  <!--subTitle-->
  <div class="line"></div>

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
}?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'articleAudio-form',
));?>
<?php //echo $form->hiddenField($model,'filename'); ?>
  <div class="addContentArea addAudio">
    <ul class="images">
		<?php for($i=0; $i<count($model); $i++):
			 $this->renderPartial('_adddoc', array(
				'model' => $model[$i],
				'index' => $i,
			));
		 endfor 
        ?>
	</ul>
    
    </div><!--addContentAreas-->
<?php echo CHtml::button('+Add Document', array('class' => 'btn doc-add'))?>
<div class="greybg margintopbot10">
<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-primary btn-large'));?>
</div>
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
   $(".doc-add").click(function(){
    var count=$(".images li").size(); 

		 $(".doc-add").val('loading...');
			$.ajax({
				success: function(html){
					$(".images").append(html);
                    initiateUpload(count);
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
function initiateUpload(index)
{
    new qq.FileUploader({'element':document.getElementById('uploadFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo $this->createUrl("articles/uploadDoc/index");?>/'+index,
    'allowedExtensions':['pdf','doc','jpg','jpeg','docx'],
    'sizeLimit':200*10485760,
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
                $('#fileInfo_'+index).html(responseJSON.filename+' ('+responseJSON.fileSize+')');
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
