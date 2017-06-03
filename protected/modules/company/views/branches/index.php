<div class="body_content_left">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="restaurant_menus_wrapper">
    <h2>Branches - <span>Add or edit your branches</span></h2>
        <?php $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'application.modules.admin.views.branches._view',
        'summaryText'=>'',
    )); ?>
    </div>
</div>
<div class="body_content_right"><a href="<?php echo $this->createUrl('/company/branches/create');?>" class="btn">+ Add Branch</a></div>
<div class="clear"></div>