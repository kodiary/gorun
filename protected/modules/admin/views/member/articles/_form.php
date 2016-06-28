<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.noble.min.js');
?>
<?php $companyId = $_GET['id']; ?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'clientOptions' => array('validateOnSubmit'=>true, 'validateOnType'=>true),
));?>

    <ul class="floating_lists">
        <li>
        	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5')); ?>
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
                    'value'=>CommonClass::formatDate($model->publish_date)
                ),
            ));?>
            <?php echo $form->error($model, 'publish_date');?>
            <div class="clear"></div>
        </li>
    </ul>
    <div class="line"></div>
    
    <div class="news-p">
        <?php
        if($model->isNewRecord){ ?>
            <span class="blue">Added on: ----</span>
            <span class="blue">Updated on: ----</span>
        <?php }else{ ?>
            <span class="blue">Added on: <?php if($model->date_added!='0000-00-00') echo CommonClass::formatDate($data->date_added, 'd F Y');?></span>
            <span class="blue">Updated on: <?php if($model->date_updated!='0000-00-00') echo CommonClass::formatDate($data->date_updated, 'd F Y');?></span>
        <?php } ?>
        <div class="right">
        <img src="<?php echo Yii::app()->baseUrl.'/images/view_icons.png'; ?>" alt="Views"/> <?php if(!$model->readcount) echo '0';else echo $model->readcount;?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="line"></div>
    
    <div class="mar-bot-10 left">News Details - <span class="blue">The news story in full</span></div>
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
	
    <div class="subnav">
        <ul class="nav nav-pills">
            <li id="addPhotos" class="link active"><a href="javascript:void(0);">Add Photos</a></li>
            <li id="addVideos" class="link"><a href="javascript:void(0);">Add Videos</a></li>
            <li id="addAudios" class="link"><a href="javascript:void(0);">Add Audio</a></li>
            <li id="addDocs" class="link"><a href="javascript:void(0);">Add Documents</a></li>
        </ul>
    </div>
    <div class="line"></div>

    
    <!-- photos div -->
    <div class="news photos">
        <?php $this->renderPartial('_addimage',array('model_image'=>$model_image))?>
    </div>
    <!-- end of photos div -->
    
    <!-- videos div -->
    <div class="news videos" style="display: none;">
        <?php $this->renderPartial('videoform',array('model_video'=>$model_video))?>
    </div>
    <!-- end of videos div-->
    
    <!-- audio div -->
    <div class="news audios" style="display: none;">
        <?php $this->renderPartial('audioform',array('model_audio'=>$model_audio))?>
    </div>
    <!-- end of audio div-->
    
    <!-- documents div -->
    <div class="news documents" style="display: none;">
        <?php $this->renderPartial('docform',array('model_document'=>$model_document))?>
    </div>
    <!-- end of documents div-->
    
    <div class="line"></div>
    
    <div class="addContentArea addSEO">
        <div class="greybg mar-bot-10">
        <p><strong>Title </strong>- <span class="green">Most search engines use a maximum of 60 chars for title</span></p>
        <p>You have <span id="count_left1">160</span> characters left</p></div>
        <?php echo $form->textField($model, 'seo_title', array('class'=>'w600 mar-bot-10'));?>
        
        <div class="greybg mar-bot-10">
        <p><strong>Description</strong> - <span class="green">Most search engines use a maximum of 160 chars for description</span></p>
        <p>You have <span id="count_left">160</span> characters left</p></div>
        <?php echo $form->textArea($model, 'seo_desc', array('class'=>'w600 mar-bot-10'));?>
        
        <div class="greybg mar-bot-10"><p><strong>Keywords </strong>- <span class="green">Input up to 8 keywords below that describe this article. (Optional)</span></p>
        <p>Separate them with a comma Eg: keyword, keyword, keyword</p></div>
        <?php echo $form->textArea($model, 'keywords', array('class'=>'w600'));?>
    </div><!--addcontetnarea-->
    
    <div class="line"></div>
    <div class="greybg radioOption mar-bot-10">
        <?php echo $form->radioButtonListRow($model, 'comment_option', array('1'=>'ON - Allow', '0'=>'OFF - No Commenting'));?>
        <div class="clear"></div>
    </div>
    <div class="greybg radioOption mar-bot-10">
        <?php echo $form->radioButtonListRow($model, 'visible', array('1'=>'Publish Live', '0'=>'Draft Mode (Hidden)'));?>
        <div class="clear"></div>
    </div>
    
    <?php if($model->isNewRecord){ ?>
    <div class="greybg radioOption mar-bot-10">
        <?php echo $form->checkBox($model, 'media_post');?>
        <span>Upload image and post this article in EXSA facebook page?</span>
        <div class="clear"></div>
    </div>
    <?php } ?>
        
    <div class="greybg">
	<div style="margin-left:120px;">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'size'=>'large', // '', 'large', 'small' or 'mini'
			'type'=>'primary',
			'label'=>'Submit',
		)); ?>
         <?php if(!$model->isNewRecord){
        $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Delete',
                'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'large', // '', 'large', 'small' or 'mini'
                'htmlOptions'=>array('id'=>'delete_'.$model->id,
                'onClick'=>'$("#show_'.$model->id.'").show();'),
            ));   
    } ?>
	</div>
    </div>

<?php $this->endWidget(); ?>

<div style="display: none;" id="show_<?php echo $model->id?>" class="warning_blocks">
    <div class="fl_left">
        <span class="bold">Warning:</span> This cannot be undone. Are you sure?
    </div>
    <div class="fl_right">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
        //'fn'=>'ajaxLink',
        'url' => array('delete', 'id'=>$companyId, 'newsid'=>$model->id),
        'label' => 'Delete',
        'type' => 'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        //'size'=>'small', // '', 'small' or 'large'
        ));?>
        
        <a class="cancel_button btn info" href="javascript:void(0)" id="cancel_<?php echo $model->id?>" onclick="$('#show_<?php echo $model->id?>').hide();">Cancel</a> 
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script>
// <![CDATA[
$(document).ready(function(){
    var selected_editor = 'basic';
    error=false;
    
    $('#addPhotos').click(function(){
        $('.news').hide();
        $('.link').removeClass('active');
        $(this).addClass('active');
        $('.photos').show();
    });
    $('#addVideos').click(function(){
        $('.news').hide();
        $('.link').removeClass('active');
        $(this).addClass('active');
        $('.videos').show();
    });
    $('#addAudios').click(function(){
        $('.news').hide();
        $('.link').removeClass('active');
        $(this).addClass('active');
        $('.audios').show();
    });
    $('#addDocs').click(function(){
        $('.news').hide();
        $('.link').removeClass('active');
        $(this).addClass('active');
        $('.documents').show();
    });
   
    $('#Articles_seo_desc').NobleCount('#count_left',{
        max_chars:160,
        block_negative: true
    });
    $('#Articles_seo_title').NobleCount('#count_left1',{
        max_chars:60,
        block_negative: true
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