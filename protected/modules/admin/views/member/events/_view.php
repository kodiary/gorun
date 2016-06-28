<?php 
if($data->visible==1) 
    $calss="";
else
    $class='in_active';


$company_id=$_GET['id'];
    ?>
<div class="border_line <?php echo $class; ?>" id="<?php echo $data->id?>">
	<div class="text_desc_l ">
    <p class="f17">
    <?php echo CHtml::encode($data->title); ?>
    <span class="blue f15">
    <?php if($data->start_date!= '0000-00-00') echo date('d F Y', strtotime($data->start_date)); ?>
    <?php if($data->end_date!=null && $data->end_date != '0000-00-00' && $data->end_date == '1970-01-01'){?><?php echo " - ".date('d F Y',strtotime($data->start_date));?><?php } 
    else{ echo " - ".date('d F Y',strtotime($data->end_date));}?>
    </span>
    </p>
    </div>
    <div class="text_desc_r">
    <?php echo CHtml::link('Delete',array('javascript:void(0)'),array('class'=>'btn btn-danger delete','title'=>$data->id))?>
    <?php echo CHtml::link('Edit',array('/admin/member/events/update/id/'.$company_id.'/eventId/'.$data->id),array('class'=>'btn btn-info'))?>
    </div>
    <div class="clear"></div>
</div>