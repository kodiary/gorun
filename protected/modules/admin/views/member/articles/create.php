<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$companyModel)); ?>
<div class="company-bottom">
<div class="left_body">
<div class="restaurant_menus_wrapper">
<h2>News - <span>Post your latest news - <span class="bold">Subject to approval</span></span></h2>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="line"></div>
<?php
    $this->renderPartial('_form', array(
        'model'=>$model,
        'model_image'=>$model_image,
        'model_video'=>$model_video,
        'model_audio'=>$model_audio,
        'model_document'=>$model_document,
    ));
?>  
</div>
</div>

<div class="right_body">
	 <?php $this->renderPartial('_sidebar')?>
</div>
<div class="clear"></div>
</div>
