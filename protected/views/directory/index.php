<?php
$this->breadcrumbs=array(
	'directory',
);?>
<?php $this->renderPartial('_directoryHead');?>
<div class="body_content_left directory">
    <div class="line"></div>
        <h1 class="left"><?php echo ($_POST['key']!="")?"Search Results":'Members';?></h1>
        <span class="news-right right" style="margin-top: 8px;">
        <?php
        if($_POST['key']!="")
        {
          ?>
          <span class="blue">Results for "<?php echo $_POST['key'];?>"</span>
          <?php  
        }
        else
        {
        ?>
            <a href="<?php echo $this->createUrl('/directory');?>" class="<?php echo (!isset($_GET['filter']))?'active':'';?>">All</a> - 
            <a href="<?php echo $this->createUrl('/directory/organisers');?>" class="<?php echo ($_GET['filter']=='organisers')?'active':'';?>">Organisers</a> - 
            <a href="<?php echo $this->createUrl('/directory/venues');?>" class="<?php echo ($_GET['filter']=='venues')?'active':'';?>">Venues</a> - 
            <a href="<?php echo $this->createUrl('/directory/service-providers');?>" class="<?php echo ($_GET['filter']=='service-providers')?'active':'';?>">Service Providers</a> - 
            <a href="<?php echo $this->createUrl('/directory/associate-members');?>" class="<?php echo ($_GET['filter']=='associate-members')?'active':'';?>">Associate Members</a>
        <?php  
        }
        ?> 
        </span>
        <div class="clear"></div>
    <div class="line"></div>
    <?php 
    /* auto scrolling on showall*/
    $itemsCount = Yii::app()->params['articles_pers_page'];
    if($pages->itemCount>$itemsCount)
        $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
        'contentSelector' => '.items',
        'itemSelector' => '.direcotry_listing',
        'loadingText' => 'Loading...',
        'donetext' => 'There is no more company.',
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
    
    <div class="btn_pagination_right">
    <?php if(!$pages && $dataProvider->totalItemCount>$itemsCount){
            $showUrl = $this->createUrl('/directory/showall');
        echo CHtml::link('Show All', $showUrl, array('class'=>'btn btn-info'));
    }?>
    </div>
    <div class="clear"></div>
    <div><?php $this->renderPartial('/site/_bottomBanner');?></div>
</div>
<div class="body_content_right">
    <?php $this->renderPartial('_indexsidebar'); ?>
</div>
<div class="clear"></div>