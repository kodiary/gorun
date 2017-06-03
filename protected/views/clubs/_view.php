     <li class="<?php echo ($data->is_approved==0)? 'in_active': '';?>">
     <div id="<?php echo $data->id?>" class="border_line">
    	<div class="text_desc_l" style="margin-top: 5px;">
        <span><?php echo $data->title?>  - </span> <span class="blue f15">Posted <?php echo CommonClass::formatDate($data->date_added);?></span>
        </div>
        
        <div class="text_desc_r">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'large', 'small' or 'mini'
            'htmlOptions'=>array('id'=>'delete_'.$data->id,
            'onClick'=>'$("#show_'.$data->id.'").show();'),
        )); ?>
        
        <?php
            $updateUrl =  array('news/edit/'.$data->slug);
            $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Edit',
            'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'large', 'small' or 'mini'
            'url' => $updateUrl,
            //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
        )); ?>
        </div>
		<div class="clear"></div>
    </div>
         
    <div style="display: none;" id="show_<?php echo $data->id?>" class="warning_blocks">
        <div class="fl_left">
       		<span class="bold">Warning:</span> This cannot be undone. Are you sure?
        </div>
        <div class="fl_right">
            <?php
            $deleteUrl = array('news/delete/'.$data->slug);
            $this->widget('bootstrap.widgets.BootButton', array(
            //'fn'=>'ajaxLink',
            'url' => $deleteUrl,
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
            ));?>
            
            <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>" onclick="$('#show_<?php echo $data->id?>').hide();">Cancel</a> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    </li>