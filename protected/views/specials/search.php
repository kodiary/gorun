<div class="body_content_left">
<div class="pos_rel">
<h1>Search Results</h1>
<p class="hd_des">Results for "<span class="orange"><?php echo $_GET['keyword'];?></span>"</p>

<p class="hd_des"><span class="orange"><?php echo $dataProvider->totalItemCount;?></span> Specials listed below</p>
<div class="line" style="margin-bottom:0;"></div>
<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'',    
));
?>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'menu_popup',
    // additional javascript options for the dialog plugin
    'options'=>array(
        //'title'=>'Menu',
        'autoOpen'=>false,
        //'draggable'=>false,
        'resizable'=>false,
        //'minHeight'=>'1000',
        'width'=>'600',
        'modal'=>true,
        'overlay'=>array(
                'backgroundColor'=>'#000',
                'opacity'=>'0.5'
        ),
        'close'=>"js:function(e,ui){ // to overcome multiple submission problem
$('#menu_popup').empty();
}",

        //'cssFile'=>
    ),
));?>

<div id="update_data"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>

</div>

<!-- right sidebar-->
<div class="body_content_right">
<!-- right sidebar-->
<!-- search form-->
<?php $this->renderPartial('_search', array('keyword'=>$_GET['keyword']));?>
<!--end search-->
<?php $this->renderPartial('_browsebyproduct');?>
<?php //$this->renderPartial("/site/_squareBanner");?>

</div><!-- end right side bar-->
<div class="clear"></div>
