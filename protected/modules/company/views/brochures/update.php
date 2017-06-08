<div class="body_content_left restaurant_menus_wrapper">
<h2>Brochures - <span class="blue">Create or Edit Brochures here.</span></h2>
<div class="line"></div>
<?php $this->renderPartial('application.modules.admin.views.brochures._form',array(
        'model'=>$model)
); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('application.modules.admin.views.brochures._sidebar');?>
</div>
<div class="clear"></div>