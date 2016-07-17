<?php
$this->breadcrumbs=array(
	'events',
);
?>

<aside class="body_content_left">
<div class="line"></div>
	<div class="left"><h1>Exhibition &amp; Events</h1></div>    
    <div class="right ico-new">
        <a rel="tooltip" data-title="timeline view" href="<?php echo $this->createUrl('events/timeline');?>"><img class="list" src="<?php echo Yii::app()->request->baseUrl; ?>/images/grid.png"/></a>
        <a rel="tooltip" data-title="list view" href="<?php echo $this->createUrl('/events');?>"><img class="grid" src="<?php echo Yii::app()->request->baseUrl; ?>/images/list.png"/></a>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
    

<?php 

$itemsCount = Yii::app()->params['articles_pers_page'];

/* auto scrolling on showall*/
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.directory_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more event.',
    'pages' => $pages,
));?>

<div class="list-view">
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
</div>

<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount && $this->action->id!='search'){
    $url_value = $this->createUrl('events/showall');$showall_id='showall';

    
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
                'htmlOptions'=>array('id'=>$showall_id)
    ));
}
?>
</div>
<div class="clear"></div>

<?php $this->renderPartial('/site/_bottomBanner');?>
</aside>

<aside class="body_content_right">
<?php $this->renderPartial('_eventSearchForm',array(
            'total_results'=>$dataProvider->totalItemCount,
            'event_type'=>$event_type,
            'event_category'=>$event_category,
            'event_profile'=>$event_profile,
));?>
<?php $this->renderPartial('/site/_squareBanner');?>
</aside>
<div class="clear"></div>