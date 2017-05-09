<input type="hidden" class="moduleType" value="<?php echo $this->module->getName(); ?>"/>
<div class="restaurant_menus_wrapper">
	<h2>Company Info - <span>All about your Company</span></h2>
    <div class="line"></div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'company-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array('class'=>'update-company-form','enctype'=>'multipart/form-data'),
)); ?>

<div style="display:none;" id="errorTrigger">
    <div id="restaurants-form_es_" class="alert alert-block alert-error">
    <p><b>Please fix the following input errors:</b></p>
    <ul class="errorSummary">
    </ul>
    </div>
    <div class="line"></div>
 </div>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span4','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'tagline',array('class'=>'span4','maxlength'=>255)); ?>
    <div class="additional_extra blue">A one line advertising slogan about your company, <br />for example, "The Complete Exhibition Specialists!"</div>
    <div class="line"></div>
        <label class="a0012 control-label">Membership Type</label>
    <div class="right check-list">
    <?php
    $membership=$model->membership;
    foreach($membership as $member)
    { 
    ?>
    <div class="features_extra_01">
        
        <div class="right">
            <div class="checkboxlist" style="margin-bottom: 10px;">
            <img src="<?php echo $this->createUrl('/images/check.png');?>" /> <?php echo MemberType::model()->findByPk($member->member_id)->type_name;?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <?php } ?>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
	<div class="control-group">
    <div id="abc">
   	<p class="com-logo">Company Logo</p>
    <div class="uploader">
    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload', //select file button
                array(
                    'id'=>'uploadFile',
                    'config'=>array(
                                   'action'=>$this->createUrl('upload'),
                                   'multiple'=> false,
                                   'debug'=> true,
                                   'allowedExtensions'=>array("jpg","jpeg",'gif','png'),//array("jpg","jpeg","gif","exe","mov" and etc...
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes (10 MB))
                                   //'minSizeLimit'=>1024,// minimum file size in bytes
                                   'onProgress'=>"js:function(id, fileName, loaded, total){
                                        $('#uploadControl').text('Uploading...');
                                    }",
                                   'onComplete'=>"js:function(id, fileName, responseJSON){
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
                                   'messages'=>array(
                                                    'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                     'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                     'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                     'emptyError'=>"{file} is empty, please select files again without it.",
                                                     'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                   ),
                                   'showMessage'=>"js:function(message){ alert(message); }"
                                  )
                  ));
    ?>
    </div>
    
    <div class="button_selects">
    <?php
    //crop button
     echo CHtml::ajaxButton('Crop',
                $this->createUrl('cropLogo'),
                 array( //ajax options
                 'data'=>array('fileName'=>'js:$("#logoFilename").val()'),
                 'type'=>'POST',
                'success'=>"js:function(data){
                            $('#cropImg').html(data);
                            }",
                'complete'=>"js:function(){
                             $('#crop').val('Crop');
                            }",
                ),
                array('id'=>'crop','class'=>'btn btn-normal','onclick'=>'js:$("#cropImg").show(); if ($("#logoFilename").val()=="")alert("Please upload the logo and try cropping");else $("#crop").val("loading...");')//html options
    );
    ?>
    </div>
    <div class="button_selects">
    <?php
    //clear button
     	 $this->widget('bootstrap.widgets.BootButton', array(
            'size' =>'normal',
			'label'=>'Clear',
            'id' =>'clearLogo',
            'htmlOptions' =>array('onclick'=>'$("#logo").html("");$("#logoFilename").val("");$("#crop").html("");$("#logo").html("<img src='.$this->createUrl("/images/no_image_large.jpg").' />");'),
		)); 
    ?>
    </div>
    </div>

    <div class="controls">
    <!-- logo thumb -->
    <div class="image_thumbnails">
    <div id="logo" class="thumbnail">
    <?php
    $logo=$model->logo;
    if($logo!="")
    {
         if(Yii::app()->file->set('images/frontend/main/'.$logo)->exists)
         {
            $logoUrl=$this->createUrl('/images/frontend/main/'.$logo.'?id='.rand());
        ?>
        <img src="<?php echo $logoUrl;?>"/>
        <?php
         }
    }
    ?>
    </div>
    </div>
    </div>
    <div class="clear"></div>
    </div>
    <div class="line"></div>
    <!-- load photo for cropping -->
    <div id="cropImg" style="display:none;"></div>
    
    <h2 class="left" style="margin-top: 0">Description - <span>Describe your company here</span></h2>
    <?php if($this->module->getName()=='company'){ ?>
    <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
    <?php
        $model->detail = trim(strip_tags($model->detail));
        $model->editor_type = 0;
    ?>
    <?php echo $form->hiddenField($model, 'editor_type'); ?>
    <?php echo $form->textArea($model,'detail',array('class'=>'span7 autotextarea')); ?>
    <?php }else{ ?>
    <div class="floatRight blue"><span><a href="javascript:void(0);" id="basic-editor">Basic</a></span> | <span><a href="javascript:void(0);" id="advance-editor">Advanced</a></span></div>
    <div class="clear"></div>
    <div class="editor">
        <?php echo $form->hiddenField($model, 'editor_type'); ?>
        <div class="basic-editor" <?php if($model->editor_type==1){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.autotextarea'); ?>
            <textarea name="Company[basic_editor]" id="Company_basic_editor" class="span7 autotextarea"><?php if($model->detail) echo trim(strip_tags($model->detail)); ?></textarea>
        </div>
        <div class="advance-editor" <?php if(!$model->editor_type || $model->editor_type==0){?>style="display: none;"<?php } ?>>
            <?php $this->renderPartial('application.modules.admin.views.common.editor',array('model'=>$model,'attribute'=>'detail')); ?>
        </div> 
    </div>
    <?php } ?>
    <?php echo $form->error($model,'detail'); ?>
    <div class="clear"></div>
    
    <div class="line"></div>
    <h2 style="margin-top:5px;">Contact Details - <span>All your contact details</span></h2>
    <div class="line"></div>
   	<?php echo $form->textFieldRow($model,'number',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'fax',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>255)); ?>
    
    <div class="additional_extra">Optional website address if you have one</div>
    <div class="line"></div>
    <h2 style="margin-top:5px;">Social Media - <span>Display links to your social media (Optional) - Input full url</span></h2>
    <div class="line"></div>
    <?php echo $form->labelEx($model,'twitter'); ?>
    <?php echo $form->textField($model,'twitter',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'https://twitter.com/username')); ?>
    
     <?php echo $form->labelEx($model,'facebook'); ?>
     <?php echo $form->textField($model,'facebook',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'http://www.facebook.com/username')); ?>
     
     <?php echo $form->labelEx($model,'google'); ?>
    <?php echo $form->textField($model,'google',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'https://plus.google.com/usercode')); ?>
     
     <?php echo $form->labelEx($model,'pinterest'); ?>
    <?php echo $form->textField($model,'pinterest',array('class'=>'span5','maxlength'=>255,'placeHolder'=>'http://pinterest.com/username')); ?>
  
     
      <div class="line"></div>
    
     <h2 >Company Location - <span>Physical, Postal and Google Map</span></h2>
     <div class="line"></div>
      <?php echo $form->textAreaRow($model,'display_address',array('class'=>'span5','rows'=>5)); ?>
      
      <div class="additional_extra blue">Address that will display on your advert</div>
      
      <div class="line"></div>
      <?php echo $form->textFieldRow($model,'postal_address',array('class'=>'span5','rows'=>5)); ?>
      <div class="line"></div>
     
      <h2>Google Map - <span>Locate the company or venue on the map</span></h2>
       <div class="line"></div> 
      <?php echo $form->textFieldRow($model,'street_add',array('class'=>'span5','rows'=>5)); ?>
    
      <?php echo $form->textFieldRow($model,'suburb',array('class'=>'span5','id'=>'city','onBlur'=>'codeAddress()')); ?>
    
    <?php echo $form->dropDownListRow($model, 'province', CHtml::listData(Province::model()->findAll(), 'id', 'name'),array('empty'=>'Select Province','onchange'=>'codeAddress();')); ?>
    <div class="line"></div>
      <div class="control-group">
    	<label class="control-label">Coordinates</label>
        <div class="controls">
        <div class="sn_group">
        	<div class="s1"><?php echo $form->textField($model, 'latitude',array('placeholder'=>'Latitude','style'=>'width:127px;','onBlur'=>'updateMapPinPosition();') );?></div>
            <div class="s2"><?php echo $form->textField($model, 'longitude',array('placeholder'=>'Longitude','style'=>'width:125px;margin-left:50px;','onBlur'=>'updateMapPinPosition();') ); ?></div>
            <div class="clear"></div>
         </div>
        </div>
        <div class="clear"></div>
    </div>
     <div class="line"></div>
    <!-- gmap -->
    <div id="map_canvas" style="width: 600px; height: 300px;"></div>
    <h2 style="margin-top:5px;"><span>Drag the pin to reposition it if necessary</span></h2>
    <div class="line"></div>
    <!-- gmap ends -->

    <h2>Trading Hours - <span>Days and times of operation</span></h2>
    <div class="line"></div>
    <div class="control-group">
	<label class="control-label">&nbsp;</label>
    <div class="controls">
    <?php echo $form->radioButtonList($model, 'opentimes_type', array(
        0=>'I prefer not to display my trading hours',
        1=>'Type in my trading hours',
        2=>'Select trading hours from a list',
        ),
        array('class'=>'tpanel')
        ); ?>
    </div>
    <div class="clear"></div>
    </div>
    
    <div id="0" style="display: none;" class="rpanel mar-bot-10"></div>
    
    <div id="1" style="display: <?php if($model->opentimes_type==1)echo "block;"; else echo "none;";?>" class="rpanel">
    <?php echo $form->textArea($model, 'opentimes', array('class'=>'w600 mar-bot-10', 'rows'=>5)); ?>
    </div>
    
    <div id="2"  style="display: <?php if($model->opentimes_type==2)echo "block;"; else echo "none;";?>" class="rpanel">
    <div class="control-group">
    <label class="control-label">Monday</label>
     <div class="controls">
     <div class="sn_group">
     	<div class="s1"><?php echo $form->dropDownList($tradinghours, 'MonFrom', $tradinghours->timeTable());?></div>
        <div class="s2">-</div>
        <div class="s3"><?php echo $form->dropDownList($tradinghours, 'MonTo', $tradinghours->timeTable()); ?></div>
        <div class="s4"><?php echo $form->checkBox($tradinghours, 'MonClosed'); ?> Closed</div>
        <div class="clear"></div>
    	</div>
        </div>
    </div>
    
    <div class="control-group">
    <label class="control-label">Tuesday</label>
        <div class="controls">
        <div class="sn_group">
        <div class="s1">
        <?php echo $form->dropDownList($tradinghours, 'TueFrom', $tradinghours->timeTable());?> 
        </div>
        <div class="s2">-</div>
        <div class="s3"><?php echo $form->dropDownList($tradinghours, 'TueTo', $tradinghours->timeTable()); ?></div>
        <div class="s4"><?php echo $form->checkBox($tradinghours, 'TueClosed'); ?> Closed</div>
        <div class="clear"></div>
        </div>
        </div>
    </div>
    <div class="control-group">
    <label class="control-label">Wednesday</label>
        <div class="controls">
        <div class="sn_group">
        <div class="s1"><?php echo $form->dropDownList($tradinghours, 'WedFrom', $tradinghours->timeTable());?> </div>
        <div class="s2">-</div>
        <div class="s3"><?php echo $form->dropDownList($tradinghours, 'WedTo', $tradinghours->timeTable()); ?></div>
        <div class="s4"><?php echo $form->checkBox($tradinghours, 'WedClosed'); ?> Closed</div>
        <div class="clear"></div>
        </div>
        </div>
    </div>
    <div class="control-group">
    <label class="control-label">Thursday</label>
        <div class="controls">
        <div class="sn_group">
        	<div class="s1"><?php echo $form->dropDownList($tradinghours, 'ThuFrom', $tradinghours->timeTable());?> </div>
            <div class="s2">-</div>
            <div class="s3"><?php echo $form->dropDownList($tradinghours, 'ThuTo', $tradinghours->timeTable()); ?></div>
            <div class="s4"><?php echo $form->checkBox($tradinghours, 'ThuClosed'); ?> Closed</div>
            <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="control-group">
    <label class="control-label">Friday</label>
        <div class="controls">
        <div class="sn_group">
        	<div class="s1"><?php echo $form->dropDownList($tradinghours, 'FriFrom', $tradinghours->timeTable());?></div>
            <div class="s2">-</div>
            <div class="s3"><?php echo $form->dropDownList($tradinghours, 'FriTo', $tradinghours->timeTable()); ?></div>
            <div class="s4"><?php echo $form->checkBox($tradinghours, 'FriClosed'); ?> Closed</div>
            <div class="clear"></div>
            </div>
         </div>
    </div>
    <div class="control-group">
        <label class="control-label">Saturday</label>
        <div class="controls">
        <div class="sn_group">
        	<div class="s1"><?php echo $form->dropDownList($tradinghours, 'SatFrom', $tradinghours->timeTable());?></div>
            <div class="s2">-</div>
            <div class="s3"><?php echo $form->dropDownList($tradinghours, 'SatTo', $tradinghours->timeTable()); ?></div>
            <div class="s4"><?php echo $form->checkBox($tradinghours, 'SatClosed'); ?> Closed</div>
            <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Sunday</label>
        <div class="controls">
        <div class="sn_group">
        <div class="s1"><?php echo $form->dropDownList($tradinghours, 'SunFrom', $tradinghours->timeTable());?></div>
        <div class="s2">-</div>
        <div class="s3"><?php echo $form->dropDownList($tradinghours, 'SunTo', $tradinghours->timeTable()); ?></div>
        <div class="s4"><?php echo $form->checkBox($tradinghours, 'SunClosed'); ?> Closed</div>
        <div class="clear"></div>
        </div>
        </div>
    </div>
    <div class="control-group">
       <label class="control-label"> Public H/days</label>
        <div class="controls">
        <div class="sn_group">
        <div class="s1"><?php echo $form->dropDownList($tradinghours, 'HolidaysFrom', $tradinghours->timeTable());?></div>
        <div class="s2">-</div>
        <div class="s3"><?php echo $form->dropDownList($tradinghours, 'HolidaysTo', $tradinghours->timeTable()); ?></div>
        <div class="s4"><?php echo $form->checkBox($tradinghours, 'HClosed'); ?> Closed</div>
        <div class="clear"></div>
        </div>
        </div>
    </div>
    </div>
    <input type="hidden" name="formattedAddress" id="formattedAddress" value=""/>
    <input type="hidden" name="logo" id="logoFilename" value="<?php echo $model->logo?>"/>

    <div class="control-group greybg">
         <label class="control-label">&nbsp;</label>
         <div class="controls">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size' =>'large',
			'label'=>'Submit',
		)); ?>
    <div class="clear"></div>
    </div>
 
<?php $this->endWidget(); ?>
</div>
</div>
<script type="text/javascript">
// <![CDATA[
$(document).ready(function(){
    var module = $('.moduleType').val();
    var selected_editor = 'basic';
     $('.tpanel').click(function(){
        var id=$(this).val();
        $('.rpanel').hide();
        $('#'+id).show();
     });
      var modified=false;
       $('#company-form').on("change", ":input", function() {
        modified = true;
     });
    window.onbeforeunload = function (e) {
        if (!modified){
            return;
        }
    
        var message = " Are you sure you want to leave this page?\n" + " You have not saved your changes yet!";
    
        var e = e || window.event;
    
        // For IE and Firefox prior to version 4
        if (e) {
            e.returnValue = message;
        }
    
        // For Safari
        return message;
    };
    
    if(module=='admin'){
        $('#Company_basic_editor').blur(function(){
            if($(this).val()!=''){
                var detail = $(this).val();
                detail = detail.replace(/\n/g, "<br />");
                CKEDITOR.instances['Company[detail]'].setData(detail);
                $('#Company_editor_type').val(0);
     
                $('#Company_detail_em_').html("");
                $('#Company_detail_em_').hide();
                error=false;
            }
            else{
                CKEDITOR.instances['Company[detail]'].setData('');
                $('#Company_detail_em_').html("Description cannot be blank.");
                $('#Company_detail_em_').show();
                error=true;
            }   
        });
        
        $('#basic-editor').click(function(){
            selected_editor = 'basic';
            $('#Company_editor_type').val(0);
            $('.basic-editor').show();
            $('.advance-editor').hide();
            if ($('#Company_basic_editor').val()!=''){
                $('#Company_detail_em_').html("");
                $('#Company_detail_em_').hide();
                error=false;
            }
            else{
                $('#Company_detail_em_').html("Description cannot be blank.");
                $('#Company_detail_em_').show();
                error=true;
            }
        });
        
        $('#advance-editor').click(function(){
            selected_editor = 'advance';
            $('#Company_editor_type').val(1);
            $('.advance-editor').show();
            $('.basic-editor').hide();
            $('#Company_detail_em_').html("");
            $('#Company_detail_em_').hide();
        });
        
        var editor = CKEDITOR.instances['Company[detail]'];
        editor.on("blur",function(e){
                var editorcontent = editor.getData().replace(/<[^>]*>/gi,'');
                if (editorcontent.length){
                    $('#Company_detail_em_').html("");
                    $('#Company_detail_em_').hide();
                    error=false;
                }
                else{
                    $('#Company_detail_em_').html("Description cannot be blank.");
                    $('#Company_detail_em_').show();
                    error=true;
                }
        });
     }
    
     $('#company-form').submit(function(){
        var error=false;
        $('.errorSummary').html('');
        if($.trim($('#Company_name').val())=='')
        {
           $('.errorSummary').append('<li>Company Name cannot be blank.</li>');
           error=true; 
        }
        if($.trim($('#Company_tagline').val())=='')
        {
           $('.errorSummary').append('<li>Tag Line cannot be blank.</li>');
           error=true; 
        }
        if($.trim($('#Company_number').val())=='')
        {
           $('.errorSummary').append('<li>Contact Number cannot be blank.</li>');
           error=true; 
        }
        
        if(selected_editor=='basic' && $('#Company_basic_editor').val()==''){                    
           $('.errorSummary').append('<li>Description cannot be blank.</li>');
           error=true; 
        }
        
        if($.trim($('#Company_email').val())=='')
        {
           $('.errorSummary').append('<li>E-mail Address cannot be blank.</li>');
           error=true; 
        }
        if($.trim($('#Company_street_add').val())=='')
        {
           $('.errorSummary').append('<li>Street Address cannot be blank.</li>');
           error=true; 
        }
        if($.trim($('#Company_province').val())=='')
        {
           $('.errorSummary').append('<li>Province cannot be blank.</li>');
           error=true; 
        }
       
        if(error==true){
            $('#errorTrigger').show();
             $('html, body').animate({scrollTop: '250px'}, 900);
            return false;
        }
        else{
            $('#errorTrigger').hide();
            modified=false;
            return true;
        } 
     });
     
     //when focused in
     $('#Company_website').focus(function(){
        if($(this).val()=='')
            $(this).val('http://');
     });
     
     $('#Company_twitter').focus(function(){
        if($(this).val()=='')
            $(this).val('https://twitter.com/');
     });
     
     $('#Company_facebook').focus(function(){
        if($(this).val()=='')
            $(this).val('http://www.facebook.com/');
     });
     
     $('#Company_pinterest').focus(function(){
        if($(this).val()=='')
            $(this).val('http://pinterest.com/');
     });
     
     $('#Company_google').focus(function(){
        if($(this).val()=='')
            $(this).val('https://plus.google.com/');
     });
     
     //when focused out/blur
     $('#Company_website').focusout(function(){
        if($(this).val()=='http://')
            $(this).val('');
     });
     
     $('#Company_twitter').focusout(function(){
        if($(this).val()=='http://twitter.com/')
            $(this).val('');
     });
     
     $('#Company_facebook').focusout(function(){
        if($(this).val()=='http://www.facebook.com/')
            $(this).val('');
     });
     
     $('#Company_pinterest').focusout(function(){
        if($(this).val()=='pinterest.com/')
            $(this).val('');
     });
     
     $('#Company_google').focusout(function(){
        if($(this).val()=='https://plus.google.com/')
            $(this).val('');
     });
});  
/*]]>*/   
</script>