<div class="col-md-8 floatLeft">
<div class="line"></div>
<h1>Subscriber Lists - <span class="blue">Manage subscriber lists here</span> </h1>
<div class="line"></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="col-md-4 floatRight">
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