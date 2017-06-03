    <div id="<?php echo $data->id?>" class="greybg mar-bot-6">
        	<div class="text_desc_l">
            <?php echo $data->title;?> - <span class="blue f15"><?php echo Banner::countClicks($data->id);?>/<?php echo Banner::countViews($data->id);?></span>
            </div>
            
            <div class="text_desc_r">
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$data->id,
                'onClick'=>'$("#show_'.$data->id.'").show();'),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('update', 'id'=>$data->id),
                //'htmlOptions'=>array('id'=>'update_'.$data->id),
            )); ?>
            </div>
<div class="clear"></div>
         </div>
        <div style="display: none;" id="show_<?php echo $data->id?>" class="alert">
                     <div class="floatLeft margintop5">
                   		Warning: This cannot be undone. Are you sure?
                    </div>
                    <div class="floatRight">
                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => array('delete', 'id'=>$data->id),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
                ));?>
                    
                    <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $data->id?>">Cancel</a> 
                    <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    </div>
	
