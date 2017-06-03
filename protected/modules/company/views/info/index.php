<div class="body_content_left">
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php $this->renderPartial('application.modules.admin.views.company._form',array('model'=>$model,'tradinghours'=>$tradinghours));?>
</div>
<div class="body_content_right">
<?php $this->renderPartial('application.modules.admin.views.company._savePopUp');?>
</div>
<div class="clear"></div>