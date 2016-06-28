<div id="msg"></div>
<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="left_body">
    <?php echo $this->renderPartial('application.modules.admin.views.company._servicelist', array(
                'model'=>$model,
                'products'=>$products,
                'services'=>$services,
                'brands'=>$brands,
                'associations'=>$associations,
                'companyId'=>$companyId,
    )); ?>
</div>

<div class="right_body">
    <?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>
    

</div>
<div class="clear"></div>
    
</div>

