<div class="left_body">
    <div class="line"></div>
    <h1>Add/Edit Resources - <span class="blue">Add new or edit existing resource here</span></h1>
    <div class="line"></div>
    <div class="clear"></div>
        
    <?php $this->renderPartial('_form',array('model'=>$model,'categoryModel'=>$categoryModel,'category'=>$category)); ?>
</div><!--#left_body-->

<div class="right_body">
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
</div><!--#right_body-->
<div class="clear"></div>