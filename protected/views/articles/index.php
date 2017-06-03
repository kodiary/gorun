<?php
if(isset($_GET['tag']) && $_GET['tag']!=''){
    $this->breadcrumbs=array(
	   'news', strtolower($_GET['tag'])
    );
}elseif(isset($_GET['company']) && $_GET['company']!=''){
    $this->breadcrumbs=array(
	   'news', strtolower($_GET['company'])
    );
}else{
    $this->breadcrumbs=array(
    	'news',
    );   
}
if(isset($_GET['company']))
{
    $com =$_GET['company'];
    $a_id = Company::model()->findByAttributes(array('slug'=>$com));
}
?>
<div class="body_content_left latest-article">
<div class="line"></div>
<h1 class="left">
    <?php
        if(isset($_GET['tag']))
            echo "<span'>".ucfirst($_GET['tag']).'</span> Articles';
        elseif(isset($_GET['company']))
            echo "Aritcles by <span>".ucfirst($a_id->name)."</span>";
        else{
            if(isset($_GET['keyword']))
                echo "Search Results for '".$_GET['keyword']."'";
            else{
                $indexPage = 1;
                echo "Latest Articles";
            }
                            
        }
    ?>
</h1>
<?php if($indexPage==1){ $order = $_GET['order'];?>
<div class="right news-right" style="padding-top: 8px;">
    <a href="<?php echo $this->createUrl('news/order/newest')?>" class="<?php if($order=='' || $order=='newest')echo 'active'; ?>">Newest First</a>&nbsp;-&nbsp;
    <a href="<?php echo $this->createUrl('news/order/mostread')?>" class="<?php if($order=='mostread')echo 'active'; ?>">Most Read</a>&nbsp;-&nbsp;
    <a href="<?php echo $this->createUrl('news/order/alphabetic')?>" class="<?php if($order=='alphabetic')echo 'active'; ?>">Alphabetical</a>
</div>
<?php } ?>

<div class="clear"></div>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<?php 
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['articles_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.directory_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more article.',
    'pages' => $pages,
));?>


<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'/site/_articles',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),  
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('news/showall');
    if(isset($_GET['order']) && $_GET['order']!='') $url_value = $this->createUrl('news/order/'.$_GET['order'].'/showall');
    if(isset($_GET['tag']) && $_GET['tag']!='') $url_value = $this->createUrl('news/tag/'.$_GET['tag'].'/showall');
    if(isset($_GET['company']) && $_GET['company']!='') $url_value = $this->createUrl('news/company/'.$_GET['company'].'/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'url' => $url_value,
            ));
    }?>

</div>
<div class="clear"></div>
    
<?php $this->renderPartial('/site/_bottomBanner');?>
</div><!--#body_content_left-->

<div class="body_content_right">
<!-- Right side bar -->

<?php $this->renderPartial('_articlesbytags');?>

<?php $this->renderPartial('_articlesbycompany');?>

<!-- search-->
<?php $this->renderPartial('_search');?>
<!-- recent podcast and video-->
<?php $this->renderPartial('/site/_squareBanner');?>
</div><!--#body_content_right-->
<div class="clear"></div>
<!-- Rght side bar end -->
