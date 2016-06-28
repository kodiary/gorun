<aside class="left_body floatLeft articles">
 <div class="line"></div>
<h1> Subscribers - <span class="blue"><?php if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>Add, Edit or Delete newsletter subscribers here<?php } ?></span></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['items_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.subscribers_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more subscribers.',
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
        $url_value = $this->createUrl('/admin/subscribers/index/'.$_GET['keyword'].'/showall');
    }else{
        $url_value = $this->createUrl('/admin/subscribers/showall');
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
</aside>
<aside class="right_body floatRight">
 <div style="margin-bottom:10px;"> 
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('subscribers/create'),
                    'label'=>'+Add Subscriber',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
</div>
<div class="margintopbot10">
  <?php $this->renderPartial('_search');?>
  </div>

</aside>
<div class="clear"></div>