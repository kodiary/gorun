<script type="text/javascript">
$(document).ready(function(){
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
    'multiple':true,
	'action':'<?php echo $this->createUrl('gallery/upload')?>',
    'allowedExtensions':['jpg','jpeg','gif','png'],
    'sizeLimit':10485760,
    'onSubmit':function()
            {
                $('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
            if(responseJSON.success)
            {
                if(index==0)
                {
                    $('#upimage_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                    $('#Gallery_'+index+'_name').val(responseJSON.filename);    
                }
                else
                $('#uploadList').append('<li class="items"><div class="thumbnail" style="width: 80px;height:80px;  float:left;"><img src="'+responseJSON.imageThumb+'"/></div><div class="button_rows"><a herf="javascript:void(0);" class="btn btn-danger" onclick="$(this).closest(\'li\').remove();">Remove</a></div><div class="clear"></div><div style="margin:10px 0;"><textarea placeholder="Caption" name="Gallery['+index+'][caption]"></textarea><input type="hidden" name="Gallery['+index+'][name]" value="'+responseJSON.filename+'"/></div></li>');
                index++;
            }
            else
            {
                alert('something went wrong!');
            } 
            $('.uploadControl').text('Browse'); 
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php $this->renderPartial('application.modules.admin.views.gallery._form',array('model'=>$model));?>
    <div class="line"></div>
    <?php echo CHtml::activeHiddenField($model, "[0]id");?>
	<div>
	<?php $this->widget('bootstrap.widgets.BootButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Submit',
        'size'=>'large',
	)); ?>
   </div>

     
<?php $this->endWidget(); ?>
</div>