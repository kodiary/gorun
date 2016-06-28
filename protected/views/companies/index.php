<?php
$this->breadcrumbs=array(
	'company'
);
?>
<div class="body_content_left">
<div class="pos_rel">
<h1>Company in South Africa</h1>
<p class="hd_des">Order -
<?php echo CHtml::link('Alphabetical', array('restaurants/index/order/alphabetical'), array('class'=>($_GET['order']=='alphabetical')?'active':''));?> - 
<?php echo CHtml::link('Date Added', array('restaurants/index/order/date-added'),array('class'=>$_GET['order']=='date-added'?'active':''));?> - 
<?php echo CHtml::link('Last Updated', array('restaurants/index/order/last-updated'),array('class'=>($_GET['order']=='last-updated' || !isset($_GET['order']))?'active':''));?> -
<?php echo CHtml::link('With Specials', array('restaurants/index/order/with-specials'),array('class'=>$_GET['order']=='with-specials'?'active':''));?> - 
<?php echo CHtml::link('With Jobs', array('restaurants/index/order/with-jobs'),array('class'=>$_GET['order']=='with-jobs'?'active':''));?>
</p>
<?php 
/* auto scrolling on showall*/
if($pages->itemCount>Yii::app()->params['items_pers_page'])
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.direcotry_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more restaurants.',
    'pages' => $pages,
));?>
<?php if(!isset($_GET['showall']))$dataProvider->getPagination()->pageVar = 'page';?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>false,
	'itemView'=>'/site/_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'application.widgets.MyPager',

        //'firstPageLabel'=>'<<',
        //'prevPageLabel'=>'<',
        //'nextPageLabel'=>'>',
        //'lastPageLabel'=>'>>',
        'maxButtonCount'=>10,
    ),
)); ?>

<div class="btn_pagination_right">
<?php if(!$pages && $dataProvider->totalItemCount>Yii::app()->params['items_pers_page']){
        $showUrl = $this->createUrl('/restaurants/all');
    echo CHtml::link('Show All', $showUrl, array('class'=>'btn btn-info'));
}?>
</div>
</div>
<!-- bottom banner-->
<?php //$this->renderPartial('/site/_bottomBanner');?>
</div>

<div class="body_content_right">
<!-- Right side bar -->
<?php //$this->renderPartial('/site/_popularSearch'); ?>
<?php //$this->renderPartial('/site/_searchRestaurant');?>
<?php //$this->renderPartial('/site/_browseByProvince');?>

<div class="maps">
	<div class="gray_blocks round">
    	<div class="left_a">
        	<h2 class="maps">Maps</h2>
        </div>
        
        <div class="right_a">
        	<a href="<?php echo $this->createUrl('/map');?>">View Larger</a>
        </div>
        <div class="clear"></div>
    </div>
    <?php //$this->renderPartial('/site/_map');?>
</div>
<?php //$this->renderPartial('/site/_hotelsLink', array('linkId'=>1));?>
<?php //$this->renderPartial('/site/_squareBanner');?>

</div><!--#body_content_right-->
<div class="clear"></div>
