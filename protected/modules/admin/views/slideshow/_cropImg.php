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
                'dataType'=>'json',
                'success'=>'js:function(data){
                    //$("#cropIt"+data.index).val("Crop");
                    //$("#cropImg").hide();
                    $("#crop"+data.index).val("Crop");
                    $("#image_"+data.index).html("<img src=\'"+data.thumbImage+"\'/>");
                    $("#cropModal").dialog("close"); 
                    //return false;
                }',
                ),
                array('id'=>'cropIt'.$index,'class'=>'btn btn-primary','onclick'=>'$("#cropIt'.$index.'").val("loading...");')
        );
        
        
      ?>
      <?php $this->widget('bootstrap.widgets.BootButton', array(
            'size' =>'normal',
			'label'=>'Cancel',
            'id' =>'clearCrop',
            'htmlOptions' =>array('onclick'=>'$("#cropModal").dialog("close");$("#crop'.$index.'").val("Crop");'),
            //'htmlOptions' =>array('onclick'=>'$("#cropImg").html("");'),
		));  ?>
        </div>
        <div class="clear"></div>
  </div>
  
  <div class="crop_img_sec">
	<?php echo CHtml::hiddenField('filename',$filename);?>
    <?php echo CHtml::hiddenField('index',$index);?>
	<?php echo CHtml::hiddenField('cropID');?>
	<?php echo CHtml::hiddenField('cropX','0');?>
	<?php echo CHtml::hiddenField('cropY', '0');?>
	<?php echo CHtml::hiddenField('cropW', '980');?>
	<?php echo CHtml::hiddenField('cropH', '270');?>
    
    
	<?php $this->widget('ext.jcrop.jCropWidget',array(
    	'imageUrl'=>$imageUrl,
    	'formElementX'=>'cropX',
    	'formElementY'=>'cropY',
    	'formElementWidth'=>'cropW',
    	'formElementHeight'=>'cropH',
    	'jCropOptions'=>array(
        	'aspectRatio'=>3.6296, 
        	'boxWidth'=>600,
        	//'boxHeight'=>350,
            'minSize'=> array(255,70),
            'maxSize'=> array(980,270),
        	'setSelect'=>array(0, 0, 980, 270),
    	),
	)
	);
	?>
    </div>
<?php echo CHtml::endForm()?>
</div>