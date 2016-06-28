<?php echo $this->renderPartial('_companyHeader', array('model'=>$model)); ?>

<div class="left_body">
    <?php echo $this->renderPartial('_servicelist', array(
                'model'=>$model,
                'services'=>$services,
                'companyId'=>$companyId,
    )); ?>
</div>

<div class="right_body">
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>
</div>
<div class="clear"></div>