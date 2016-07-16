<?php $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<div class="company-bottom">
<div class="col-md-8">
    <div class="restaurant_menus_wrapper">
    
        <h2>Company Videos - <span>Showcase videos of your company - Use YouTube Videos</span></h2>
        <div class="line"></div>
        <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
        <?php
        if(!$videos)
        {
          ?>
          <div class="green-border">
            <div class="fl_left"><img src="<?php echo $this->createUrl('/images/alert.png');?>"/></div>
            <div class="fl_right">
            <div class="blue"><strong>Include Videos with your Listing</strong></div>
            <div>Add a dynamic video to really stand out from the crowd. Simply upload your video to YOUTUBE and then cut and paste the video URL(web address) in the form. Your video will appear on youir listing. Add one now using the form on the right.</div>
            </div>
            <div class="clear"></div>
          </div>
          <?php 
        }
        else
        { 
            $this->renderPartial('_view',array('videos'=>$videos));
        }
        ?>
     
    </div>
</div>
<div class="col-md-4">
   <div class="line" style="margin-top: -3px;"></div>
    <?php $this->renderPartial('_form',array('model'=>$model));?>
    
</div>
<div class="clear"></div>
</div>