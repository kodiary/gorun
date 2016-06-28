<?php
$this->breadcrumbs=array(
	'login and password reminder',
);
?>
<div class="body_content_left">
<?php $this->renderPartial('_passwordReminder',array('model'=>$model2)); ?>
</div>

<div class="body_content_right">
    <?php $this->renderPartial('_login',array('model'=>$model));?>
</div>
<div class="clear"></div>
