<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-ui.min.js'); ?>

<script>
$(function(){
    $('.items').sortable({
         update : function (event,ui) {
            var order=[];// array to hold the id of all the child li of the selected parent
            $('.resource_category_list').each(function(index) {
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
<h1>Resource Categories - <span class="blue">Manage resources document here</span></h1>
<div class="line"></div>

<div class="clear"></div>
	<div class="well">
        
        <?php $form=$this->beginWidget('ext.bootstrap.widgets.BootActiveForm',array(
        	'id'=>'resource-category-form',
        		'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>false),
        )); ?>
        <div class="cat" style=" margin-bottom: 13px;">
            <?php echo $form->hiddenField($model,'id',array('readOnly'=>'readOnly')); ?>
        	<?php echo $form->textFieldRow($model,'title',array('class'=>'span4','maxlength'=>255,'placeHolder'=>'Enter Category Name')); ?>
           </div> 
           
            <?php echo $form->labelEx($model,'member_type'); ?>
            <div class="checkbox-list">
            <?php echo $form->checkBoxList($model,'member_type',MemberType::listMembers(),array('class'=>'visible_list')); ?>
            <?php echo $form->error($model,'member_type'); ?>
        	</div>
        		<?php $this->widget('bootstrap.widgets.BootButton', array(
                        'buttonType'=>'submit',
                        'label'=>'Submit',
                        'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        //'size'=>'small', // '', 'large', 'small' or 'mini'
                        'htmlOptions'=>array('id'=>'btnsubmit','class'=>'right'),
                )); ?>
        	
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
    <div><?php //$this->renderPartial('_search');?></div>
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
              dataType: 'json',
              cache: false,
              url: '<?php echo $this->createUrl("getResourceCategory")?>',
              data: "id="+id
            }).done(function( data ) {
                $("#ResourceCategory_title").val(data.title);

                $(".visible_list").each(function(){
                    $(this).attr("checked",false);
                });
                        
                visible = data.member_type.split(',');
                for(var i=0; i<visible.length; i++)
                {
                    if(visible[i]!='')
                    {
                        $(".visible_list").each(function(){
                            if($(this).val()==visible[i])
                            {
                                $(this).attr("checked",true);
                            }    
                        });
                    }
                }
                $("#ResourceCategory_member_type").val(data.member_type);
                $("#ResourceCategory_id").val(id);
                $('#btnsubmit').html('Edit');
                if($('#btncancel').length<=0)
                {
                    $('#btnsubmit').after('<button id="btncancel" class="btn btn-canc" type="button">Cancel</button>');
                }
                $("#ResourceCategory_title").focus();
                $(document).scrollTop(155);
            });
        }
    });
   
    $('#btncancel').live('click',function(){
        $('#btnsubmit').html('Submit');
        $("#ResourceCategory_title").val('');
        $("#ResourceCategory_id").val('');
        $(".visible_list").each(function(){
            $(this).attr("checked",false);
        });
        $("#ResourceCategory_title_em_").hide();
        $(this).remove();
    });
});
</script>