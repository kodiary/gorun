<div class="subscriber_lists_listing">
<div id="<?php echo $data->id?>" class="border_line">
        	<div class="text_desc_l">
            <span><?php echo $data->title; ?> </span><br /> 
            <span class="blue f15"><?php 
            $states = Subscribers::getAllstates($data->id);
            $active = 0;
            $inactive = 0;
            foreach($states as $s)
            {
                //echo $s->subscribe_newsletters."<br/>";
                //continue;
                if($s->subscribe_newsletters=='1')
                    $active++;
                else
                    $inactive++;   
              
            }
            //echo "aa:".$active."ii:".$inactive;
            $company_ids = SubscribersDetail::model()->findAllByAttributes(array('list_id'=>$data->id,'subscriber_id'=>'0'));
            
            foreach($company_ids as $c_id)
            {
                //echo ++$i;
                if(Company::model()->findByPk($c_id->company_id)->status == '1')
                {
                    //echo "nnn"."<br/>";
                    $active++;
                }   
                else
                {
                    //echo "sss"."<br/>";
                    $inactive++; 
                }   
            }
            echo $active." Active / ".$inactive." Inactive";
            unset($active,$inactive);
             ?></span>
            </div>
            
             <div class="text_desc_r">
             <?php if($data->permanent!= 0){?>
            <?php 
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Delete',
                    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'large', 'small' or 'mini'
                    'htmlOptions'=>array('id'=>'delete_'.$data->id,
                    'onClick'=>'$("#show_'.$data->id.'").show(400);'),
                 )); ?>
            <?php } ?>
        
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
            'size' =>'normal',
            'url'=>array('delete', 'id'=>$data->id),
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