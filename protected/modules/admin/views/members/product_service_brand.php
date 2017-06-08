<?php echo $this->renderPartial('_companyHeader', array('model'=>$model)); ?>

<div class="col-md-8">
    <?php echo $this->renderPartial('_servicelist', array(
                'model'=>$model,
                'services'=>$services,
                'companyId'=>$companyId,
    )); ?>
</div>

<div class="col-md-4">
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>
</div>
<div class="clear"></div>