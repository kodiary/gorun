<div id="msg"></div>
<?php
$this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">
<h2>Exhibition &amp; Event - <span class="blue">Create or Edit Events here.</span></h2>
<div class="line"></div>
<?php echo $this->renderPartial('application.modules.admin.views.events._form', array('model'=>$event_model,'venue'=>$venue,'events_link'=>$events_link)); ?>
</div>
</div>
<div class="col-md-4">
       <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index','id'=>$id),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>
<div class="clear"></div>
</div>