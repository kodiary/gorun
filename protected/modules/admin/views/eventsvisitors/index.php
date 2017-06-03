
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min.js');
$this->breadcrumbs=array(
	'EventsCategory'
);?>
<script>
$(function(){
    $('#subPages').sortable({
         
         update : function (event,ui) {
            var order=[];// array to hold the id of all the child li of the selected parent
            $('.pageManagerList').each(function(index) {
                    var item=$(this).attr('id').split('_');
                    var val=item[1];
                    order.push(val); 
                });
            var itemList="list="+order;
           
            $("#showmsg").load("<?php echo $this->createUrl('sort');?>",itemList); 
         }
    });
    
});
</script>
<aside class="col-md-8 addContentArea">
<div class="line"></div>
<h1>Add/Edit Events Type- <span class="blue">Create or Edit an Visitors Profile here.</span></h1>
<div class="line"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
	'id'=>'tags-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true),
)); ?>
<div id="showmsg"></div>
<div class="clear"></div>
 <div class="well"><?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>
	Profile
	<?php echo $form->textField($model,'title',array('class'=>'span4','maxlength'=>255,'placeholder'=>'Enter Profile','style'=>'margin-left:20px')); ?>
	<span class="floatRight"><?php $this->widget('bootstrap.widgets.BootButton', array(
    'buttonType'=>'submit',
    'label'=>'Submit',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
     // '', 'large', 'small' or 'mini'
     'htmlOptions'=>array('id'=>'btnsubmit' , 'class'=>'right'),
)); ?></span>
<div class="clear"></div>
</div>
<?php $this->endWidget(); ?>


<ul id="subPages" class="ui-sortable">
 <?php

    foreach($records as $val){
        $count = EventsLink::countEventsLinkTags('profile_id',$val->id);
    ?>
	<li id="item_<?php echo $val->id;?>" class="greybg pageManagerList">
    <aside class="text_desc_l">
    <span class="titles"><?php echo $val->title?></span> <span class="blue"><?php echo "- ".$count.' Tags';?></span>
    </aside>
    <aside class="text_desc_r">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$val->id,
                'onClick'=>'$("#show_'.$val->id.'").show();'),
            )); ?>
            
            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Edit',
                'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'edit_'.$val->id),
            )); ?>
    </aside>
    
    <div class="clear"></div>
    
    </li>
    
        <div style="display: none;" id="show_<?php echo $val->id?>" class="alert">
                     <div class="floatLeft">
                   		Warning: This cannot be undone. Are you sure?
                    </div>
                    <div class="floatRight">
                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                //'fn'=>'ajaxLink',
                'url' => $this->createUrl('delete', array('id'=>$val->id)),
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'small', // '', 'small' or 'large'
                ));?>
                    
                    <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $val->id?>">Cancel</a> 
                    
                    </div>
                    <div class="clear"></div>
                    </div>
               
    <?php }
?>
    
   
</ul>

</aside>


<div class="col-md-8">
<div class="wide-form">

   
    <div class="clear"></div>


</div>


</div><!--#col-md-8-->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').click(function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
        
   });
   
   $('.btn-info').click(function(){
    var val = this.id.split('_');
    if(id=val[1])
    {
        $.ajax({
          type: "POST",
          url: '<?php echo $this->createUrl("gettitle")?>',
          data: "id="+id
        }).done(function( msg ) {
           $("#EventsVisitors_title").val(msg);
          $("#EventsVisitors_id").val(id);
          $('#btnsubmit').html('Edit');
          if($('#btncancel').length <=0)
          {
            $('#btnsubmit').after('<button id="btncancel" class="btn" type="button" style="margin:5px;">Cancel</button>');
          }
        });
    }
    
   });
   
    $('#btncancel').live('click',function(){
        $('#btnsubmit').html('Submit');
        $("#EventsVisitors_title").val('');
        $("#EventsVisitors_id").val('');
        $(this).remove();
        
   });
});
</script>
