<aside class="col-md-8 floatLeft newsletters">
<div class="line"></div>
<h1>Send Newsletters - <span class="blue">Send your newsletter here</span></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php 
/* auto scrolling on showall*/
if($pages->itemCount>10)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.newsletter_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more newsletter to send.',
    'pages' => $pages,
));?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_sendList',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>10){
        $url_value = $this->createUrl('/admin/newsletters/send/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
</aside>

<aside class="col-md-4 floatRight">
<a href="<?php echo $this->createUrl('/admin/newsletters/create')?>" class="btn">+Add Newsletters</a></h1>
</aside>
<div class="clear"></div>