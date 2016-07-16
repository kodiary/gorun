<div class="col-md-8">
<div class="line"></div>
<h1>Subscriber Lists - <span class="blue"><?php if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>Manage subscriber lists here<?php } ?></span></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['items_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.subscriber_lists_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more subscriber lists.',
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
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    if(isset($_GET['keyword'])){
        $url_value = $this->createUrl('/admin/subscriberslist/search/'.$_GET['keyword'].'/showall');
    }else{
        $url_value = $this->createUrl('/admin/subscriberslist/index/showall');
    }
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }
?>
</div>
<div class="clear"></div>
</div>

<div class="col-md-4">
<div class="mar-bot-10">
    <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'+ Add List',
            'url'=>array('create')           
        )); 
    ?>
   </div>  
  <?php $this->renderPartial('_search');?>
 
</div>
<div class="clear"></div>