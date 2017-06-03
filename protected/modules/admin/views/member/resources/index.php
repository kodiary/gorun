<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">
<h2>Resources - <span class="blue">EXSA Member resource documents and information</span></h2>
<div class="line"></div>

    <?php echo $this->renderPartial('application.modules.admin.views.member.resources._resourcelist', array(
                'companyId'=>$companyId,
    )); ?>
</div>
</div>
<div class="col-md-4">
    
</div>
<div class="clear"></div>
</div>