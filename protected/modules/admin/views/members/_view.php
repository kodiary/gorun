<?php 
if($data->status==1) $class="";
else $class='in_active';
?>
<div class="member-listing border_line <?php echo $class; ?>">
	<div class="text_desc_l ">
    
    <?php echo CHtml::encode($data->fname." ".$data->lname); ?>
    <span class="f15 blue">
    <?php if($data->date_updated!=null){?><?php echo "- Updated - ".date('d F Y',strtotime($data->date_updated));?><?php }?>
    </span>
    
    </div>
    <div class="text_desc_r">
    <?php echo CHtml::link('Edit',array('/admin/members/update/id/'.$data->id),array('class'=>'btn btn-info'))?>
    <?php echo CHtml::link('Delete','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->id.'").show();','class'=>'btn btn-danger'));?>
    </div>
    <div class="clear"></div>
</div>
<div id="div_del_<?php echo $data->id;?>" style="display: none;" class="warning_blocks">
	<div class="fl_left">Cannot be undone - Are you sure you want to delete?</div>
    <div class="fl_right"><?php echo CHtml::link('Delete', array('/admin/members/delete/id/'.$data->id),array('class'=>'btn btn-danger'));?> <?php echo CHtml::link('Cancel','javascript:void(0);',array('onclick'=>'$("#div_del_'.$data->id.'").hide();','class'=>'btn'));?></div>
    <div class="clear"></div>
</div>