<link href="<?php echo Yii::app()->request->baseUrl; ?>/js/selectbox/jquery.selectBox.css" rel="stylesheet" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/selectbox/jquery.selectBox.js" type="text/javascript"></script>

<input type="hidden" class="moduleType" value="<?php echo $this->module->getName(); ?>"/>
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'events-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array('validateOnSubmit' => true),
)); ?>

<?php

$condition = new CDbCriteria;
$condition->order = "order_by ASC";

$event_types = EventsType::model()->findAll($condition);
$event_categories = EventsCategory::model()->findAll($condition);
$visitor_profiles = EventsVisitors::model()->findAll($condition);

$type = array();
$category = array();
$profile = array();

if (!empty($event_types)) {
    foreach ($event_types as $event_type) {
        $type[$event_type->id] = $event_type->title;
    }
}

if (!empty($event_categories)) {
    foreach ($event_categories as $event_category) {
        $category[$event_category->id] = $event_category->title;
    }
}

if (!empty($visitor_profiles)) {
    foreach ($visitor_profiles as $visitor_profile) {
        $profile[$visitor_profile->id] = $visitor_profile->title;
    }
}

if (isset($_GET['eventId'])) //company member event has id eventId
{
    $id = $_GET['eventId'];
} else {
    if (isset($_GET['id']) && !isset($_GET['eventId'])) //other event id are id
    {
        if(!$model->isNewRecord)
            $id = $_GET['id'];
    }
}

if (isset($id)) {
    $event_time = EventsTime::model()->findAllByAttributes(array('event_id' => $id));
    //$venue = Venues::model()->findByAttributes(array('event_id'=>$id));
    //$org = Organisers::model()->findByAttributes(array('event_id'=>$id));
}
?>

<div class="newa">
	<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 255)); ?>
</div>
<div class="line"></div>
<ul>
    <li>
        <?php echo $form->labelEx($model, 'start_date'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'start_date',
            'mode' => 'date',
            'options' => array(
                //'showAnim'=>'fold',
                'dateFormat' => 'DD, dd MM yy',
                //'minDate'=>0,
                'buttonImage' => Yii::app()->baseUrl . '/images/admin/calender.png',
                'buttonImageOnly' => true,
                'showOn' => "both",
                //'buttonText'=>'17',
                //'altFormat' => 'dd-mm-yy', // show to user format
            ),
            'language' => '',
            'htmlOptions' => array(
                'class' => 'datePickerTxtBox',
                'value' => CommonClass::formatDate($model->start_date, 'l, d F Y'),
            ),
        )); ?>
        <?php echo $form->error($model, 'start_date'); ?>
        <a href="javascript:void(0);" id="show-endtime" onclick="$('#enddate').show();" class="floatRight f12" >End Date?</a>
        <div class="clear"></div>
    </li>

    <?php
    if ($model->end_date != '')
        $end_time_div = 'display:block';
    else
        $end_time_div = 'display:none';
    ?>
    
    <li id="enddate" style="<?php echo $end_time_div; ?>" class="">
        <?php echo $form->labelEx($model, 'end_date', array('class' => 'margintop5')); ?>
        <?php $this->widget('CJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'end_date',
            'mode' => 'date',
            'options' => array(
                'showAnim' => 'fold',
                //'dateFormat'=>'',
                'dateFormat' => 'DD, dd MM yy',
                'ampm' => true,
                'buttonImage' => Yii::app()->baseUrl . '/images/admin/calender.png',
                'buttonImageOnly' => true,
                'showOn' => "both",
                ),
            'language' => '',
            'htmlOptions' => array('class' => 'datePickerTxtBox', 'value' => ($model->
                    isNewRecord || $model->end_date == '') ? '' : CommonClass::formatDate($model->
                    end_date, 'l, d F Y')),
        )); ?>
       
        <a href="javascript:void(0);" id="hide-endtime" onclick="$('select').selectBox('destroy');$('#Events_end_date').val('');$('#enddate').hide();get_event_times(0);" class="close"><img src="<?php echo Yii::app()->baseUrl; ?>/images/admin/close.png" alt="close" /></a>
        <span id="Events_end_time_error"></span>
        <div class="clear"></div>
    </li> 
</ul>
<div class="line"></div>
        
<ul>
    <li> <label>Event Times</label><input type='checkbox' name="times" id='event_time'<?php if (count($event_time) > 0) echo 'checked="checked"'; ?>  /></li>
    <div class="line"></div>
    <li class="event_times"></li>
    
    <li class="left">  Event Description - <span class="blue f12">Provide a description of the event- try to keep it short.</span></li>
    <li class="break">
        <?php if($this->module->getName()=='company'){ ?>
            <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
            <?php
                $model->description = trim(strip_tags($model->description));
                $model->editor_type = 0;
            ?>
            <?php echo $form->hiddenField($model, 'editor_type'); ?>
            <?php echo $form->textArea($model,'description',array('class'=>'span7 autotextarea')); ?>
        <?php }else{ ?>
            <div class="floatRight blue" style="margin-top:10px;"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
            <div class="clear"></div>
            <div class="editor">
                <?php echo $form->hiddenField($model, 'editor_type'); ?>
                <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
                    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
                    <textarea name="Events[basic_editor]" id="Events_basic_editor" class="span7 autotextarea"><?php if($model->description) echo trim(strip_tags($model->description)); ?></textarea>
                </div>
                <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
                    <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'description')); ?>
                </div> 
            </div>
        <?php } ?>
        <?php echo $form->error($model, 'description'); ?>
    </li>
</ul>
<div class="line"></div>

<div class="type">
    <?php echo $form->dropDownListRow($events_link, 'type_id', $type, array('prompt' => '--Select Event Type--')); ?>
</div>
    
<div class="category">
    <?php echo $form->dropDownListRow($events_link, 'category_id', $category, array('prompt' => '--Select Event Category--')); ?>
</div>
    
<div class="profile">
    <?php echo $form->dropDownListRow($events_link, 'profile_id', $profile, array('prompt' => '--Select Visitors Profile--')); ?>
</div>
    
<div class="line"></div>
<h2>Events Logo - <span class="blue">Include an event Logo or Photo</span></h2>
<div class="control-group">
    <div class="control-label" style="float: right; width: 110px; margin-right: 220px; margin-top: 40px;">
        <div class="button_selects">
            <?php
            $this->widget('ext.EAjaxUpload.EAjaxUpload', //select file button
                    array('id' => 'uploadFiles', 'config' => array(
                    'action' => $this->createUrl('upload'),
                    'multiple' => false,
                    'debug' => true,
                    'allowedExtensions' => array("jpg", "jpeg", 'gif', 'png'), //array("jpg","jpeg","gif","exe","mov" and etc...
                    'sizeLimit' => Yii::app()->params['image_size'] * 1024 * 1024, // maximum file size in bytes (10 MB))
                    //'minSizeLimit'=>1024,// minimum file size in bytes
                    'onProgress' => "js:function(id, fileName, loaded, total){
                                    $('#uploadControl').text('Uploading...');
                                }",
                    'onComplete' => "js:function(id, fileName, responseJSON){
                                    $('#uploadControl').text('Select');
                                    if(responseJSON.success)
                                    {
                                        $('#logo').html('<img src=\"'+responseJSON.imageThumb+'\"/>');
                                        $('#logoFilename').val(responseJSON.filename);
                                    }
                                    else
                                    {
                                        alert('something went wrong!');
                                    }  
                               }",
                    'messages' => array(
                        'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                        'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                        'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                        'emptyError' => "{file} is empty, please select files again without it.",
                        'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                    ),
                    'showMessage' => "js:function(message){ alert(message); }"
                    ))
            );
            ?>
        </div>
        <div class="button_selects">
            <?php
            //crop button
            echo CHtml::ajaxButton('Crop', $this->createUrl('cropLogo'), array( //ajax options
                'data' => array('fileName' => 'js:$("#logoFilename").val()'),
                'type' => 'POST',
                'success' => "js:function(data){
                                        $('#cropImg').html(data);
                                        }",
                'complete' => "js:function(){
                                         $('#crop').val('Crop');
                                        }",
                ), array(
                'id' => 'crop',
                'class' => 'btn btn-normal',
                'onclick' => 'js:$("#cropImg").show(); if ($("#logoFilename").val()=="")alert("Please upload the logo and try cropping");else $("#crop").val("loading...");')
                //html options
                );
            ?>
        </div>
        <div class="button_selects">
            <?php
            //clear button
            $this->widget('bootstrap.widgets.BootButton', array(
                'size' => 'normal',
                'label' => 'Remove',
                'id' => 'clearLogo',
                'htmlOptions' => array(
                    'style' => 'margin-top:25px',
                    'class' => 'btn btn-danger',
                    'onclick' => '$("#logo").html("");$("#logoFilename").val("");$("#crop").html("");$("#logo").html("<img src=/exsa_new/images/events_fallback_full.png />")'),
                ));
            ?>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="controls">
        <!-- logo thumb -->
        <div class="image_thumbnailss">
            <div id="logo" class="thumbnail left" >
                <?php
                $logo = $model->logo;
                if ($logo != "" && Yii::app()->file->set('images/frontend/full/' . $logo)->exists) {
                    $logoUrl = $this->createUrl('/images/frontend/full/' . $logo);
                } else {
                    $logoUrl = $this->createUrl('/images/events_fallback_full.png');
                }
                ?>
                <img src="<?php echo $logoUrl; ?>" />
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
	   
<!-- load photo for cropping -->
<div id="cropImg" style="display:none;"></div>

<?php
    $this->renderPartial('application.modules.admin.views.events._addDoc', array(
        'model' => $model,
        'index' => 1,
    ));
    //$company = Company::model()->with('membership')->findAll('member_id=3', array('order' => 'name ASC'));
    $company = Company::getVenues();
    
?>
   
<div class="venue greybg border_line" style="background: #F2F2F2; margin-bottom: 10px;">
    <h2><?php echo $form->labelEx($model, 'venue_id'); ?>- <span class="blue">Select Venue from EXSA Members List or input manually.</span></h2>
    <?php 
        $venue_details['0'] = "Input Venue Details";
        foreach ($company as $comp) {
            $venue_details[$comp->id] = $comp->name;
        }
    ?>
    <?php echo $form->dropDownList($model, 'venue_id', $venue_details, array('prompt' => 'Select A Venue')); ?>
    <?php echo $form->error($model, 'venue_id'); ?>
    <div class="clear" ></div>
</div>
  
<div id="venue_detail">
    <?php if ($model->venue_id == "0") {
        $this->renderPartial('application.modules.admin.views.events._formVenue', array('venue' => $venue));
    } ?>
</div>

<?php if (isset($org)) {
    //$company_org = Company::model()->with('membership')->findAll('member_id=1', array('order' => 'name ASC'));
    $company_org = Company::getOrganizers(); 
    ?>
    <div class="organiser greybg border_line" style="background: #F2F2F2; margin-bottom: 10px;">
        <h2><?php echo $form->labelEx($model, 'organiser'); ?>- <span class="blue">Select From EXSA Member list or Input manually.</span></h2>
        <?php
            $org_details['0'] = "Input Organiser";
            foreach ($company_org as $comp) {
                $org_details[$comp->id] = $comp->name;
            }
            echo $form->dropDownList($model, 'organiser', $org_details, array('prompt' => 'Select Organiser'));
            echo $form->error($model, 'organiser');
        ?>
        <div class="clear"></div>
    </div>
    
    <div class="organiser_detail">
        <?php if ($model->organiser == "0") {
            $this->renderPartial('application.modules.admin.views.events._formOrganiser', array('org' => $org));
        } ?>
    </div>
    
    <?php } ?>
    <ul>
        <li class="greybg radioOption" style="background: #CCE5F3;">
            <?php echo $form->radioButtonListRow($model, 'visible', array('1' => 'Publish Live', '0' => 'Draft Mode (Hidden)')); ?>
            <div class="clear"></div>
        </li>
    </ul>
    
    <input type="hidden" name="formattedAddress" id="formattedAddress" value=""/>
    <input type="hidden" name="logo" id="logoFilename" value="<?php echo $model->logo ?>"/>
    
    <div class="greybg">
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
    </div>
<?php $this->endWidget(); ?>

<div style="display: none;" id="show" class="alert">
    <div class="floatLeft margintop5">
         <?php
             //check for newsletter before deleting news article 
             $check = NewsletterItems::model()->findAll(array('condition'=>"item_type = 2 AND item_id = '$model->id'"));
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
        <?php if(!$check){
                if(isset($_GET['id']) && isset($_GET['eventId'])) $deleteUrl = array('delete', 'id'=>$_GET['id'], 'eventId'=>$model->id);
                else $deleteUrl = array('delete', 'id'=>$model->id);
        ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array(
            'url' => $deleteUrl,
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

<script>
// <![CDATA[
$(document).ready(function(){
    var module = $('.moduleType').val();
    var selected_editor = 'basic';
    error=false;
    $('.event_times').hide();

    if($('#event_time').is(":checked")){ //case for update from
        $('select').selectBox('destroy');
        $.ajax({
            type:'post',
            data:'id=<?php echo $id; ?>',
            url:'<?php echo Yii::app()->request->baseUrl . '/'; ?>' + module + '/events/event_time',
            success:function(msg){
                $('.event_times').show();
                $('.event_times').html(msg);
            }
        });
    }

    $('#Events_start_date').change(function(){
        $('select').selectBox('destroy');
        var start = new Date($('#Events_start_date').val());
        var end =new Date($('#Events_end_date').val());
        var times = end.getTime()-start.getTime();
        var days = times/(24*60*60*1000);
        var pre_date = $('#Events_end_date').val();
        if(times < 0)
        {
            alert('Invalid Start Date.');
            $(this).val(pre_date);
        }
        get_event_times(days);
    });
      
    $('#Events_end_date').change(function(){
        $('select').selectBox('destroy');
        var start = new Date($('#Events_start_date').val());
        var end =new Date($('#Events_end_date').val());
        var times = end.getTime()-start.getTime();
        var days = times/(24*60*60*1000);
        if(times < 0)
        {
            alert('Invalid End Date.');
            $(this).val('');
        }
        get_event_times(days);
    });
   
    $('#event_time').change(function(){
        $('select').selectBox('destroy');
        if($(this).is(":checked"))
        {
            $('.event_times').show();
            var start = new Date($('#Events_start_date').val());
            var end = new Date($('#Events_end_date').val());
            var times = end.getTime()-start.getTime();
            var days = times/(24*60*60*1000);
            get_event_times(days);
        }
        else
        {
            $('.event_times').html('');
            $('.event_times').hide();
        }
    });
    
    if(module=='admin'){
        $('#Events_basic_editor').blur(function(){
            if($(this).val()!=''){
                var detail = $(this).val();
                detail = detail.replace(/\n/g, "<br />");
                CKEDITOR.instances['Events[description]'].setData(detail);
                $('#Events_editor_type').val(0);
     
                $('#Events_description_em_').html("");
                $('#Events_description_em_').hide();
                error=false;
            }
            else{
                CKEDITOR.instances['Events[description]'].setData('');
                $('#Events_description_em_').html("Description cannot be blank.");
                $('#Events_description_em_').show();
                error=true;
            }   
        });
        
        $('#basic-editor').click(function(){
            selected_editor = 'basic';
            $('#Events_editor_type').val(0);
            $('.basic-editor').show();
            $('.advance-editor').hide();
            
            if ($('#Events_basic_editor').val()!=''){
                $('#Events_description_em_').html("");
                $('#Events_description_em_').hide();
                error=false;
            }
            else{
                $('#Events_description_em_').html("Description cannot be blank.");
                $('#Events_description_em_').show();
                error=true;
            }
        });
        
        $('#advance-editor').click(function(){
            selected_editor = 'advance';
            $('#Events_editor_type').val(1);
            $('.advance-editor').show();
            $('.basic-editor').hide();
            $('#Events_description_em_').html("");
            $('#Events_description_em_').hide();
        });
        
        var editor = CKEDITOR.instances['Events[description]'];
        editor.on("blur",function(e){
                var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
                if (editorcontent.length){
                    $('#Events_description_em_').html("");
                    $('#Events_description_em_').hide();
                    error=false;
                }
                else{
                    $('#Events_description_em_').html("Description cannot be blank.");
                    $('#Events_description_em_').show();
                    error=true;
                }
        });
     }
    
    $('#events-form').submit(function(){
        if($('#Events_venue_id').val()=="0")
        {
            if(is_empty('Venues_title','Venue Name'))
                return false;
            else if(is_empty('streetAdd','Street Address'))
                return false;
            else if(is_empty('city','City'))
                return false;
            else if(is_empty('Venues_region','Province'))
                return false;  
        }
        if($('#Events_organiser').val()=="0")
        {
            if(is_empty('Organisers_title','Organiser'))
                return false;
            else if(is_empty('Organisers_contact_number','Contact Number'))
                return false;
            else if(is_empty('Organisers_contact_email','Contact Email'))
                return false;  
        }
        
        if(selected_editor=='basic' && $('#Events_basic_editor').val()==''){
            $('#Events_description_em_').html("Description cannot be blank.");
            $('#Events_description_em_').show();
            return false; 
        }
        
        if(selected_editor=='advance'){
            var editor = CKEDITOR.instances['Events[description]'];
            var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
            if (!editorcontent.length){
                $('#Events_description_em_').html("Description cannot be blank.");
                $('#Events_description_em_').show();
                return false;
            } 
        }
        
        if($('#Events_title').val()=='')
        {
           $('#Events_title_em_').html("Event Title cannot be blank.");
           $('#Events_title_em_').show();
           return false;
        }
          
        return true;
    });

    $('#Events_venue_id').change(function(){
        var id = $(this).val();
        if(id == '0')
        {
            //$('#venue_detail').show();
            $.ajax({
                url:'<?php echo Yii::app()->request->baseUrl . '/'; ?>' + module + '/events/loadVenueForm',
                data:'id=<?php echo $id; ?>',
                type:'post',
                success:function(data){
                    $('#venue_detail').html(data);
                    initialize();
                }
            });
        }
        else
        {
            //$('#venue_detail').hide();    
            $('#venue_detail').html('');
        }
    });

    $('#Events_organiser').change(function(){
        var id = $(this).val();
        if(id == '0')
        {
            //    $('.organiser_detail').show();
            $.ajax({
                url:'<?php echo Yii::app()->request->baseUrl . '/'; ?>' + module + '/events/loadOrganiserForm',
                data:'id=<?php echo $_GET['id']; ?>',
                type:'post',
                success:function(data){
                    $('.organiser_detail').html(data);
                }
            });
        }
        else
        {
            // $('.organiser_detail').hide();
            $('.organiser_detail').html('');    
        }
    });
    
    $('.qq-upload-button').each(function(){
        var index=$(this).attr('id');
        initiateUpload(index);
    });
});

//user defined functions
function get_event_times(days)
{
    var module = $('.moduleType').val();
    
    $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl . '/'; ?>' + module + '/events/event_time',
        type:"post",
        data:"start="+$('#Events_start_date').val()+"&end="+$('#Events_end_date').val()+"&day="+days,
        success:function(msg){
            $('.event_times').html(msg);
        } 
    });
}

function initiateUpload(index)
{
    var module = $('.moduleType').val();
    new qq.FileUploader({'element':document.getElementById('uploadFile_'+index),
    'debug':true,
    'multiple':false,
    'action':'<?php echo Yii::app()->request->baseUrl . "/"; ?>' + module + '/events/uploadDoc/index/' + index,
    'allowedExtensions':['pdf','doc','docx'],
    'sizeLimit':200*10485760,
    'onSubmit':function()
            {
                $('.browse .qq-upload-button #uploadControl').text('Uploading....');
                //$('#uploadFile_'+index).find('.uploadControl').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        $('#uploadFile_'+index).find('.uploadControl').text('Browse');
        $('#uploadControl_'+index).text('Browse');
            if(responseJSON.success)
            {
                //$('#image_'+index).html('<img src="'+responseJSON.imageThumb+'"/>');
                $('#browseFile_'+index).hide();
                $('#uploadDiv_'+index).css('display','block');
                $('#fileInfo_'+index).html(responseJSON.filename+' ('+responseJSON.fileSize+')');
                $('#event_file').val(responseJSON.filename);
            }
            else
            {
                alert('something went wrong!');
            }  
            $('.qq-upload-button #uploadControl').text('Select');
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
} 

function check_if_empty(elem,name)
{
    if($('#'+elem).val()=="")
    {
        if($('#'+elem).length>0){$('#'+elem+'_em').remove();}
        $('#'+elem).after('<div id="'+elem+'_em">'+name+' required!</div>');
    }
}

function is_empty(elem,name)
{
    if($('#'+elem).val()=="")
    {
        if($('#'+elem).length>0){$('#'+elem+'_em').remove();}
        $('#'+elem).after('<div id="'+elem+'_em">'+name+' required!</div>');
        $('#'+elem).focus();
        return true;
    }
    else
        return false;
}
/*]]>*/
</script>