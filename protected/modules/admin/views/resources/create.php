<div class="col-md-8">
    <div class="line"></div>
    <h1>Add/Edit Resources - <span class="blue">Add new or edit existing resource here</span></h1>
    <div class="line"></div>
    <div class="clear"></div>
        
    <?php $this->renderPartial('_form',array('model'=>$model,'categoryModel'=>$categoryModel)); ?>
</div><!--#col-md-8-->

<div class="col-md-4">
  <div class="mar-bot-10">
      <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            //'fn'=>'ajaxLink',
            'url' => array('/admin/resources'),
            'label'=>'Cancel',
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
        ));
      ?>
  </div>
</div><!--#col-md-4-->
<div class="clear"></div>