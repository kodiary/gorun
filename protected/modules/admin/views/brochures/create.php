<?php Yii::app()->clientScript->registerCoreScript('jquery.ui');?>
<div id="msg"></div>
<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company));?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">

<h2>Brochures - <span class="blue">Create or Edit Brochures here.</span></h2>
<div class="line"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>
<div class="right_body">
<?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>

