<div class="right_bar_blocks">
<?php if(Yii::app()->controller->action->id=='index')
{?>
<div class="right_btns">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => $this->createUrl('create'),
                    'label'=>'+Add Job',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>

<div class="color_indicators">
 	<div class="color"></div>
    <div class="ind_text" style="width: 240px;">Inactive Listing</div>
</div>
<?php }else{ ?>
<div class="right_btns">
   <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => $this->createUrl('index'),
                    'label'=>'Cancel',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));
   ?> 
</div>
<?php }?>
</div>