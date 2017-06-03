<div class="col-md-8 subs-new">
<div class="line"></div>
<h1>Subscribers - <span class="blue">Add, Edit and Delete newletter Subscribers here.</span> </h1>
<div class="line"></div>
<?php echo $this->renderPartial('_form',array('model'=>$model,'subscribersdetail'=>$subscribersdetail)); ?>

</div>
<div class="col-md-4">
    <div class="mar-bot-10">
    <?php
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Back to List',
                'url'=>array('index')           
        )); 
    ?>
    </div>
        <?php $this->renderPartial('_search');?>
    
</div>
<div class="clear"></div>