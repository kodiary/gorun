<?php 
if($data->visible==1) 
    $calss="";
else
    $class='in_active';
    ?>
<div class="border_line <?php echo $class; ?>" id="<?php echo $data->id?>">
	<div class="text_desc_l ">
    <p class="f17">
    <?php echo CHtml::encode($data->title); ?>
    <span class="f15 blue">
    <?php if($data->start_date!= '0000-00-00') echo date('d F Y', strtotime($data->start_date)); ?>
    <?php if($data->end_date!=null && $data->end_date != '0000-00-00' && $data->end_date == '1970-01-01'){?><?php echo " - ".date('d F Y',strtotime($data->start_date));?><?php } 
    else{ echo " - ".date('d F Y',strtotime($data->end_date));}?>
    </span>
    </p>
    </div>
    <div class="text_desc_r">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Delete',
        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'large', 'small' or 'mini'
        'htmlOptions'=>array('id'=>'delete_'.$data->id,
        'onClick'=>'$("#show_'.$data->id.'").show(400);'),
    )); ?>
    <?php echo CHtml::link('Edit',array('/company/events/update/id/'.$data->id),array('class'=>'btn btn-info'))?>
    </div>
    <div class="clear"></div>
</div>

<div style="display: none;" id="show_<?php echo $data->id?>" class="alert">
    <div class="floatLeft margintop5">
         <?php
         //check for newsletter before deleting news article 
         $check = NewsletterItems::model()->findAll(array('condition'=>"item_type = 2 AND item_id = '$data->id'"));
         if($check)
         {
            ?>
            WARNING! The item has been assigned to newsletter. Remove the item from newsletter first to delete the item.<br/>
            <?php
         }else{ ?>
            Warning: This cannot be undone. Are you sure?
         <?php } ?>
    </div>
    <div class="floatRight">
      <?php if(!$check){ ?>
      <?php 
          $this->widget('bootstrap.widgets.BootButton', array(
                    'type'=>'danger',
                    //'size'=>'', // '', 'large', 'small' or 'mini'
                    'url'=>array('delete', 'id'=>$data->id),
                    'label'=>'Delete',
          ));?>
      <?php } ?>
      <?php
            $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'cancel',
    			//'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'', // '', 'large', 'small' or 'mini',
    			'label'=>'Cancel',
                'htmlOptions'=>array('id'=>'delete_'.$data->id,            
                'onClick'=>'$("#show_'.$data->id.'").hide(400);'),            
    	));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>