<?php $companyId = $_GET['id']; ?>
<div class="jobs_listing">
    <div id="<?php echo $data->id?>" class="border_line <?php if($data->visible==0) echo 'in_active'?>">
    	<div class="text_desc_l">
        <span><?php echo $data->title?> - </span>
        <span class="blue f15"><?php if($data->date_updated!='0000-00-00') echo "Updated " . CommonClass::formatDate($data->date_updated, 'd F Y');?>
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
                'url'=>array('update', 'id'=>$companyId, 'jobsid'=>$data->id),
            )); ?>
                    
        </div>
		<div class="clear"></div>
    </div>

  <div style="display: none;" id="show_<?php echo $data->id?>" class="alert">
    <div class="fl_left margintop5"> Warning: This cannot be undone. Are you sure? </div>
    <div class="fl_right">
      <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
			'type'=>'danger',
            'size' =>'normal',
            'url'=>array('delete', 'id'=>$companyId, 'jobsid'=>$data->id),
		'label'=>'Delete',
        ));?>
      <?php
            $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'cancel',
			'type'=>'normal',
            'size' =>'normal',
			'label'=>'Cancel',
            'htmlOptions'=>array('id'=>'delete_'.$data->id,            
            'onClick'=>'$("#show_'.$data->id.'").hide(400);'),            
		));?>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>