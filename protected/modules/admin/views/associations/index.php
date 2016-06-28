<h3 class="admin_top_list_headings">List of <span class="bold">Associations</span></h3>
<div class="left_body">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php 
$itemsCount = Yii::app()->params['items_pers_page'];
/* auto scrolling on showall*/
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.association_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more association.',
    'pages' => $pages,
));?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('/admin/associations/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
        
</div><!--#left_body-->

<div class="right_body">
	<div class="well">
    <div class="img_upload_form">
    
    <?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
    	'id'=>'association-form',
		'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
        'htmlOptions'=>array('enctype'=>'multipart/form-data')
    )); ?>

    <?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>
    <div class="inpt_fld">
		<?php echo $form->textField($model,'ass_name',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'Add/Edit Association')); ?>
    </div>
    <?php echo $form->error($model,'ass_name');?>
    
    <div class="img_upl_fld">
    <div class="button_brw">	

     <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id'=>'uploadFile',
                    'config'=>array(
                                   'action'=>$this->createUrl('upload', array('case'=>'association')),
                                   'multiple'=> false,
                                   'debug'=> true,
                                   'allowedExtensions'=>array("jpg","jpeg",'gif','png'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes (10 MB))
                                   //'minSizeLimit'=>1024,// minimum file size in bytes
                                   'onComplete'=>"js:function(id, fileName, responseJSON){ 
                                            //remove the previous image li
                                            if($('ul.qq-upload-list').children().length>1)
                                            {
                                                $('ul.qq-upload-list li:first').remove();
                                            }
                                            if(responseJSON.success)
                                            {
                                                $('#thumbImg').html('<img src=\"'+responseJSON.imageThumb+'\"/>');
                                                $('#settingImage').val(responseJSON.filename);
                                                
                                                //$('#cropImg').load('". $this->createUrl('cropImg') ."/fileName/'+fileName);
                                            }
                                   }",
                                   'messages'=>array(
                                                    'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                     'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                     'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                     'emptyError'=>"{file} is empty, please select files again without it.",
                                                     'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                   ),
                                   'showMessage'=>"js:function(message){ alert(message); }"
                                  )
                  ));
         ?>
	 </div>
    <div class="img_thumbs" style="width:56px; height:50px;">	
    <div id="thumbImg"></div> 
    </div>
    <p class="image_know_he" style="padding-top:10px;">56*50px</p>	
    <?php echo CHtml::hiddenField('ImageName','',array('id'=>'settingImage'));?>
    <div class="clear"></div>
 	<div class="btn_w_sub" style="margin-top:0;">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'submit',
    'label'=>'Submit',
    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    //'size'=>'small', // '', 'large', 'small' or 'mini'
)); ?>
       
	</div>
    <div class="clear"></div>

<?php $this->endWidget(); ?>
</div>
</div>
</div>
</div><!--#right_body-->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').live('click',function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
   });
   
   $('.btn-info').live('click',function(){
    var val = this.id.split('_');
    if(id=val[1])
    {
        $.ajax({
          type: "POST",
          dataType: 'json',
          cache: false,
          url: '<?php echo $this->createUrl("getAssociation")?>',
          data: "id="+id
        }).done(function( data ) {
          $("#Associations_ass_name").val(data.name);
          $("#Associations_id").val(id);
          $('#thumbImg').html('<img src=\"'+data.image+'\"/>');
        });
    }
   });
});
</script>