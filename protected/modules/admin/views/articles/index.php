<?php
$this->breadcrumbs=array(
	'Articles',
);?>

<aside class="left_body left_body articles">
<div class="line"></div>
    <?php if(Yii::app()->controller->action->id == 'approval'){ ?>
        <h1>Pending Articles - <span class="blue">List of Articles Pending</span></h1>
    <?php }elseif(Yii::app()->controller->action->id == 'inactive'){ ?>
        <h1>Inactive/Draft Mode - <span class="blue">List of Articles Inactive/Draft Mode</span></h1>
    <?php }else{ ?>
        <h1>Live Articles - <span class="blue">List of Live Articles</span></h1>
    <?php } ?>
  
  <div class="line"></div>
  <div class="clear"></div>
  

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['items_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.article_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more article.',
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
        $url_value = $this->createUrl('/admin/articles/search/'.$_GET['keyword'].'/showall');
    }else{
        $url_value = $this->createUrl('/admin/articles/index/showall');
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
<aside class="right_body">
  <div class="mar-bot-10">
  <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        //'fn'=>'ajaxLink',
        'url' => array('create'),
        'label'=>'+Add Article',
        'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'small' or 'large'
    ));
  ?>
  </div>
 
  <div class="">
  <?php $this->renderPartial('_search');?>
  </div>
  <div class="">
    <?php $this->renderPartial('_bycompany');?>
  </div>
</aside>
<div class="clear"></div>
