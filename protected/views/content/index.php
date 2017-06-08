<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/site/_filter', false, true); ?>
</div>
<div class="col-md-9 right-content">

    <div class="breadcrumb">
        <a class="home_bread" href="<?php echo Yii::app()->request->baseUrl; ?>"><span class="fa fa-home"></span></a><img class="right-point" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint.png" />
        <?php echo $model->title;?>
        <img class="right-point_w" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint_w.png" />
    </div>

<?php
/*
$this->breadcrumbs=array('',$model->title,

);
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>$this->breadcrumbs,
    'homeLink'=>'<a class="home_bread" href="'.Yii::app()->request->baseUrl.'"><span class="fa fa-home"></span></a>',
    'htmlOptions'=>['class'=>'breadcrumb']
));
*/
?>
    <div class="col-md-12 block_border padding-left-10">
        <h1 class="blue">GO RUN</h1>
        <h1><?php echo $model->title; ?></h1>
        <div class="line"></div>
        <div class="hd_des"><?php echo $model->desc; ?></div>
        <?php $this->renderPartial('/site/_bottomBanner');?>
        <div class="clear"></div>
    </div>
    <div class="col-md-12 padding-left-10  block_border">
            
        <div class="sharing">
            <a href="#" class="btn-facebook"><span class="fa fa-facebook"></span> Share on facebook</a>
            <a href="#" class="btn-twitter"><span class="fa fa-twitter"></span> Share on twitter</a>
            <a href="#" class="btn-plus"></a>
            <span class="total_share">667 Shares</span>
            <div class="clearfix"></div>
        </div>
               
           
        </div>
</div>

<div class="clear"></div>