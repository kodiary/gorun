<div class="body_content_left">
    <?php echo $this->renderPartial('application.modules.admin.views.company._servicelist', array(
                'model'=>$model,
                'services'=>$services,
                'companyId'=>$companyId,
    )); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>
</div>
<div class="clear"></div>