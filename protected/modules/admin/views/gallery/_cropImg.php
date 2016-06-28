<div class="crop_outer">
<?php echo CHtml::beginForm($this->createUrl('crop'), 'POST')?>
 	<div class="crop_top">
    <p class="left">Select the area you wish to crop and click the crop button</p>
    <div class="right">
      <?php 
      echo CHtml::ajaxSubmitButton( 'Crop',
                $this->createUrl('crop'),
                array(
                'error'=>'js:function(){
                    alert(\'error\');
                }',
                'success'=>"js:function(data){
                    $('.cropIt').val('Crop');
                    $('#image_".$id."').html('<img src=\"'+data+'\"/>');
                    $('#cropModal').dialog('close'); return false;
                }",
                ),
                array('id'=>'cropIt_'.rand(),'class'=>'btn btn-primary cropIt','onclick'=>'$(".cropIt").val("loading...");')
        );
        
        
      ?>
      <?php $this->widget('bootstrap.widgets.BootButton', array(
            'size' =>'normal',
			'label'=>'Cancel',
            'id' =>'clearCrop',
            'htmlOptions' =>array('onclick'=>'$("#cropModal").dialog("close");'),
		));  ?>
        </div>
        <div class="clear"></div>
  </div>
  <div class="crop_img_sec">
	<?php echo CHtml::hiddenField('filename',$image);?>
	<?php echo CHtml::hiddenField('cropID');?>
	<?php echo CHtml::hiddenField('cropX','0');?>
	<?php echo CHtml::hiddenField('cropY', '0');?>
	<?php echo CHtml::hiddenField('cropW', '90');?>
	<?php echo CHtml::hiddenField('cropH', '90');?>
    
    
	<?php $this->widget('ext.jcrop.jCropWidget',array(
    	'imageUrl'=>$imageUrl,
    	'formElementX'=>'cropX',
    	'formElementY'=>'cropY',
    	'formElementWidth'=>'cropW',
    	'formElementHeight'=>'cropH',
    	'jCropOptions'=>array(
        	'aspectRatio'=>1, 
        	'boxWidth'=>700,
        	'boxHeight'=>600,
            'minSize'=> array(90,90),
        	'setSelect'=>array(0, 0, 90, 90),
    	),
	)
	);
	?>
    </div>
<?php echo CHtml::endForm()?>
</div>