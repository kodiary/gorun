<?php
$this->breadcrumbs=array(
	'events',
);
?>
<script src="<?php echo $this->createUrl('/js/timeline-loader.js'); ?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/timeline.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/blocksit.js"></script>

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
?>

<?php if($eventsModel){ ?>
    <div class="urlLocation" id="<?php echo $this->createUrl('/events/');?>"></div>
    <div class="maincontainer">
    	<div class = "timelinecontainer">
    		<div class = "timeline"></div>
            <div id = "timelineblock">
                <?php $this->renderPartial('_timelinelisting',array('eventsModel'=>$eventsModel)); ?>
            </div>
            <div class="loadMorePosts" style="display:none;" ><img src="<?php echo $this->createUrl('/images/loader.gif'); ?>" alt="loading more..."/></div>
            <?php
            $counter = 0; 
            foreach($eventsModel as $val){
                $counter++;
            }
            ?>
            <?php if($counter>=$itemsCount){ ?>
            <div id="loading-more" class="btn btn-primary">Load More Events</div>
            <?php } ?>
        </div>
    <div class="clear"></div>
    </div>
<?php } ?>

<div class="clear"></div>

<?php $this->renderPartial('/site/_bottomBanner');?>
</aside>

<aside class="body_content_right">
<?php $this->renderPartial('_eventSearchForm',array('total_results'=>$dataProvider->totalItemCount,
            'event_type'=>$event_type,
            'event_category'=>$event_category,
            'event_profile'=>$event_profile,));
?>
<?php $this->renderPartial('/site/_squareBanner');?>
</aside>
<div class="clear"></div>