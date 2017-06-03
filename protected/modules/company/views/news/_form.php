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
    
    <div class="mar-bot-10">News Details - <span class="blue">The news story in full</span></div>
    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
    <?php
        $model->detail = trim(strip_tags($model->detail));
        $model->editor_type = 0;
    ?>
    <?php echo $form->hiddenField($model, 'editor_type'); ?>
    <?php echo $form->textArea($model,'detail',array('class'=>'w600 span7 autotextarea')); ?>
    <?php echo $form->error($model,'detail')?>
	
    <div class="subnav">
        <ul class="nav nav-pills">
            <li id="addPhotos" class="link active"><a href="javascript:void(0);">Add Photos</a></li>
            <li id="addVideos" class="link"><a href="javascript:void(0);">Add Videos</a></li>
            <li id="addAudios" class="link"><a href="javascript:void(0);">Add Audio</a></li>
            <li id="addDocs" class="link"><a href="javascript:void(0);">Add Documents</a></li>
        </ul>
    </div>
    <div class="line" style="margin:-5px 0 10px;"></div>

    
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
    
    <div class="greybg radioOption mar-bot-10">
        <?php echo $form->radioButtonListRow($model, 'comment_option', array('1'=>'ON - Allow', '0'=>'OFF - No Commenting'));?>
        <div class="clear"></div>
    </div>
    
    <?php if($model->isNewRecord){ ?>
    <div class="greybg radioOption">
        <?php echo $form->checkBox($model, 'media_post');?>
        <span>Upload image and post this news in EXSA facebook page?</span>
        <div class="clear"></div>
    </div>
    <?php } ?>
    
	<div class="greybg mar-bot-10">
    <div style="margin-left:155px ;">
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
                //'size'=>'small', // '', 'large', 'small' or 'mini'
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
        'url' => array('news/delete/'.$model->slug),
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
$(document).ready(function(){
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
});
</script>