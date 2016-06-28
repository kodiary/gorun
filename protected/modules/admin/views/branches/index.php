<?php $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<?php if(isset($_GET['id']))$id=$_GET['id'];?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="left_body">
    <div class="restaurant_menus_wrapper">
    <h2>Branches - <span>Add or edit your branches</span></h2>
        <?php $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>'_view',
        'summaryText'=>'',
    )); ?>
    </div>
</div>
<div class="right_body">
<a href="<?php echo $this->createUrl('/admin/branches/create/id/'.$id);?>" class="btn">+ Add Branch</a>
</div>
<div class="clear"></div>
