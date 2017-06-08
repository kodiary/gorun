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

                'success'=>'js:function(data){

                    $("#cropIt").val("Crop");

                    $("#cropImg").hide();

                    $("#logo").html("<img src=\'"+data+"\'/>");

                    if($("div#logo").find("#recrop"))

                        $("#recrop").val("1");

                }',

                ),

                array('id'=>'cropIt','class'=>'btn btn-primary','onclick'=>'$("#cropIt").val("loading...");')

        );

        

        

      ?>

      <?php $this->widget('bootstrap.widgets.BootButton', array(

            'size' =>'normal',

			'label'=>'Cancel',

            'id' =>'clearCrop',

            'htmlOptions' =>array('onclick'=>'$("#cropImg").html("");'),

		));  ?>
</div>
<div class="clear"></div>
  </div>
  	
    <div class="crop_img_sec">
	<?php echo CHtml::hiddenField('filename',$image);?>

	<?php echo CHtml::hiddenField('cropID');?>

	<?php echo CHtml::hiddenField('cropX','0');?>

	<?php echo CHtml::hiddenField('cropY', '0');?>

	<?php echo CHtml::hiddenField('cropW', '120');?>

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

            'minSize'=> array(120,90),

            'maxSize'=> array(400,320),

        	'setSelect'=>array(0, 0, 120, 90),

    	),

	)

	);

	?>
</div>
<?php echo CHtml::endForm()?>
</div>