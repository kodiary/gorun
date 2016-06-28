<div class="left_body">
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
    <h2>Background Banners</h2>
    <div class="marginTop10 line"></div>
    <div class="list-view">
    <div class="items">
    <?php
    if($model)
    {
       foreach($model as $data)
       {
        if($data->visibility==0)$class="in_active";
        else $class="";
        if(Yii::app()->file->set('images/frontend/main/'.$data->image)->exists && $data->image)
            $img=Yii::app()->baseUrl.'/images/frontend/main/'.$data->image;
        else $img=Yii::app()->baseUrl.'/images/blank_images.gif';
       ?>
        <div class="border_line <?php echo $class;?>">
        	<div class="fl_left">
            <span class="thumbnail" style="width:90px;"><img src="<?php echo $img;?>"/></span>
            </div>
            
            <div class="fl_left bg-banner">
                <span class="titles fl_left" style="display: block; width:60%"><?php echo $data->link;?></span>  <span class="blues"><?php echo number_format($data->clicks);?> Clicks</span>
                <div class="fl_right">
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
                    'url' => $this->createUrl('/admin/banner/editBackground/id/'.$data->id),
                )); ?>
                </div>
                <div class="clear"></div>
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
                    'url' => $this->createUrl('/admin/banner/delBackground/id/'.$data->id),
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
       <?php
       }
    }
    else echo "No Banners Added."
    ?>
    </div>
    </div>
    <div class="color_indicators">
        <div class="color"></div>
        <div class="ind_text">Indicates Inactive background banners</div>
    </div>
</div>
<div class="right_body">
<a class="btn" href="<?php echo $this->createUrl('/admin/banner/addBackground')?>">+ Add Background Banner</a>
</div>
<div class="clear"></div>