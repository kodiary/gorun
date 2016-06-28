<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>Resources - <span class="blue">EXSA Member resource documents and information</span></h2>
<div class="line"></div>

    <?php echo $this->renderPartial('application.modules.admin.views.member.resources._resourcelist', array(
                'companyId'=>$companyId,
    )); ?>
</div>
</div>
<div class="right_body">
    
</div>
<div class="clear"></div>
</div>