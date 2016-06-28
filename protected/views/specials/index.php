<div class="body_content_left">
<div class="pos_rel">
<h1>
<?php 
if($slug=$_GET['product'])$title=Products::model()->find('slug="'.$slug.'"')->product_name;
if($slug=$_GET['service'])$title=Services::model()->find('slug="'.$slug.'"')->service_name; 
if($title)echo "Supplier Specials for ".$title;
else echo "Supplier Specials";
?>
</h1>
<p class="hd_des">
<span class="count_num"><?php echo $dataProvider->totalItemCount;?></span> Specials listed below -
<?php
if(!isset($_GET['product']) && !isset($_GET['service']))
{
?>
<?php echo CHtml::link('Recently Added', array('/specials'), array('class'=>($_GET['order']=='')?'active':''));?> - 
<?php echo CHtml::link('Date Order', array('/specials/order/date'),array('class'=>$_GET['order']=='date'?'active':''));?>
<?php
}
if(isset($_GET['product']) || isset($_GET['service']))
{
?>
  <?php echo CHtml::link('Recently Added', ($_GET['product'])?array('/specials/product/'.$_GET['product']):array('/specials/service/'.$_GET['service']), array('class'=>($_GET['order']=='')?'active':''));?> - 
  <?php echo CHtml::link('Date Order', ($_GET['product'])?array('/specials/product/'.$_GET['product'].'/order/date'):array('/specials/service/'.$_GET['service'].'/order/date'),array('class'=>$_GET['order']=='date'?'active':''));?>  
<?php
}
?>
</p>
<div class="line" style="margin-bottom:0;"></div>
<?php if($this->action->id!='showall')$dataProvider->getPagination()->pageVar = 'page'; ?>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'', 
    'ajaxUpdate'=>false, 
    'pager' => array(
        'class'=>'application.widgets.MyPager',
        'maxButtonCount'=>10,
    ),  
));?>
<?php 
/* auto scrolling on showall*/
if($this->action->id=='showall')
    $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.items',
    'itemSelector' => 'div.line_directory',
    'loadingText' => 'Loading...',
    'donetext' => 'There is no more specials.',
    'pages' => $pages,
)); 
?>
<div class="btn_pagination_right">
<?php 
if($dataProvider->totalItemCount>Yii::app()->params['items_pers_page'] && $this->action->id!='showall')
$this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Show All',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'url' => array('/specials/all'),
                //'htmlOptions'=>array('id'=>'update_'.$data->NewsId),
            )); ?>
<!-- bottom banner-->
</div>
</div>
<?php // $this->renderPartial("/site/_bottomBanner");?>
</div>
<div class="body_content_right">
<!-- right sidebar-->
<!-- search form-->
<?php $this->renderPartial('_search', array('keyword'=>$search_keyword));?>
<!--end search-->
<?php $this->renderPartial('_browsebyproduct');?>
<?php //$this->renderPartial("/site/_squareBanner");?>
</div>
<div class="clear"></div>
<script type="text/javascript">
$(document).ready(function(){
    $(".view").hover(
  function () {
    
    $(this).addClass('hoverover');
  }, 
  function () {
    $(this).removeClass('hoverover');
  });
});
</script>
<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'menu_popup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'autoOpen'=>false,
        'resizable'=>false,
        'height'=>'auto',
        'width'=>'auto',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
$('#menu_popup').empty();
}")));?>
<div id="update_data"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<script type="text/javascript">
 //<![CDATA[
 var expandId;
 $(document).ready(function(){
    $('.expand').click(function(){
        var val = $(this).attr('id').split("_");
        var id=val[1];
        //alert(id);
        $('.expanded').slideUp();
       if(expandId)
       {
          $('#short_'+expandId).slideDown('200');  
       }
        $('#short_'+id).slideUp();
        $('#long_'+id).slideDown('200');
        expandId=id;
    });
 });
 //]]>
</script>