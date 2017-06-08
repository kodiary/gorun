<div class="body_content_left restaurant_menus_wrapper">
<?php $this->renderPartial('application.modules.admin.views.specials._form',array(
        'model'=>$model,
        'specials'=>$specials
)); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('application.modules.admin.views.specials._sidebar');?>
</div>
<div class="clear"></div>
