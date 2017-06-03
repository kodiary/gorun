<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company));?>

<div class="restaurant_menus_wrapper">
<div class="div600">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<?php $this->renderPartial('_sidebar');?>
<div class="clear"></div>
</div>

