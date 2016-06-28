<div class="body_content_left restaurant_menus_wrapper">
<?php $this->renderPartial('application.modules.admin.views.featured._indexlist',array(
        'dataProvider'=>$dataProvider)
); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('application.modules.admin.views.featured._sidebar');?>
</div>
<div class="clear"></div>