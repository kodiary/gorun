<div id="msg"></div>
<?php $this->renderPartial('application.modules.admin.views.company._companyHeader',array('model'=>$model));
?>
<?php
if(isset($_GET['id']))$id=$_GET['id'];
?>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>
<div class="company-bottom">
<div class="col-md-8"> 
<div class="restaurant_menus_wrapper"> 
<h2>Exhibitions &amp; Events - <span class="blue"> List your exhibitions or events here
  <?php 
  /*if(isset($_GET['keyword'])){ echo 'Results for "'.$_GET['keyword'].'"';}else{?>List Of Live Events<?php } */?>
  </span></h2>
<div class="line"></div>
    <?php //echo $this->renderPartial('application.modules.admin.views.events._form',array('model'=>$emodel,'tradinghours'=>$tradinghours)); ?>


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
   <!-- <h4>Advertise your Exhibitions and events here.</h4>
    
    <p>Make use of this section to publicise your events or exhitbitions.</p>
    <p>Add as many as you like.</p>
    <p>You can also edit these at any time in this section.</p>
    <p>Add one now using button on the right.</p>-->
    No Events
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
</div>
<div class="col-md-4">
     <?php $this->widget('bootstrap.widgets.BootButton', array(
                    //'fn'=>'ajaxLink',
                    'url' => array('member/events/create','id'=>$id),
                    'label'=>'+Add Events',
                    'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    //'size'=>'small', // '', 'small' or 'large'
                    ));?>
    <div class="margintopbot10">
        <div class="color_indicators">
         	<div class="color"></div>
            <div class="ind_text">Inactive Events</div>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<script>
$(function(){
       $('.delete').click(function(){
        var id = $(this).attr('title');
        var compId='<?php echo isset($_GET['id'])?$_GET['id']:''?>';
        var len;
        if((len=$('.show_'+id).length) <=0)
        {
            $('#'+id).append('<div class="show_'+id+'" style="margin-top:10px;">'+
            '<div class="floatLeft margintop5"> Warning: This cannot be undone. Are you sure? </div>'+
            '<div class="floatRight"><a class="btn btn-danger" href="<?php echo Yii::app()->request->baseUrl;?>/admin/member/events/delete/id/'+compId+'/eventId/'+id+'">Delete</a>'+
            '<a id="delete_'+id+'" class="btn"  style="margin-left:10px;" onclick="$(\'.show_'+id+'\').remove();" >Cancel</a><div class="clear"></div></div>'+
            '<div class="clear"></div></div>');
        }
        return false;
    }); 
});
</script>