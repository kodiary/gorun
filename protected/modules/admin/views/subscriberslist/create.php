<div class="left_body">
<div class="line"></div>
<h1>Subscriber Lists - <span class="blue">Manage subscriber lists here</span></h1>
<div class="line" style="margin-bottom: 13px;"></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="right_body">
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