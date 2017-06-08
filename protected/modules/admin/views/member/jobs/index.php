<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$companyModel)); ?>
<div class="company-bottom">
<div class="col-md-8">
<div class="restaurant_menus_wrapper">
<h2>Jobs - <span class="blue">Post an advert for staff - <strong>MAX 3 active adverts</strong></span></h2>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

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

<div class="col-md-4">
<?php $this->renderPartial('_sidebar')?>
</div>
<div class="clear"></div>
</div>