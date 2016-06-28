
    <div id="<?php echo $data->id?>" class="greybg mar-bot-6 resource_list">
    <div class="text_desc_l">
        <span><?php echo $data->title?></span>
        
            <?php if($data->date_added!='0000-00-00'){ ?>
                <div class="blue f15">Added <?php echo CommonClass::formatDate($data->date_added, 'd F Y'); ?></div>
            <?php }?>
        
    </div>
    
    <div class="text_desc_r">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Delete',
        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'large', 'small' or 'mini'
        'htmlOptions'=>array('id'=>'delete_'.$data->id,
        'onClick'=>'$(".warning_blocks").hide();$("#show_'.$data->id.'").show();'),
    )); ?>
    
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Edit',
        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'large', 'small' or 'mini'
        'url' => $this->createUrl('update', array('id'=>$data->id)),
        'htmlOptions'=>array('id'=>'edit_'.$data->id),
    )); ?>
    </div>
    <div class="clear"></div>
    </div>
         
    <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
            <div class="fl_left">
           		<span class="bold">Warning:</span> This cannot be undone. Are you sure?
            </div>
            <div class="fl_right">
           <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => $this->createUrl('delete', array('id'=>$data->id)),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
            ));?>
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>" onclick="$('#show_<?php echo $data->id?>').hide();">Cancel</a> 
            <div class="clear"></div>
            </div>
    <div class="clear"></div>
    </div>
<div class="clear"></div>