<aside class="body_content_left floatLeft">
<div class="restaurant_menus_wrapper">
  <h2>Exhibition &amp; Event - <span class="blue">Create or Edit Events here.</span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php echo $this->renderPartial('application.modules.admin.views.events._form', array('model'=>$model,'venue'=>$venue,'events_link'=>$events_link)); ?>
<div class="clear"></div>
</div>
</aside>
<aside class="body_content_right floatRight">
  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index'),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
    <div class="margintopbot10">
  <?php //$this->renderPartial('_search');?>
  </div>

</aside>
<div class="clear"></div>