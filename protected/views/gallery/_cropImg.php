<div class="crop_outer">
<?php echo CHtml::beginForm($this->createUrl('gallery/crop'), 'POST')?>
 	<div class="crop_top">
    <p class="left">Select the area you wish to crop and click the crop button</p>
    <div class="right">
      <?php 
      echo CHtml::ajaxSubmitButton( 'Crop',
                $this->createUrl('gallery/crop'),
                array(
                'error'=>'js:function(){
                    alert(\'error\');
                }',
                'success'=>"js:function(data){
                    $('.cropIt').val('Crop');
                    $('#upimage_0').html('');
                    $('#upimage_0').html('<img src=\"'+data+'\"/>');
                    var filename = data.split('thumb/');
                    $('.main_logo').val(filename[1]);
                     return false;
                }",
                ),
                array('id'=>'cropIt_'.rand(),'class'=>'btn btn-primary cropIt','data-dismiss'=>'modal','onclick'=>'$(".cropIt").val("loading...");')
        );
        
        
      ?>
      <a href="javascript:void(0)" data-dismiss="modal" id="clearCrop" class="btn btn-default">Cancel</a>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="crop_img_sec">
	<?php echo CHtml::hiddenField('filename',$image);?>
	<?php echo CHtml::hiddenField('cropID');?>
	<?php echo CHtml::hiddenField('cropX','0');?>
	<?php echo CHtml::hiddenField('cropY', '0');?>
	<?php echo CHtml::hiddenField('cropW', '215');?>
	<?php echo CHtml::hiddenField('cropH', '215');?>
    
    
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
            'minSize'=> array(215,215),
        	'setSelect'=>array(0, 0, 215, 215),
    	),
	)
	);
	?>
    </div>
<?php echo CHtml::endForm()?>
</div>