<div class="crop_outer">
<?php echo CHtml::beginForm(Yii::app()->baseUrl.'/gallery/crop', 'POST');
    if(isset($_GET['crop_cover'])&& $_GET['crop_cover'] !='')
    {
        
        $main_logo ='uploaded_cover';
        $upimage = 'upimage_1';
    }
    else
    {
        $main_logo = 'main_logo';
        $upimage = 'upimage_0';
    }
    
?>
 	<div class="crop_top">
    <p class="left">Select the area you wish to crop and click the crop button</p>
    <div class="right">
      <?php //$upimage_0
      $class = (isset($_GET['img-circle']))? 'class="img-circle"':'';      
      echo CHtml::ajaxSubmitButton( 'Crop',
                Yii::app()->baseUrl.'/gallery/crop',
                array(
                'error'=>'js:function(){
                    alert(\'error\');
                }',
                'success'=>"js:function(data){
                    $('.cropIt').val('Crop');
                    $('.ui-dialog-titlebar-close').click();
                    $('#".$upimage."').html('');
                    $('#".$upimage."').html('<img src=\"'+data+'\" ".$class."/>');
                    var filename = data.split('thumb/');
                    $('.".$main_logo."').val(filename[1]);
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