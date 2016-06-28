<div class="body_content_left">
<?php $this->renderPartial('application.modules.admin.views.company._accountsDetail',array(
        'status'=>$status,'model'=>$model,'accounts'=>$accounts)
); ?>
</div>

<div class="body_content_right" style="margin-top: 11px;">
    <?php $this->renderPartial('_contactForm',array('model'=>$contactModel));?>
</div>
<div class="clear"></div>