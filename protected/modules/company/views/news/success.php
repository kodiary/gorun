<div class="restaurant_menus_wrapper">
<div class="body_content_left">
<h2>News - <span>Post your latest news - <span class="bold">Subject to approval</span></span></h2>
<div class="line"></div>
    <div class="well" style="background: #2160AC; padding:10px; border-radius:0px; border: 1px solid #98C132;">
        <div class="fl_left">
            <img src="<?php echo $this->createUrl('/images/success.png')?>" alt="success"/>
        </div>
        <div class="fl_right" style="width: 482px; color:#FFF;">
            <span><strong style="font-size: 17px; margin-bottom: 20px; display: block;">Success!</strong></span>
            <div>Your news item is pending approval. You will be notified as it goes live.</div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="body_content_right">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'url' => array('index'),
        'label'=>'Back to List',
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'small' or 'large'
    ));
    ?>
</div>
<div class="clear"></div>
</div>