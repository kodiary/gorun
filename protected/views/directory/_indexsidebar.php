    <?php $this->renderPartial('servicelist'); ?>
    
    <div class="add-us">
        Want to advertise your products or services?
        <div class="join-exsa"><a href="<?php echo $this->createUrl('/signup');?>" class="">Join EXSA Today</a></div>
    </div>
    
    <?php $this->renderPartial('/site/_eventCalender');?>
    
    <div class="subNewsletter">
        <h2>FRESH INDUSTRY NEWS!</h2>
        <div class="line"></div>
        
        <div class="sub-content">Would you like the latest industry news served fresh to your inbox? Enter your details below.</div>
        <div class="line"></div>
        <div id="subscriptionLink"><a href="<?php echo $this->createUrl('/subscribers')?>">SUBSCRIBE NOW <i class="icon-circle-arrow-right"></i></a></div>
    </div>

    <div><?php $this->renderPartial('/site/_squareBanner');?></div>