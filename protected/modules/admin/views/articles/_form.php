<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
));?>

<div class="addContentArea">
	<ul>
    	<li><?php echo $form->textFieldRow($model,'title',array('class'=>'titleBox inputwidth')); ?>
        	<div class="clear"></div>
        </li>
        <li>
            <?php echo $form->labelEx($model, 'publish_date');?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'publish_date',
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd MM yy',
                    //'minDate'=>0,
                    'buttonImage'=>Yii::app()->baseUrl.'/images/calender.png',
                    'buttonImageOnly'=>true,
                    'showOn'=>"both",
                    'constrainInput'=>false,
        			
                    //'buttonText'=>'17',
                    //'altFormat' => 'dd-mm-yy', // show to user format
                ),
                'htmlOptions'=>array(
                    'class'=>'datePickerTxtBox',
                    'value'=>CommonClass::formatDate($model->publish_date),
                    'style'=>'margin-left:-5px;'
                ),
            ));?>
            <span class="blue">Date of Article Publication for sorting</span>
            <?php echo $form->error($model, 'publish_date');?>
            <div class="clear"></div>
        </li>
    </ul>
    <div class="line"></div>
    <ul>
        <li class="left">
            <?php echo $form->labelEx($model, 'detail');?>
            <span class="blue" style="font-size:12px;"> The article story in full.</span>
        </li>
        <li>
            <div class="floatRight blue"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
            <div class="clear"></div>
            <div class="editor">
                <?php echo $form->hiddenField($model, 'editor_type'); ?>
                <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
                    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
                    <textarea name="Articles[basic_editor]" id="Articles_basic_editor" class="span7 autotextarea"><?php if($model->detail) echo trim(strip_tags($model->detail)); ?></textarea>
                </div>
                <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
                    <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'detail')); ?>
                </div> 
            </div>
            <?php echo $form->error($model,'detail'); ?>
            <div class="clear"></div>
        </li>
    
        <li class="greybg">
            <aside class="floatLeft">Common Topics <span class="blue">(Used to link Articles)</span></aside>
            <aside class="floatRight"><a href="javascript:void(0);" id="topicsToggle"><img src="<?php echo Yii::app()->baseUrl; ?>/images/downarrow.png" /></a></aside>
            <div class="clear"></div>
            
            <div id="topicsShow" class="" style="display: none;">
                <div class="line"></div>
                <?php echo $form->checkBoxList($model, 'common_tags', Tags::getAllTags('tag'));?>
                <div class="clear"></div>
            </div>
        </li>
    
        <li class="greybg">
            <aside class="floatLeft">Article Source <span class="blue">(Give credit to Source)</span></aside>
            <aside class="floatRight"><a href="javascript:void(0);" id="sourceToggle"><img src="<?php echo Yii::app()->baseUrl; ?>/images/downarrow.png" /></a></aside>
            <div class="clear"></div>
        </li>
    
        <div id="sourceShow" style="display: none;">
            <div>
                <?php
                if(count($source)>=1)
                {
                    $master_source=$source[0]->source_name;
                    $master_link=$source[0]->source_link;
                }
                ?>
                <li class="addsource">
                    <?php echo $form->textFieldRow($model_source, "[0]source_name",array('id'=>'masterSource','value'=>$master_source));?>
                    <?php echo CHtml::link('Clear Source', 'javascript:void(0);', array('class'=>'floatRight', 'id'=>'link'));?>
                    <div class="clear"></div>
                </li>
                <li class="addsource">
                    <?php echo $form->textFieldRow($model_source, "[0]source_link",array('id'=>'masterSourceLink','value'=>$master_link));?>
                     <?php echo CHtml::button('+Add Source', array('class' => 'btn source-add floatRight'))?>
                    <div class="clear"></div>
                </li>
                <div class="clear"></div>
            </div>
            <div class="article-source">
            <?php 
                if(count($source)>1)
                {
                    for($i=1; $i<count($source); $i++):
            		  $this->renderPartial('_addsource', array(
            				'source' => $source[$i],
            				'index' => $i,
            			));
            		 endfor;
                }
                ?>
            </div>
        </div>
   
        <li class="greybg radioOption">
            <label>Member</label>
            <?php echo $form->dropDownList($model, 'company_id', Company::getAll(), array('empty'=>'Untagged Article', 'class'=>''));?> 
            <div class="clear"></div>
        </li>
    
        <li class="greybg radioOption">
            <?php echo $form->radioButtonListRow($model, 'comment_option', array('1'=>'ON - Allow', '0'=>'OFF - No Commenting'));?>
            <div class="clear"></div>
        </li>
    
        <li class="greybg radioOption">
            <?php echo $form->radioButtonListRow($model, 'visible', array('1'=>'Publish Live', '0'=>'Draft Mode (Hidden)'));?>
            <div class="clear"></div>
        </li>
        
        <?php if($model->isNewRecord){ ?>
        <li class="greybg radioOption">
            <?php echo $form->checkBox($model, 'media_post');?>
            <span>Upload image and post this article in EXSA facebook page?</span>
            <div class="clear"></div>
        </li>
        <?php } ?>
    
        <li class="greybg">
            <span class="floatLeft">
                <?php $this->widget('bootstrap.widgets.BootButton', array(
        			'buttonType'=>'submit',
        			'size'=>'large', // '', 'large', 'small' or 'mini'
        			'type'=>'primary',
        			'label'=>'Submit',
                    'htmlOptions'=>array('style'=>'margin-left:120px;')
    		    )); ?>
            </span>
            <span class="floatRight">
                <?php if(!$model->isNewRecord){
                    $this->widget('bootstrap.widgets.BootButton', array(
                            'label'=>'Delete',
                            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            //'size'=>'small', // '', 'large', 'small' or 'mini'
                            'htmlOptions'=>array('id'=>'delete',
                            'onClick'=>'$("#show").show(400);'),
                    ));   
                } ?>
            </span>
            <div class="clear"></div>
        </li>
    </ul>

    <div class="clear"></div>
</div><!--addContentArea-->
<div class="clear"></div>

<?php $this->endWidget(); ?>

<div style="display: none;" id="show" class="alert">
    <div class="floatLeft margintop5">
         <?php
             //check for newsletter before deleting news article 
             $check = NewsletterItems::model()->findAll(array('condition'=>"item_type = 1 AND item_id = '$model->id'"));
             if($check)
             {
                ?>
                WARNING! The item has been assigned to newsletter. Remove the item from newsletter first to delete the item.<br/>
                <?php
             }else{ ?>
                Warning: This cannot be undone. Are you sure?
             <?php } ?>
    </div>
    <div class="floatRight">
        <?php if(!$check){ ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
            'url' => array('delete', 'id'=>$model->id),
            'label'=>'Delete',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            //'size'=>'small', // '', 'small' or 'large'
        ));?>
        <?php } ?>
        
        <?php
            $this->widget('bootstrap.widgets.BootButton', array(
    			'buttonType'=>'cancel',
    			//'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                //'size'=>'', // '', 'large', 'small' or 'mini',
    			'label'=>'Cancel',
                'htmlOptions'=>array('id'=>'cancel',            
                'onClick'=>'$("#show").hide(400);'),       
		));?> 
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
// <![CDATA[
$(document).ready(function(){
    var selected_editor = 'basic';
    error=false;
    
    $(".source-add").click(function(){
        var count=$(".article-source div").size(); 
        if(count==0) 
            count=1;
        else 
            count=parseInt($(".article-source div.source:last").attr('id'))+1; 
            $(".source-add").val('loading...');
    			$.ajax({
    				success: function(html){
    					$(".article-source").append(html);
    				},
                    complete: function(){
                         $(".source-add").val('+Add Source');
                    },
    				type: 'get',
    				url: '<?php echo $this->createUrl('addsource')?>',
    				data: {
    					index: count
    				},
    				cache: false,
    				dataType: 'html'
    			});
    });
   $(".clear-source").live('click', function(){
    var id = this.id;
    var sourceid = id.split('_');
    $("#source_"+sourceid[1]).remove(); 
   });
   $('#topicsToggle').click(function(){
    if( $('#topicsShow').is(":visible"))
    {
         $('#topicsToggle').html('<img src="<?php echo $this->createUrl('/images/downarrow.png')?>"/>');
    }
    else
    {
        $('#topicsToggle').html('<img src="<?php echo $this->createUrl('/images/uparrow.png')?>"/>');
    }
    $('#topicsShow').toggle();
   });
    $('#sourceToggle').click(function(){
    if( $('#sourceShow').is(":visible"))
    {
         $('#sourceToggle').html('<img src="<?php echo $this->createUrl('/images/downarrow.png')?>"/>');
    }
    else
    {
        $('#sourceToggle').html('<img src="<?php echo $this->createUrl('/images/uparrow.png')?>"/>');
    }
    $('#sourceShow').toggle();
   });
   $('#link').click(function(){
   $('#masterSource').val('');
   $('#masterSourceLink').val('');
   });

    $('#Articles_basic_editor').blur(function(){
        if($(this).val()!=''){
            var detail = $(this).val();
            detail = detail.replace(/\n/g, "<br />");
            CKEDITOR.instances['Articles[detail]'].setData(detail);
            $('#Articles_editor_type').val(0);
            $('#Articles_detail_em_').html("");
            $('#Articles_detail_em_').hide();
            error=false;
        }
        else{
            CKEDITOR.instances['Articles[detail]'].setData('');
            $('#Articles_detail_em_').html("Description cannot be blank.");
            $('#Articles_detail_em_').show();
            error=true;
        }   
    });
    
    $('#basic-editor').click(function(){
        selected_editor = 'basic';
        $('#Articles_editor_type').val(0);
        $('.basic-editor').show();
        $('.advance-editor').hide();
        
        if ($('#Articles_basic_editor').val()!=''){
            $('#Articles_detail_em_').html("");
            $('#Articles_detail_em_').hide();
            error=false;
        }
        else{
            $('#Articles_detail_em_').html("Description cannot be blank.");
            $('#Articles_detail_em_').show();
            error=true;
        }
    });
    
    $('#advance-editor').click(function(){
        selected_editor = 'advance';
        $('#Articles_editor_type').val(1);
        $('.advance-editor').show();
        $('.basic-editor').hide();
        $('#Articles_detail_em_').html("");
        $('#Articles_detail_em_').hide();
    });
    
    var editor = CKEDITOR.instances['Articles[detail]'];
    editor.on("blur",function(e){
            var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
            if (editorcontent.length){
                $('#Articles_detail_em_').html("");
                $('#Articles_detail_em_').hide();
                error=false;
            }
            else{
                $('#Articles_detail_em_').html("Description cannot be blank.");
                $('#Articles_detail_em_').show();
                error=true;
            }
    });
});
/*]]>*/
</script>