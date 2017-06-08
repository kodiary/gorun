<?php
$this->breadcrumbs=array(
	'jobs',
);
?>
<div class="body_content_left jobs-new">
<div class="line"></div>
<h1 class="left">
<?php
    if(isset($_GET['keyword']))
        echo "Search Results for '".$_GET['keyword']."'";
    else if(isset($province))
    {?>
    Jobs Listing by Province: <?php echo $province;?>
    <?php }
    else{
        echo "Exhibition &amp; Eventing Jobs in South Africa";
    }
?>
</h1>
<div class="clear"></div>
<div class="line"></div>
<?php if($dataProvider->totalItemCount>0){?>
    <div  style="display: block; margin: 8px 0;"><span class="blue"><?php echo $dataProvider->totalItemCount?></span> jobs currently listed</div>
    <div class="line"></div>
<?php } ?>
<?php 

/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['jobs_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.jobs_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more jobs.',
    'pages' => $pages,
));?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'/jobs/_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),    
)); ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount && !isset($province)){
    $url_value = $this->createUrl('jobs/showall');
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

<div class="body_content_right jobs-new" >
<!-- Right side bar -->
<?php
$this->renderPartial('_listprovince'); 
//$this->renderPartial('/site/_eventCalender');?>
<!-- search-->
<?php $this->renderPartial('_search');?>
<!-- recent podcast and video-->
<?php $this->renderPartial('/site/_squareBanner');?>
</div><!--#body_content_right-->
<div class="clear"></div>
<!-- Rght side bar end -->

<script type="text/javascript">
 //<![CDATA[
 $(document).ready(function(){
    $('.jobDesc').live('click',function(){
        var val = $(this).attr('id').split("_");
        var id=val[1];
        $('.short_desc').show();
        $('.long_desc').hide();
        $('.job-company').hide();
        $('#short_desc_'+id).hide();
        $('#long_desc_'+id).show();
        $('#company_'+id).show();
    });
});
 //]]>
</script>