<?php
$this->breadcrumbs=array(
	'search results'
);

?>
<div class="body_content_left">
<h1 class="left" style=" margin-bottom: 0;">Search Results</h1>
<p class="hd_des right blue" style="font-size: 13px;margin:10px 0 0;">Results for "<?php echo $_GET['q'];?>"</p>
<div class="clear"></div>
<div class="line"></div>
<div class="gray_blocks" style="border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; margin-bottom:10px;">
<h2>Companies</h2>
</div>
<div class="search_blocks">
<?php //$this->widget('bootstrap.widgets.BootAlert'); 
if($company->totalItemCount==0) echo '0 result found.'?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$company,
	'itemView'=>'/directory/_view',
    'summaryText'=>'',
    'emptyText'=>''
)); ?>
</div>

<div class="search_blocks">
<div class="gray_blocks" style="border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; margin-bottom:10px;">
<h2>News</h2>
</div>
<?php //$this->widget('bootstrap.widgets.BootAlert'); 
if($news->totalItemCount==0) echo '0 result found.'?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$news,
	'itemView'=>'/site/_articles',
    'summaryText'=>'',
    'emptyText'=>''
)); ?>
</div>

<div class="search_blocks">
<div class="gray_blocks" style="border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; margin-bottom:10px;">
<h2>Jobs</h2>
</div>
<?php 
if($jobs->totalItemCount==0) echo '0 result found.'?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$jobs,
	'itemView'=>'/jobs/_view',
    'summaryText'=>'',
    'emptyText'=>''
)); ?>
</div>

<div class="search_blocks">
<div class="gray_blocks" style="border-top:1px solid #dddddd; border-bottom:1px solid #dddddd; margin-bottom:10px;">
<h2>Events</h2>
</div>
<?php 
if($events->totalItemCount==0) echo '0 result found.'?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$events,
	'itemView'=>'/events/_view',
    'summaryText'=>'',
    'emptyText'=>''
)); ?>
</div>
<!-- bottom banner-->
<?php $this->renderPartial("/site/_bottomBanner");?>
</div>
<div class="body_content_right">
<div class="join-exsa"><a href="<?php echo $this->createUrl('/signup');?>" class="">Join EXSA Today</a></div>
<?php $this->renderPartial("/site/_eventCalender");?>
<?php $this->renderPartial("/site/_squareBanner");?>
</div>
<div class="clear"></div>