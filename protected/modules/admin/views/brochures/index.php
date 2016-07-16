<?php echo $this->renderPartial('/company/_companyHeader', array('model'=>$company)); ?>
<div class="company-bottom">
<div class="col-md-8">
<?php $this->renderPartial('application.modules.admin.views.brochures._indexlist',array(
    'dataProvider'=>$dataProvider
)); ?>
</div>

<div class="col-md-4">
    <?php $this->renderPartial('_sidebar');?>
</div>
<div class="clear"></div>
</div>