<?php $this->renderPartial('/company/_companyHeader',array('model'=>$cmodel));?>
<?php if(isset($_GET['id']))$id=$_GET['id'];?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="col-md-8">
    <div class="restaurant_menus_wrapper">
    <h2>Branches - <span>Add or edit your branches</span></h2>
      <?php $this->renderPartial('_form',array('model'=>$model));?>
    </div>
</div>
<div class="col-md-4">
<a href="<?php echo $this->createUrl('/admin/branches/create/id/'.$id);?>" class="btn">+ Add Branch</a>
</div>
<div class="clear"></div>
