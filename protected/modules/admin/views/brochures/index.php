<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company)); ?>
<div class="company-bottom">
<div class="left_body">
<?php $this->renderPartial('application.modules.admin.views.brochures._indexlist',array(
    'dataProvider'=>$dataProvider
)); ?>
</div>

<div class="right_body">
    <?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>