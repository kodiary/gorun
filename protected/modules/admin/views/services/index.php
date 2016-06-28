<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min.js');
?>

<script>
$(function(){
    $('.items').sortable({
         
         update : function (event,ui) {
            var order=[];// array to hold the id of all the child li of the selected parent
            $('.service_list').each(function(index) {
                    var item=$(this).attr('id');
                   // var val=item[1];
                    order.push(item); 
                });
            var itemList="list="+order;
           
            $("#showmsg").load("<?php echo $this->createUrl('sort');?>",itemList); 
         }
    });
    
});
</script>
<div class="left_body">
<div class="line"></div>
<h1>Service Categories</span> - <span class="blue">Create or Edit Service Categories here</span></h1>
<div class="line"></div>
<div class="sorter fl_right">
<?php /*?>Order - <?php echo $sort->link('alphabetic');?> - <?php echo $sort->link('date');*/?>
</div>
<div class="clear"></div>
	<div class="well">
        
        <?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
        	'id'=>'service-form',
        		'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
        )); ?>
        
            Category 
            <?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>
        	<?php echo $form->textField($model,'service_name',array('class'=>'span4','maxlength'=>255,'placeHolder'=>'Add/Edit Service', 'style'=>'margin-left:20px;')); ?>
        
        	
        		<?php $this->widget('bootstrap.widgets.BootButton', array(
                        'buttonType'=>'submit',
                        'label'=>'Save',
                        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'btnsubmit','class'=>'right'),
                )); ?>
        	
            <?php echo $form->error($model,'service_name');?>
            <div class="clear"></div>
        <?php $this->endWidget(); ?>
    </div>
    
<div id="showmsg"></div>
<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'pager' => array(
        'class'=>'bootstrap.widgets.BootPager',
        'maxButtonCount'=>5,
    ),
)); ?>
<div class="clear"></div>
        
</div><!--#left_body-->

<div class="right_body">

    <div><?php $this->renderPartial('_search');?></div>
    <?php /* ?><div> <a class="btn" href="<?php echo $this->createUrl('/admin/services/retag');?>">+ReTag Service</a></div> <?php */?>
</div><!--#right_body-->

<div class="clear"></div>

<script type="text/javascript">
$(document).ready(function(){
   $('.cancel_button').live('click',function(){
    var val = this.id.split('_');
    if(id = val[1])
    {
        $("#show_"+id).hide(); 
    }
   });
   
   $('.btn-info').live('click',function(){
    var val = this.id.split('_');
    if(id=val[1])
    {
        $.ajax({
          type: "POST",
          url: '<?php echo $this->createUrl("getService")?>',
          data: "id="+id
        }).done(function( msg ) {
          $("#Services_service_name").val(msg);
          $("#Services_id").val(id);
          $('#btnsubmit').html('Edit');
          if($('#btncancel').length <=0)
          {
            $('#btnsubmit').after('<button id="btncancel" class="btn" type="button" style="margin:5px;">Cancel</button>');
          }
          $("#Services_service_name").focus();
        });
    }
   });
   
    $('#btncancel').live('click',function(){
        $('#btnsubmit').html('Save');
        $("#Services_service_name").val('');
        $("#Services_id").val('');
        $(this).remove();
        
   });
});
</script>