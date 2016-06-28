<div class="body_content_left">
<?php //$this->renderPartial('_search');?>
<h1><span class="blue"><?php if($supplierName) echo ucfirst($supplierName); ?></span> Suppliers</h1>
<?php 
if($_GET['products'])
    $slug = $_GET['products'];
elseif($_GET['services'])
    $slug = $_GET['services'];
?>
<p class="hd_des">Order -
<?php echo CHtml::link('Alphabetical', array('/'.$section.'/'.$slug.'/order/alphabetical'), array('class'=>($_GET['order']=='alphabetical')?'active':''));?> - 
<?php echo CHtml::link('Date Added', array('/'.$section.'/'.$slug.'/order/date-added'),array('class'=>$_GET['order']=='date-added'?'active':''));?> - 
<?php echo CHtml::link('Last Updated', array('/'.$section.'/'.$slug),array('class'=>($_GET['order']=='' || !isset($_GET['order']))?'active':''));?> -
<?php echo CHtml::link('With Specials', array('/'.$section.'/'.$slug.'/order/with-specials'),array('class'=>$_GET['order']=='with-specials'?'active':''));?> 
</p>

<?php
/* auto scrolling on showall*/
if($pages->itemCount>Yii::app()->params['items_pers_page'])
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.direcotry_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more company.',
    'pages' => $pages,
)); 
?>
<?php /*$this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',
    'emptyText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); */?>
<?php if(!isset($_GET['showall']))$dataProvider->getPagination()->pageVar = 'page';?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>false,
	'itemView'=>'_view',
    'summaryText'=>'',
    'emptyText'=>'',
    'pager' => array(
        'class'=>'application.widgets.MyPager',
        'pageSize'=>Yii::app()->params['items_pers_page'],
        'maxButtonCount'=>10,
    ),
)); ?>

<div class="btn_pagination_right">
<?php if(!$pages && $dataProvider->totalItemCount>Yii::app()->params['items_pers_page']){

        if(isset($_GET['order']))
            $showUrl = $this->createUrl('/'.$section.'/'.$slug.'/order/'.$_GET['order'].'/showall');
        else
            $showUrl = $this->createUrl('/'.$section.'/'.$slug.'/showall');

        if($dataProvider->totalItemCount>Yii::app()->params['items_pers_page'])
            echo CHtml::link('Show All', $showUrl, array('class'=>'btn btn-info'));
}?>
</div>
<div class="clear"></div>
</div><!--#body_content_left-->

<div class="body_content_right">
    <?php $this->renderPartial('_searchTopics');?>
    
    <div class="bluebg orsearch">
    <form action="<?php echo $this->createUrl('/search')?>">
        <div class="controls"><input type="text" name="keyword" id="kyword" Placeholder="Search Directory"/></div>
        <input type="submit" value="SEARCH" class="btn btn-primary fl_left" onclick='if($("#kyword").val()=="") return false;'/>
        <div class="clear"></div>
    </form>
    </div>    
    
    <?php $this->renderPartial('_specials',array('dataProvider'=>$specials));?>
</div><!--#body_content_right-->
<div class="clear"></div>