<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company)); ?>
<div class="left_body restaurant_menus_wrapper">
<?php $this->renderPartial('application.modules.admin.views.specials._indexlist',array(
    'dataProvider'=>$dataProvider
)); ?>
</div>

<div class="right_body">
    <?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>