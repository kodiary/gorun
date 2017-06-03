<?php
    $this->breadcrumbs=array(
    	'newsletter subscriptions',
    );
?>
<div class="body_content_left fl_left">
<div class="line"></div>
    <h1>Manage Subscription</h1>
    <div class="line"></div>
    <?php $this->renderPartial('_manage',array('model'=>$model,'email'=>$email,'status'=>$status)); ?>
</div>
<div class="body_content_right fl_right">
    <?php
        $subscriber = new Subscribers('subscribe'); 
        $this->renderPartial('/subscribers/_add',array('model'=>$subscriber,'status'=>$status));
    ?>
</div>
<div class="clear"></div>