<div class="col-md-8">
<div class="line"></div>
<h1>Clubs - <span class="blue">Manage Clubs Here</span></h1>
<div class="line"></div>

<?php
if(Yii::app()->controller->action->id!='newlisting')
{
?>
<ul class="admin_top_navs">
<li><a href="<?php echo $this->createUrl('club/index')?>" class="<?php if($filter=='')echo 'active'; ?>">Alphabetical</a></li>
<li><a href="<?php echo $this->createUrl('club/index/filter/newest')?>" class="<?php if($filter=='newest')echo 'active'; ?>">Newest</a></li>
<li><a href="<?php echo $this->createUrl('club/index/filter/oldest')?>" class="<?php if($filter=='oldest')echo 'active'; ?>">Oldest</a></li>
<li><a href="<?php echo $this->createUrl('club/index/filter/updated')?>" class="<?php if($filter=='updated')echo 'active'; ?>">Updated</a></li>
<li><a href="<?php echo $this->createUrl('club/index/filter/inactive')?>" class="<?php if($filter=='inactive')echo 'active'; ?>">Inactive</a></li>
</ul>
<?php
}
else
{
?>
<h2 class="s_header">New Listings</h2>
<?php
}
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
/* auto scrolling on showall*/
$itemsCount = 15;
if($pages!= '')
if($pages->itemCount > $itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.member-listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more member.',
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
<div class="showAllBtn">
<?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('/admin/club/index/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
<div class="color_indicators">
 	<div class="color"></div>
    <div class="ind_text">Indicates inactive items</div>
</div>
</div>


<div class="col-md-4">
<div class="add_parts">
	<a href="<?php echo $this->createUrl('/admin/club/addBlank')?>" class="btn">+Add Club</a>
</div>
<?php $this->renderPartial('_search');?>


</div>
<div class="clear"></div>