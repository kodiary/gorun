<div class="border_line">
	<div class="text_desc_l ">
    <p class="f17">
    <?php echo CHtml::encode($data->name); ?>
    <span class="15_bl">
    <?php if($data->date_updated!=null){?><?php echo " - ".date('d F Y',strtotime($data->date_updated));?><?php }?>
    </span>
    </p>
    </div>
    <div class="text_desc_r">
    <?php echo CHtml::link('Edit',array('/'.Yii::app()->controller->module->name.'/branches/update/bid/'.$data->id.'/id/'.$_GET['id']),array('class'=>'btn btn-info'))?>
    <?php echo CHtml::link('Delete','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->id.'").show();','class'=>'btn btn-danger'));?>
    </div>
    <div class="clear"></div>
</div>
<div id="div_del_<?php echo $data->id;?>" style="display: none;" class="warning_blocks">
	<div class="fl_left">Cannot be undone - Are you sure you want to delete?</div>
    <div class="fl_right"><?php echo CHtml::link('Delete', array('/'.Yii::app()->controller->module->name.'/branches/delete/bid/'.$data->id.'/id/'.$_GET['id']),array('class'=>'btn btn-danger'));?> <?php echo CHtml::link('Cancel','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->id.'").hide();','class'=>'btn'));?></div>
    <div class="clear"></div>
</div>