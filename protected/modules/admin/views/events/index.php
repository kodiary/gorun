<?php
$this->breadcrumbs=array(
    'events',
);?>

<aside class="col-md-8 floatLeft">
<div class="line"></div>
    <?php
    if(isset($_GET['filter']))
    {
        if($_GET['filter']=='draft'){ ?>
            <h1>Draft Events - <span class="blue">List Of Draft Events</span></h1>
        <?php }
        if($_GET['filter']=='expired'){ ?>
            <h1>Expired Events - <span class="blue">List Of Expired Events</span></h1>
        <?php }
    }else{
    ?>
  <h1><span class="blue"><?php if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>Live Events - List Of Live Events<?php } ?></span></h1>
  <?php } ?>
  <div class="line"></div>


  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  <?php
  $itemsCount = Yii::app()->params['items_pers_page'];
  if($pages->itemCount>$itemsCount)
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => '.events_listing',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more event.',
    'pages' => $pages,
  ));?>
  
  <?php $this->widget('bootstrap.widgets.BootListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
    'summaryText'=>'',
));?>

<div class="showAllBtn">
  <?php if(!$pages && $dataProvider->totalItemCount>$itemsCount){
    $showall_url = $this->createUrl('events/index/showall');
    if($_GET['filter']) $showall_url = $this->createUrl('events/index/filter/'.$_GET['filter'].'/showall');
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => $showall_url,
                //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
            ));
    }?>
</div>
<div class="clear"></div>
</aside>
<aside class="col-md-4 floatRight">
  <div class="mar-bot-10">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('events/create/id/0'),
                    'label'=>'+Add Events',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
  </div>  
  <div class="margintopbot10">
  <?php $this->renderPartial('_search');?>
  </div>

</aside>
<div class="clear"></div>
<script>
$(function(){
       $('.delete').click(function(){
        var id = $(this).attr('title');
        var len;
        if((len=$('.show_'+id).length) <=0)
        {
            $('#'+id).append('<div class="show_'+id+'" style="margin-top:10px;">'+
            '<div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>'+
            '<div class="floatRight"><a class="btn btn-danger" href="<?php echo Yii::app()->request->baseUrl;?>/admin/events/delete/id/'+id+'">Delete</a>'+
            '<a id="delete_'+id+'" class="btn" onclick="$(\'.show_'+id+'\').remove();" >Cancel</a><div class="clear"></div></div>'+
            '<div class="clear"></div></div>');
        }
        return false;
    }); 
});
</script>