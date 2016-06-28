<div class="jobs_listing">
    <div id="<?php echo $data->id?>" class="border_line <?php if($data->visible==0) echo 'in_active'?>">
        <?php
            $company = Company::companyInfo($data->company_id);
        ?>
    	<div class="text_desc_l">
        <span><?php echo $data->title?> - <?php echo $company->name?></span>
        <span class="blue"><?php if($data->posted_date!='0000-00-00') echo CommonClass::formatDate($data->posted_date, 'd F Y');?>
        </div>
         <div class="text_desc_r">
         
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'', // '', 'large', 'small' or 'mini'
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