<aside class="col-md-8 floatLeft">
<div class='line'></div>
  <h1>Add/Edit Event - <span class="blue">Create or Edit Events here.</span></h1>
<div class='line'></div>
<div class="seperator"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'venue'=>$venue,'org'=>$org,'events_link'=>$events_link)); ?>
<div class="clear"></div>
</aside>
<aside class="col-md-4 floatRight">
<div class="mar-bot-10">  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index'),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
    </div>    
    <div class="margintopbot10">
  <?php $this->renderPartial('_search');?>
  </div>
  <?php 
  if(isset($_GET['id'])) {
    echo '<div>';
    $this->renderPartial('_social'); 
    echo '</div>';
  }
  ?>

</aside>
<div class="clear"></div>