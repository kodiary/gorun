<?php
if($parent){
    $this->breadcrumbs=array(
        $parent->title=>array('/'.$parent->page_seo),
    	$model->title,
    );    
}else{
    $this->breadcrumbs=array(
	   $model->title,
    );
}
?>
<div class="body_content_left fl_left">
    <div class="contPages">
        <h1><?php echo $model->title; ?></h1>
        <div class="line"></div>
        <div class="hd_des"><?php echo $model->desc; ?></div>
        <?php $this->renderPartial('/site/_bottomBanner');?>
        <div class="clear"></div>
    </div>
</div>
<div class="body_content_right fl_right">
    <?php $this->renderPartial('/site/_squareBanner');?>
</div>
<div class="clear"></div>