<?php
$this->breadcrumbs=array(
	'directory',
);?>
<?php $this->renderPartial('_directoryHead');?>
<div class="body_content_left directory">
    <div class="line"></div>
        <h1 class="left"><?php echo ($serviceModel->service_name)?ucwords($serviceModel->service_name):'Members';?></h1>
        <div class="clear"></div>
    <div class="line"></div>
    <?php 
    /* auto scrolling on showall*/
    $itemsCount = Yii::app()->params['items_pers_page'];
    if($pages->itemCount>$itemsCount)
        $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
        'contentSelector' => '.items',
        'itemSelector' => '.direcotry_listing',
        'loadingText' => 'Loading...',
        'donetext' => 'There is no more company.',
        'pages' => $pages,
    ));?>
    <?php $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'summaryText'=>'',
        'pager' => array(
            'class'=>'bootstrap.widgets.BootPager',
            'maxButtonCount'=>5,
        ),  
    )); ?>
    
    <div class="btn_pagination_right">
    <?php if(!$pages && $dataProvider->totalItemCount>$itemsCount){
            $showUrl = $this->createUrl('/directory/service/'.$serviceModel->slug.'/showall');
        echo CHtml::link('Show All', $showUrl, array('class'=>'btn btn-info'));
    }?>
    </div>
    <div><?php $this->renderPartial('/site/_bottomBanner');?></div>
</div>
<div class="body_content_right">
    <?php $this->renderPartial('_indexsidebar'); ?>
</div>
<div class="clear"></div>