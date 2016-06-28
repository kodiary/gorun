<?php 
if($data->status==1) 
    $calss="";
else
    $class='in_active';
?>
<div class="well" style="padding: 10px 15px 10px 15px;">
    <div style="float: left;">
        <?php echo CHtml::encode($data->title); ?>
    </div>
    <div style="float: right;">
    <?php echo CHtml::link('Edit',array('/admin/contents/update/id/'.$data->id),array('class'=>'btn btn-info'))?>
    </div>
    <div class="clear"></div>
</div>