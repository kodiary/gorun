<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/gmap.js"></script>
<form action="<?php echo Yii::app()->request->baseUrl;?>/dashboard" id="profile-detail" method="post">
                <div class="form-group white">
                    <label class="col-md-12">Event title</label>
                    <div class="col-md-12"><input type="text" class="form-control" placeholder="Your Event Title" name="title" value="<?php echo $model->title;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                
                
                <div class="form-group white">
                    <label class="col-md-12">Date and time</label>
                    <div class="col-md-12">Multiple Date Event &nbsp; <input type="checkbox" name="is_multiple_date" value="1" onchange="if($(this).is(':checked'))$('.hiddendate').show('slow');else $('.hiddendate').hide('slow');" /></div>
                    <div class="clearfix"></div>
                    <br />
                    
                    <div class="col-md-12 padding-bot-10 padding-left-0">
                        <div class="col-md-2"><span class="fa fa-calendar"></span> Start Date</div>
                        <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="Start Date" id="start_date" name="start_date" value="<?php echo $model->start_date;?>" /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 padding-bot-10 padding-left-0 hiddendate" style="display: none;">
                        <div class="col-md-2"><span class="fa fa-calendar"></span> End Date</div>
                        <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="End Date" id="end_date" name="end_date" value="<?php echo $model->end_date;?>" /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Event Type</label>
                    <div class="col-md-4">
                        <a href="javascript:void(0)" class="dropdownselect"><span class="value">Event Type</span> <span class="fa fa-sort"></span><span class="line"> | </span></a>
                        <div class="drop-option" style="display:none;">
                            <a href="javascript:void(0)" class="running">Road Running</a>
                            <a href="javascript:void(0)" class="running">Park Run</a>
                            <a href="javascript:void(0)" class="running">Trial Running</a>
                            <a href="javascript:void(0)" class="biking">Road Biking</a>
                            <a href="javascript:void(0)" class="biking">Mountain Biking</a>
                            <a href="javascript:void(0)" class="triathlon">Triathlon - 5150</a>
                            <a href="javascript:void(0)" class="triathlon">Triathlon - Sprint</a>
                            <a href="javascript:void(0)" class="triathlon">Triathlon - Olympic</a>
                            <a href="javascript:void(0)" class="triathlon">Triathlon - Half Ironman</a>
                            <a href="javascript:void(0)" class="triathlon">Triathlon - Ironman</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="loadform">
                    
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Event Info<br /><span class="blue">All the details about your event</span></label>
                    
                    <div class="col-md-12"><textarea class="form-control description" name="description"><?php echo $model->description;?></textarea></div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Cover image (O<span style="text-transform: lowercase;">ptional</span>)</label>
                    <div class="col-md-12 profilepic">
                    <div class="profile_img event_img" id="upimage_0">
                    <?php
                    /*if($member->logo && (Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo))
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                        echo '<img src="'.$img_url.'"/>';
                    }*/
                    
                    ?>
                        
                    </div>
                    <div class="col-md-5 picact">
                    <?php echo $this->renderPartial('application.views.gallery._addImage',array('member'=>$model,'type'=>'event')); ?>
                        
                      
                <?php
                        
                //crop button
                echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
                        $this->createUrl('gallery/cropPhoto?height=215&width=215'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_image').val()}",'id'=>$member->id),
                         'type'=>'POST',
                        'success'=>"js:function(data){
                                    if(data!=''){
                                        $('#cropModal').html(data).dialog('open');
                                        $('.ui-dialog-titlebar-close').hide();
                                         return false;
                                    }
                                    else
                                        alert('No Image selected');
                                    }",
                        'complete'=>"js:function(){
                                      $('#crop_".$member->id."').val('<span class=\"fa fa-crop\"></span> Crop');
                                    }",
                        ),
                        array('id'=>'crop_'.$member->id,'class'=>'btn btn-crop','onclick'=>'$("#crop_'.$member->id.'").val("loading...");')//html options
                );
                ?><br />
                
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Online Entry Link (Optional)<br /><span class="blue">Post your online entry link here if you have one. Will display as button on event page.</span></label>
                    
                    <div class="col-md-12"><input type="text" class="form-control" placeholder="http://www..." name="online_entry" value="<?php echo $model->online_entry;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Event Location (Required)<br /><span class="blue">Input the venue name or address below to find it on google map. Drag pin to desired located if required.</span></label>
                    
                    <div class="col-md-12"><input type="text" onblur='codeAddress()' id="formattedAddress" class="form-control venue" placeholder="Enter venue name or street address" name="venue" value="<?php echo $model->venue;?>" /></div>
                    <div class="clearfix"></div>
                    <div class="sn_group" style="display: none;">
                        	<div class="s1"><input id="Company_latitude" value="" type="text" name="latitude" onchange='updateMapPinPosition()' /></div>
                            <div class="s2"><input id="Company_longitude" value="" type="text" name="longitude" onchange='updateMapPinPosition()' /></div>
                            <div class="clear"></div>
                         </div>
                    <div id="map_canvas" style="height: 200px;background:#e5e5e5;margin-top:15px;"></div>
                    
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Event Organizer (Optional)<br /><span class="blue">Displayed contact details of the event organizer.</span></label>
                    <div class="org_group">
                        <div class="col-md-12">Organizer Name</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Organizer Name" name="org_name" value="<?php echo $model->online_entry;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Contact Number</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Contact Number" name="org_contact" value="<?php echo $model->online_entry;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Email address (Will display a contact button)</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Contact Email" name="org_email" value="<?php echo $model->online_entry;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Website address</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Organizer website address" name="org_website" value="<?php echo $model->online_entry;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Visibility<br /><span class="blue">Events are subject to approval before going live and visible to public.</span></label>
                    <div class="clearfix"></div>
                </div>
                
                <div class="submit_group">
                    <div class="col-md-6">
                        <strong>PLEASE NOTE: Submitting and event requires our approval before it will be displayed live.</strong>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn btn-submit" value="SUBMIT FOR APPROVAL" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                
                <?php /*
                <div class="form-group">
                    <label class="col-md-2">Example</label>
                    <div class="col-md-9"><strong><span class="required">http://www.gorun.co.za/username</span></strong></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Email<span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control profile_email" placeholder="Your Email Address" name="email" value="<?php echo $member->email;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Your e-mail address is used for your login - <strong>Input carefully</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Mobile</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your Mobile Number" name="mobile" value="<?php echo $member->mobile;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Used for password reminder - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <?php $date = explode("-",$member->dob);?>
                <div class="form-group dobs">
                    <label class="col-md-2">Date of Birth<span class="required">*</span></label>
                    <div class="col-md-9">
                        <select name="d_ob" class="col-md-4">
                            <option value="">Day</option>
                            <?php
                            for($i=1;$i<32;$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[2]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        <select name="m_ob" class="col-md-4">
                            <option value="">Month</option>
                            <?php
                            for($i=1;$i<13;$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[1]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select> 
                        <select name="y_ob" class="col-md-4 y_ob">
                            <option value="">Year</option>
                            <?php
                            for($i=(date('Y')-100);$i<date('Y');$i++)
                            {
                                ?>
                                <option value="<?php echo $i;?>" <?php if($date[0]==$i)echo "selected='selected'";?>><?php echo $i;?></option>
                                <?php
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2">Gender<span class="required">*</span></label>
                    <div class="col-md-9">
                        <div class="col-md-6 whitebg"><input type="radio" name="gender" value="1" <?php if($member->gender == '1')echo "checked='checked'";?> /> Male</div>
                        <div class="col-md-6 whitebg"><input type="radio" name="gender" value="0" <?php if($member->gender == '0')echo "checked='checked'";?> /> Female</div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Profile Photo</label>
                    <div class="col-md-9 profilepic">
                    <div class="profile_img" id="upimage_0">
                    <?php
                    if($member->logo && (Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo))
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                        echo '<img src="'.$img_url.'"/>';
                    }
                    
                    ?>
                        
                    </div>
                    <div class="col-md-6 picact">
                    <?php echo $this->renderPartial('application.views.gallery._addImage',array('member'=>$member)); ?>
                        
                      
            <?php
                        
            //crop button
             echo CHtml::ajaxButton('Crop',
                        $this->createUrl('gallery/cropPhoto'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_image').val()}",'id'=>$member->id),
                         'type'=>'POST',
                        'success'=>"js:function(data){
                                    if(data!=''){
                                        $('#cropModal').html(data).dialog('open'); return false;
                                    }
                                    else
                                        alert('No Image selected');
                                    }",
                        'complete'=>"js:function(){
                                      $('#crop_".$member->id."').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop_'.$member->id,'class'=>'btn btn-default','onclick'=>'$("#crop_'.$member->id.'").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="return confirm_delete('Are you sure that you want to remove the image?'); ">Remove</a><br />
                    </div>
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">SA Identity No.</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your SA Identity Number" name="sa_identity_no" value="<?php echo $member->sa_identity_no;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>SA Identity Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Championchip</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your Championchip Number" name="championchip" value="<?php echo $member->championchip;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>Championchip Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">TraceTec</label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your TraceTec Number" name="tracetec" value="<?php echo $member->tracetec;?>"  /></div>
                    <div class="clearfix"></div>
                </div>
                
                 <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-9"><span class="blue">Input your <strong>TraceTec Number</strong> to track your results - <strong>Optional</strong></span></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <?php */?>
                
                
            </form>
<script>
$(function(){
    initialize();
    CKEDITOR.replace( 'description' );
    CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F5f5f5';
	
};
    
    
})
</script>
<style>
.btn-black{padding:5px;font-size:20px;text-transform: uppercase;background:#FFF!important;width:200px!important;color:#000;}
</style>
<script>
  function validate_date(s,e)
  {
    var s_arr = s.split(',');
    var y = s_arr[1].replace(' ','');
    var m_d_arr = s_arr[0].split(' ');
    var m = get_month_by_name(m_d_arr[0]);
    var d = m_d_arr[1];
    if(parseFloat(d) < 10)
    {
        d = '0'+d;
    }
    var num_date1 = y+m+d;
    num_date1 = parseFloat(num_date1);
    
    var e_arr = e.split(',');
    var y2 = e_arr[1].replace(' ','');
    var m_d2_arr = e_arr[0].split(' ');
    var m2 = get_month_by_name(m_d2_arr[0]);
    var d2 = m_d2_arr[1];
    if(parseFloat(d2) < 10)
    {
        d2 = '0'+d2;
    }
    var num_date2 = y2+m2+d2;
    num_date2 = parseFloat(num_date2);
    
    if(num_date1>num_date2)
    {
        //alert(num_date1);
        return false;
    }
    else
    {
        alert(num_date2);
        load_time(num_date1,num_date2);
        return true;
    }
  } 
  function get_month_by_name(name)
  {
    var months = ['January','February','March','April','May','June','July','August','September','August','September','October','November','December'];
    var i = months.indexOf(name); 
    var i = parseFloat(i)+1;
    if(parseFloat(i) < 10)
    {
        i = '0'+i;
    }
    return i;
  }
  function load_time(s,e)
  {
    $.ajax({
        url:'<?php echo $this->createUrl('/events/loadTime');?>',
        type:'get',
        data:'s='+s+'&e='+e,
        success:function(res)
        {
            $('.load_time').html(res);
            $('.timepicker').each(function(){
        	   $(this).timepicki(); 
        	})
        }
    })
  }
  $( function() {
    $('.dropdownselect').click(function(){
        $('.drop-option').toggle();
    });
    $('.drop-option a').click(function(){
        $('.drop-option').hide();
        $('.dropdownselect .value').text($(this).text());
        var class_form = $(this).attr("class");
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl;?>/events/renderForm/',
            data:'type='+$(this).attr('class'),
            type:'post',
            success:function(res){
                $('.loadform').html(res);
            }
        })
        
    })
    if($('.include_times').is(':checked'))
    {
        $('.load_time').show();
    }
    $('.include_times').change(function(){
    if($(this).is(':checked'))
    {
        $('.load_time').show();
    }
    })
    $('.datepicker').each(function(){
        $(this).datepicker({dateFormat: 'MM d, yy'});
    });
    $('#end_date').change(function(){
        var start_d = $('#start_date').val();
        var end_d = $('#end_date').val();
        if(!validate_date(start_d,end_d))
        {
            alert('Start Date can\'t be greater than End Daate');
            $('#end_date').focus();
            $('#end_date').val('');
            $('#end_date').parent().addClass('has-error');
        }
        
    });
    
    $('.timepicker').each(function(){
	   $(this).timepicki(); 
	})
	
    
  } );
</script>








