<div class="body_content_left newss">
<div class="restaurant_menus_wrapper">
<h2>News - <span>Post your latest news - <span class="bold">Subject to approval</span></span></h2>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?> 
<div class="line"></div>

<ul>  
    <?php if(!$dataProvider->getData()){?>
        <div class="green-border">
            <div class="fl_left">
                <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
            </div>
            <div class="fl_right">
                <div class="blue"><strong>Share your News with the world</strong></div>
                <div>Now you can publish all your news to the world right from your listing. Once you post your news, we will review it and post it live for all to you. Add news now using the button on the right.</div>
            </div>
            <div class="clear"></div>
        </div>
    <?php }else{ ?>          
    <?php
        $this->widget('bootstrap.widgets.BootListView',array(
        	'dataProvider'=>$dataProvider,
        	'itemView'=>'_view',
            'summaryText'=>'',
        ));    
    ?>
    <?php } ?>
</ul>
</div>
</div>

<div class="body_content_right" style="margin-top: 45px;">
	 <?php $this->renderPartial('_sidebar')?>
</div>
<div class="clear"></div>
