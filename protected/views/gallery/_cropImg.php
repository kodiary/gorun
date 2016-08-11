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
                    $('.ui-dialog-titlebar-close').click();
                    $('#upimage_0').html('');
                    $('#upimage_0').html('<img src=\"'+data+'\"/>');
                    var filename = data.split('thumb/');
                    $('.main_logo').val(filename[1]);
                     return false;
                }",
                ),
                array('id'=>'cropIt_'.rand(),'class'=>'btn btn-primary cropIt','onclick'=>'$(".cropIt").val("loading...");')
        );
        
        
      ?>
      <a href="javascript:void(0)"  id="clearCrop" class="btn btn-default" onclick="$('.ui-dialog-titlebar-close').click();">Cancel</a>
        </div>
        <div class="clearfix"></div>
  </div>
  <div class="crop_img_sec">
	<?php echo CHtml::hiddenField('filename',$image);?>
	<?php echo CHtml::hiddenField('cropID');?>
	<?php echo CHtml::hiddenField('cropX','0');?>
	<?php echo CHtml::hiddenField('cropY', '0');?>
	<?php echo CHtml::hiddenField('cropW', isset($_GET['width'])?$_GET['width']:'215');?>
	<?php echo CHtml::hiddenField('cropH', isset($_GET['height'])?$_GET['height']:'215');?>
    
    
	<?php $this->widget('ext.jcrop.jCropWidget',array(
    	'imageUrl'=>$imageUrl,
    	'formElementX'=>'cropX',
    	'formElementY'=>'cropY',
    	'formElementWidth'=>'cropW',
    	'formElementHeight'=>'cropH',
    	'jCropOptions'=>array(
        	'aspectRatio'=>(isset($_GET["width"])?$_GET["width"]:215)/(isset($_GET["height"])?$_GET["height"]:215), 
        	'boxWidth'=>'auto',
        	'boxHeight'=>'auto',
            'minSize'=> array(isset($_GET["width"])?$_GET["width"]:215,isset($_GET["height"])?$_GET["height"]:215),
        	'setSelect'=>array(0, 0, isset($_GET["width"])?$_GET["width"]:215,isset($_GET["height"])?$_GET["height"]:215),
    	),
	)
	);
	?>
    </div>
<?php echo CHtml::endForm()?>
</div>