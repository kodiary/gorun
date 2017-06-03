<?php $companyId = $_GET['id']; ?>
<?php if(Yii::app()->controller->action->id=='index')
{?>
<div class="right_btns">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('create', 'id'=>$companyId),
                    'label'=>'+Add Job',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>

<div class="color_indicators">
 	<div class="color"></div>
    <div class="ind_text">Inactive Listing</div>
</div>
<?php }else{ ?>
<div class="right_btns">
   <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index', 'id'=>$companyId),
                    'label'=>'Cancel',
                    //'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));
   ?> 
</div>
<?php }?>
