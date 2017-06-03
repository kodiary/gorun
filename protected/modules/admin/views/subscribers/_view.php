<div class="subscribers_listing">
<div id="<?php echo $data->id?>" class="border_line">
        	<div class="text_desc_l">
            <span><?php  echo $data->first_name.' '.$data->last_name; ?> </span>
            <span class="blue f15"><?php echo $data->email." (".CommonClass::formatDatetime($data->date_added).")"; ?></span>
            </div>
            
             <div class="text_desc_r">
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$data->id,
                'onClick'=>'$("#show_'.$data->id.'").show(400);'),
             )); ?>
        
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url'=>array('update', 'id'=>$data->id),
            )); ?>
            
            </div>
			<div class="clear"></div>
</div>

  <div style="display: none;" id="show_<?php echo $data->id?>" class="alert">
    <div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="floatRight">
      <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'danger',
                //'size'=>'', // '', 'large', 'small' or 'mini'
                'url'=>array('delete', 'id'=>$data->id),
                'label'=>'Delete',
        ));?>
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
</div>