<div class="body_content_left">
<div class="restaurant_menus_wrapper">
<h2>Jobs - <span class="blue">Post an advert for staff - <strong>MAX 3 active adverts</strong></span></h2>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="line"></div>
<?php
/* auto scrolling on showall*/
$itemsCount = Yii::app()->params['items_pers_page'];
if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.jobs_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more jobs.',
    'pages' => $pages,
));?>

<?php if(!$dataProvider->getData()){?>
    <div class="green-border">
        <div class="fl_left">
            <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
        </div>
        <div class="fl_right">
            <div class="blue"><strong>Find someone for the job!</strong></div>
            <div>Recruitement is often a costly business. EXSA hope to help you as a member by allowing you to find staff easily right here through out website. 
                We hope this works for you. Add a job now using the button on the right.</div>
        </div>
        <div class="clear"></div>
    </div>
<?php }else{ ?>
    <?php $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
        'summaryText'=>'',
        'pager' => array(
            'class'=>'bootstrap.widgets.BootPager',
            'maxButtonCount'=>5,
        ),
    )); ?>
<?php } ?>
<div class="showAllBtn"><?php
if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $url_value = $this->createUrl('/company/jobs/showall');
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
</div>

<div class="body_content_right" style="margin-top: 45px;">
<?php $this->renderPartial('_sidebar')?>
</div>
<div class="clear"></div>
</div>