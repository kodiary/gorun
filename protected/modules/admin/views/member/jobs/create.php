<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$companyModel)); ?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">      
    <h2>Jobs - <span>Add or Edit any positions you may have available at your company</span></h2>
    <div class="line"></div>
    
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    
    </div>
</div>    
    <div class="col-md-4">
        <?php $this->renderPartial('_sidebar'); ?>
    </div>
    <div class="clear"></div>
</div>