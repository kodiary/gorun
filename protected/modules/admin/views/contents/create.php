<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Create',
);
?>

<aside class="left_body addArticles contentPage">
<div class="line"></div>
<h1>ADD/EDIT CONTENTS PAGE</h1>
<div class="line"></div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</aside>
<aside class="right_body floatRight">
  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('index'),
                    'label'=>'Cancel',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</aside>
<div class="clear"></div>