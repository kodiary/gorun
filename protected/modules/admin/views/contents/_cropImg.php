<div class="crop_outer">
<div class="crop_img_sec">
<?php echo CHtml::beginForm($this->createUrl('crop'), 'POST')?>
	<?php //$form in this example is of type AvatarForm, containing variables for the crop area's x, y, width and height, hence the corresponding widget form element parameters ?>
	<?php echo CHtml::hiddenField('cropID');?>
	<?php echo CHtml::hiddenField('cropX','0');?>
	<?php echo CHtml::hiddenField('cropY', '0');?>
	<?php echo CHtml::hiddenField('cropW', '120');?>
	<?php echo CHtml::hiddenField('cropH', '120');?>
    
    
	<?php $this->widget('ext.jcrop.jCropWidget',array(
    	'imageUrl'=>$imageUrl,
    	'formElementX'=>'cropX',
    	'formElementY'=>'cropY',
    	'formElementWidth'=>'cropW',
    	'formElementHeight'=>'cropH',
    	'jCropOptions'=>array(
        	'aspectRatio'=>1, 
        	'boxWidth'=>400,
        	'boxHeight'=>400,
            'minSize'=> array(120,120),
            'maxSize'=> array(350,350),
        	'setSelect'=>array(0, 0, 120, 120),
    	),
	)
	);
	?>
 	<?php echo CHtml::submitButton('Crop'); ?>
<?php echo CHtml::endForm()?>
</div>
</div>