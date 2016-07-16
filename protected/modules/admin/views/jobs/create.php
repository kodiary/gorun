<div class="restaurant_menus_wrapper">
    <div class="col-md-8">
    <div class="line"></div>  
    <h2>Add/Edit Job - <span>Post an advert for staff - <strong>MAX 3 active adverts</strong></span></h2>
    <div class="line"></div>
    
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    
    </div>
    
    <div class="col-md-4">
        <?php $this->renderPartial('_sidebar'); ?>
    </div>
    <div class="clear"></div>
</div>