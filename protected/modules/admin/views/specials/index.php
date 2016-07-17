<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company)); ?>
<div class="col-md-8 restaurant_menus_wrapper">
<?php $this->renderPartial('application.modules.admin.views.specials._indexlist',array(
    'dataProvider'=>$dataProvider
)); ?>
</div>

<div class="col-md-4">
    <?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>