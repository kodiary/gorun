<?php
$this->breadcrumbs=array(
	'events',
);?>

<aside class="body_content_left">
<div class="restaurant_menus_wrapper">
  <h2>Exhibitions &amp; Events - <span class="blue"> List your exhibitions or events here
  <?php 
  /*if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>List Of Live Events<?php } */?>
  </span></h2>
<div class="seperator"></div>
<div class="line"></div>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  <?php 
if($dataProvider->totalItemCount>0)
{
      $this->widget('bootstrap.widgets.BootListView',array(
    	'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    	'pager' => array(
            'class'=>'bootstrap.widgets.BootPager',
            'maxButtonCount'=>5,
        ),
        'summaryText'=>'',
    ));
}
else
{?>
    <div class="green-border">
        <div class="fl_left">
            <img src="<?php echo $this->createUrl('/images/alert.png')?>" alt="alert"/>
        </div>
        <div class="fl_right">
            <div class="blue"><strong>Advertise your Exhibitions and events here.</strong></div>
            <div>Make use of this section to publicise your events or exhitbitions. Add as many as you like. You can also edit these at any time in this section. Add one now using button on the right.</div>
        </div>
        <div class="clear"></div>
    </div>
<?php }?>

<div class="showAllBtn">
  <?php
if($dataProvider->totalItemCount>10 && !isset($_GET['showall'])){
    $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => $this->createUrl('events/index/showall'),
                //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
            ));
    }?>
</div>
<div class="clear"></div>
</div>
</aside>

<aside class="body_content_right" style="margin-top: 45px;">
  
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('events/create'),
                    'label'=>'+Add Events',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
    <div class="margintopbot10">
    <div class="color_indicators">
     	<div class="color"></div>
        <div class="ind_text">Inactive Events</div>
    </div>
  <?php //$this->renderPartial('_search');?>
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
            '<div class="floatRight"><a class="btn btn-danger" href="<?php echo Yii::app()->request->baseUrl;?>/company/events/delete/id/'+id+'">Delete</a>'+
            '<a id="delete_'+id+'" class="btn"  style="margin-left:10px;" onclick="$(\'.show_'+id+'\').remove();" >Cancel</a><div class="clear"></div></div>'+
            '<div class="clear"></div></div>');
        }
        return false;
    }); 
});
</script>