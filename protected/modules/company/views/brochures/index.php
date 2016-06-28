<div class="body_content_left">
<?php $this->renderPartial('application.modules.admin.views.brochures._indexlist',array(
        'dataProvider'=>$dataProvider)
); ?>
</div>

<div class="body_content_right" style="margin-top: 45px;">
    <?php $this->renderPartial('application.modules.admin.views.brochures._sidebar');?>
</div>
<div class="clear"></div>