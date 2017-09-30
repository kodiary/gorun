<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/gmap.js"></script>
<form action="<?php echo Yii::app()->request->baseUrl;?>/events/create/<?php if($model->id)echo $model->id;else echo '0';?>" id="profile-detail" method="post" onsubmit="return validate_form();">
                <div class="form-group white">
                    <label class="col-md-12">Event title</label>
                    <div class="col-md-12"><input type="text" class="form-control" required="" placeholder="Your Event Title" name="Events[title]" value="<?php echo $model->title;?>" onkeyup="generateVanity($(this));" />
                    <span class="blue vanity" style="font-weight: bold;">Vanity URL: <?php echo Yii::app()->createAbsoluteUrl('events/view');?>/</span>
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                
                
                
                <div class="form-group white">
                    <label class="col-md-12">Date and time</label>
                    <div class="col-md-12">Multiple Date Event &nbsp; <input type="checkbox" name="is_multiple_date" value="1" onchange="if($(this).is(':checked'))$('.hiddendate').show('slow');else {$('.hiddendate').hide('slow');$('#end_date').val('');}" <?php if($model->end_date){?>checked<?php }?> /></div>
                    <div class="clearfix"></div>
                    <br />
                    
                    <div class="col-md-12 padding-bot-10 padding-left-0">
                        <div class="col-md-2"><span class="fa fa-calendar"></span> Start Date</div>
                        <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="Start Date" required="" id="start_date" name="Events[start_date]" value="<?php echo $model->start_date;?>" /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 padding-bot-10 padding-left-0 hiddendate" <?php if(!$model->end_date){?>style="display: none;<?php }?>">
                        <div class="col-md-2"><span class="fa fa-calendar"></span> End Date</div>
                        <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="End Date" id="end_date" name="Events[end_date]" value="<?php echo $model->end_date;?>" /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Event Type</label>
                    <div class="col-md-4">
                        <?php 
                        $type = $model->event_type;
                        if($type)
                        {
                            $type_model = EventsType::model()->findByPk($type);
                            $cat_id = $type_model->cat_id;
                            $event_type_name = $type_model->title; 
                            $event_type_id = $type_model->id;
                        }
                        else
                        {
                            $cat_id = '';
                            $event_type_name = ''; 
                            $event_type_id = '';
                        }

                        ?>
                        <a href="javascript:void(0)" class="dropdownselect"><span class="value"><?php if($event_type_name)echo $event_type_name;else{?>Event Type<?php }?></span> <span class="fa fa-sort"></span><span class="line">|</span></a>
                        <div class="drop-option" style="display:none;">
                            <?php
                            $type = array('','running','biking','triathlon');
                            foreach($event_type as $et)
                            {
                                ?>
                                <a href="javascript:void(0)" id="et_<?php echo $et->id;?>" class="<?php echo $type[$et->cat_id]?>"><?php echo $et->title;?></a>
                                <?php
                            }
                            ?>
                            <input type="hidden" name="Events[event_type]" class="event_type" value="<?php echo event_type_id;?>" />
                            <input type="hidden" name="Events[event_cat]" class="event_category" value="<?php echo $cat_id;?>" />
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="errormsg_type errors col-md-12" style="display: none;">This field is required.</div><div class="clearfix"></div>
                </div>
                <div class="loadform">
                    
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Event Info<br /><span class="blue">All the details about your event</span></label>
                    
                    <div class="col-md-12"><textarea required="" class="form-control description" name="Events[description]"><?php echo $model->description;?></textarea></div>
                    
                    <div class="clearfix"></div>
                    <div class="errormsg_desc errors col-md-12" style="display: none;">This field is required.</div><div class="clearfix"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">Cover image (O<span style="text-transform: lowercase;">ptional</span>)</label>
                    <div class="col-md-12 profilepic">
                    <div class="profile_img event_img" id="upimage_0">
                    <?php
                    if($model->logo && file_exists(Yii::app()->basePath.'/../images/frontend/events/thumb/'.$model->logo))
                    {
                        $img_url=Yii::app()->baseUrl.'/images/frontend/events/thumb/'.$model->logo;
                        echo '<img src="'.$img_url.'"/>';
                    }
                    
                    ?>
                        
                    </div>
                    <div class="col-md-5 picact">
                    <?php echo $this->renderPartial('application.views.gallery._addImage',array('member'=>$model,'type'=>'event')); ?>
                        
                      
                <?php
                        
                //crop button
                echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
                        $this->createUrl('gallery/cropPhoto?height=285&width=380'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_image').val()}",'id'=>$model->id),
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
                                      $('#crop_".$model->id."').val('<span class=\"fa fa-crop\"></span> Crop');
                                    }",
                        ),
                        array('id'=>'crop_'.$model->id,'class'=>'btn btn-crop','onclick'=>'$("#crop_'.$model->id.'").val("loading...");')//html options
                );
                ?><br />
                
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Online Entry Link (Optional)<br /><span class="blue">Post your online entry link here if you have one. Will display as button on event page.</span></label>
                    
                    <div class="col-md-12"><input type="text" class="form-control" placeholder="http://www..." name="Events[website]" value="<?php echo $model->website;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Event Flyer or entry form (Optional)<br /><span class="blue">Upload a PDF for download. Handy for event flyer or entry form. Max 7MB file size. Drag to reorder.</span></label>
                    
                    <div class="col-md-12"><a class="btn btn-upload flyer" href="javascript:void(0);" id="uploadFileflyer"><span class="fa fa-file-pdf-o"></span> UPLOAD FILE</a></div>
                    
                    <input type="hidden" class="flyer_file" value="<?php echo $model->file;?>" />
                    <div class="clearfix"></div>
                    <?php
                    if($model->id)
                    $flyers = EventsFile::model()->findAllByAttributes(array('event_id'=>$model->id));
                    ?>
                    <ul class="flyer_list col-md-12" <?php if($model->id && $flyers){}else{?>style="display: none;"<?php }?>>
                        <?php
                        if($model->id)
                        {
                            
                            if($flyers)
                            {
                                foreach($flyers as $f)
                                {
                                    ?>
                                    <li><?php echo $f->file;?><input name="EventsFile[file][]" value="<?php echo $f->file;?>" type="hidden"> (<?php echo $f->mb;?>mb<input name="EventsFile[mb][]" value="<?php echo $f->mb;?>" type="hidden">) - added <?php echo $f->added_on;?><input name="EventsFile[added_on][]" value="<?php echo $f->added_on;?>" type="hidden"> at <?php echo $f->added_time;?><input name="EventsFile[added_time][]" value="<?php echo $f->added_time;?>" type="hidden"> <a href="javascript:void(0)" onclick="$(this).closest('li').remove();" class="cross"><span class="fa fa-times"></span></a></li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Event Location (Required)<br /><span class="blue">Input the venue name or address below to find it on google map. Drag pin to desired located if required.</span></label>
                    
                    <div class="col-md-12"><input type="text" required="" onblur='codeAddress()' id="formattedAddress" class="form-control venue" placeholder="Enter venue name or street address" name="Events[venue]" value="<?php echo $model->venue;?>" /></div>
                    <div class="clearfix"></div>
                    <input id="Company_latitude" type="hidden" name="Events[latitude]" onchange='updateMapPinPosition()' value="-26.2041028" />
                    <input id="Company_longitude" type="hidden" name="Events[longitude]" onchange='updateMapPinPosition()' value="28.047305100000017" />
                            
                    <div id="map_canvas" style="height: 200px;background:#e5e5e5;margin-top:15px;"></div>
                    
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Event Organizer (Optional)<br /><span class="blue">Displayed contact details of the event organizer.</span></label>
                    <div class="org_group">
                        <div class="col-md-12">Organizer Name</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Organizer Name" name="Events[organizer]" value="<?php echo $model->organizer;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Contact Number</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Contact Number" name="Events[organizer_contact]" value="<?php echo $model->organizer_contact;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Email address (Will display a contact button)</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Contact Email" name="Events[organizer_email]" value="<?php echo $model->organizer_email;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="org_group">
                        <div class="col-md-12">Website address</div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" placeholder="Organizer website address" name="Events[organizer_website]" value="<?php echo $model->organizer_website;?>" />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <?php 
                    if(!$model->visible)
                    {
                        ?>

                <div class="form-group white">
                    <label class="col-md-12">Visibility<br /><span class="blue">Events are subject to approval before going live and visible to public.</span></label>
                    <div class="clearfix"></div>
                </div>
                
                <div class="submit_group">
                    <div class="col-md-6">
                        <strong>PLEASE NOTE: Submitting and event requires our approval before it will be displayed live.</strong>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" href="javascript:void(0)" class="btn btn-submit">SUBMIT FOR APPROVAL</button>
                    </div>
                    <div class="clearfix"></div>
                </div>  
                <?php
                    }
                    else
                    {
                        ?>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <button type="submit" href="javascript:void(0)" class="btn btn-submit">SAVE EVENT</button>
                            </div>
                        <div class="clearfix"></div>
                </div> 
                        <?php
                    }
                ?>  
            </form>
<script>
$(function(){
    initialize();
    CKEDITOR.replace( 'Events[description]' );
    CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F5f5f5';
	
};
    
});
</script>

<style>
.btn-black{padding:5px;font-size:20px;text-transform: uppercase;background:#FFF!important;width:200px!important;color:#000;}
</style>
<script>
  function generateVanity($this)
  {
    $('.vanity').text('Vanity URL: <?php echo Yii::app()->createAbsoluteUrl('events/view');?>/'+$this.val().replace(/[^a-z0-9]+/gi,"-"));
  }  
  <?php
  if($model->id)
  {
    ?>
    $('.drop-option a').each(function(){
        var id = $(this).attr('id');
        if(id.replace('et_','') == '<?php echo $model->event_type;?>')
        {
            //alert(id);
            $('.drop-option').show(function(){
                $('#'+id).click();
            });
            
        }
    })
    <?php
  }
  ?>
  function renderForm($this)
  {
    $('.distance_list').html('');
        var cat = $this.attr('class');
        if(cat == 'running')
        $('.event_category').val('1');
        if(cat == 'biking')
        $('.event_category').val('2');
        if(cat == 'triathlon')
        $('.event_category').val('3');
        $('.drop-option').hide();
        $('.dropdownselect .value').text($this.text());
        var id = $this.attr('id').replace('et_','');
        $('.event_type').val(id);
        var class_form = $this.attr("class");
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl;?>/events/renderForm/<?php echo $model->id;?>',
            data:'type='+$this.attr('class'),
            type:'post',
            success:function(res){
                $('.loadform').html(res);
                
            }
        })
  }
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
        //alert(num_date2);
        load_time(num_date1,num_date2);
        return true;
    }
  } 
  function validate_form(){
    var messageLength = CKEDITOR.instances['Events[description]'].getData().replace(/<[^>]*>/gi, '').length;
    if($('.event_type').val()=='')
    {
        
        $('html,body').animate({
                scrollTop: $(".dropdownselect").offset().top},
                'slow');
                $('.errormsg_type').show();
                $('.errormsg_type').fadeOut(7000);
                return false;
    }
    else
    if( !messageLength ) {

       $('html,body').animate({
        scrollTop: $(".cke_1").offset().top},
        'slow');
        $('.errormsg_desc').show();
        $('.errormsg_desc').fadeOut(7000);
        return false;
    }
    else
    return true;
    
    
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
  function confirm_delete(ques)
    {
        if(confirm(ques))
        {
            $('.profile_img').html('');
            $('.image_rows input').val('');
        }
        else
            return false;
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
    initiateUpload2('flyer');
    $('.dropdownselect').click(function(){
        $('.drop-option').toggle();
    });
    $('.drop-option a').click(function(){
        renderForm($(this));        
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
            alert('Start Date can\'t be greater than End Date');
            $('#end_date').focus();
            $('#end_date').val('');
            $('#end_date').parent().addClass('has-error');
        }
        
    });
    
    $('.timepicker').each(function(){
	   $(this).timepicki(); 
	})
	
    
  } );
  function initiateUpload2(index)
{
    //var index=0;
    new qq.FileUploader({'element':document.getElementById('uploadFile'+index),
    'debug':true,
    'multiple':false,
	'action':'<?php echo $this->createUrl('gallery/uploadFile')?>',
    'allowedExtensions':['pdf'],
    'sizeLimit':7340032,
   
    'onSubmit':function()
            {
                //$(this).http://github.com/valums/file-uploader
                $('#uploadFileflyer').text('Uploading...');
            },
    'onComplete':function(id, fileName, responseJSON){
        //alert(responseJSON.success);
            if(responseJSON.success)
            {
                $('.flyer_list').show();
                var str = '<li>'+responseJSON.file+'<input type="hidden" name="EventsFile[file][]" value="'+responseJSON.file+'" /> ('+parseFloat(responseJSON.size).toFixed(2)+'mb<input type="hidden" name="EventsFile[mb][]" value="'+parseFloat(responseJSON.size).toFixed(2)+'" />) - added <?php echo date('Y/m/d');?><input type="hidden" name="EventsFile[added_on][]" value="<?php echo date('Y/m/d');?>" /> at <?php echo date('H:s');?><input type="hidden" name="EventsFile[added_time][]" value="<?php echo date('H:s');?>" /> <a href="javascript:void(0)" onclick="$(this).closest(li).remove();" class="cross"><span class="fa fa-times"></a></li>'
                $('.flyer_list').append(str);
                $('.flyer_file').val(responseJSON.file)
                
            }
            
            else
            {
                alert('something went wrong!');
            }
            $('#uploadFileflyer').html('<span class="fa fa-file-pdf-o"></span> UPLOAD FILE');
            initiateUpload2('flyer');
        },
        'messages':{'typeError':'{file} has invalid extension. Only {extensions} are allowed.','sizeError':'{file} is too large, maximum file size is {sizeLimit}.','minSizeError':'{file} is too small, minimum file size is {minSizeLimit}.','minHeightError': "{file} dimension is too small, minimum Height is {minHeight}.",
            'minWidthError': "{file} dimension is too small, minimum Width is {minWidth}.",'emptyError':'{file} is empty, please select files again without it.','onLeave':'The files are being uploaded, if you leave now the upload will be cancelled.'},'showMessage':function(message){ alert(message); }});
}
</script>
<script>
$('.add_distance1').live('click',function(){
    //alert('test');
    
    var dist1 = $('.dist').val();
    var dist2 = $('.distance_decimal').val(); 
    var start_hour = $('.start_hour').val();
    var start_min = $('.start_min').val();
    var cost = $('.cost').val();
    
    if(!dist1)
    dist1 = '000';
    if(!dist2 || dist2=='0')
        dist2 = '';
    else
        dist2 = ','+dist2;
    if(!start_hour)
    start_hour = '00';
    if(!start_min)
    start_min = '00';
    if(!cost){
    cost = 'N/A';
    cost_val = '';
    }
    else{
    cost_val = cost;
    cost = 'R'+cost;
    
    }
    
    var str = dist1+'<input type="hidden" name="EventsTime[distance1][]" value="'+dist1+'" />'+dist2+'<input type="hidden" name="EventsTime[distance2][]" value="'+dist2.replace(',','')+'" />km &nbsp;|&nbsp; <span class="blue">Start</span> - '+start_hour+'<input type="hidden" name="EventsTime[event_from_hour][]" value="'+start_hour+'" />:'+start_min+'<input type="hidden" name="EventsTime[event_from_min][]" value="'+start_min+'" /> &nbsp;|&nbsp; '+ '<span class="blue">Cost</span> - '+cost + '<input type="hidden" name="EventsTime[event_cost][]" value="'+cost_val+'" /><a href="javascript:void(0)" onclick="$(this).closest(\'li\').remove();" class="cross"><span class="fa fa-times"></span></a>'
    //alert(str);
    $('.distance_list').show()
    $('.distance_list').append('<li>'+str+'</li>');
});
</script>
<script>
$('.add_distance').live('click',function(){
    //alert('test');
    
    var dist1 = $('.dist1').val();
    var dist2 = $('.distance_decimal1').val(); 
    var dist3 = $('.dist2').val();
    var dist4 = $('.distance_decimal2').val(); 
    var dist5 = $('.dist3').val();
    var dist6 = $('.distance_decimal3').val(); 
    var start_hour = $('.start_hour').val();
    var start_min = $('.start_min').val();
    var cost = $('.cost').val();
    
    if(!dist1)
    dist1 = '000';
    if(!dist3)
    dist2 = '000';
    if(!dist5)
    dist3 = '000';
    if(!dist2)
    dist2 = '0';
    if(!dist4)
    dist4 = '0';
    if(!dist6)
    dist6 = '0';
    if(!start_hour)
    start_hour = '00';
    if(!start_min)
    start_min = '00';
    if(!cost){
    cost = 'N/A';
    cost_val = '';
    }
    else{
    cost_val = cost;
    cost = 'R'+cost;
    
    }
    
    var str = '<strong>SWIM</strong>: '+dist1+'<input type="hidden" name="EventsTime[distance_swim_1][]" value="'+dist1+'" />,'+dist2+'<input type="hidden" name="EventsTime[distance_swim_2][]" value="'+dist2+'" />km / <strong>BIKE</strong>: '+dist3+'<input type="hidden" name="EventsTime[distance_bike_1][]" value="'+dist3+'" />,'+dist4+'<input type="hidden" name="EventsTime[distance_bike_2][]" value="'+dist4+'" />km / <strong>RUN</strong>: '+dist5+'<input type="hidden" name="EventsTime[distance_run_1][]" value="'+dist5+'" />,'+dist6+'<input type="hidden" name="EventsTime[distance_run_2][]" value="'+dist6+'" />km  &nbsp;|&nbsp; <span class="blue">Start</span> - '+start_hour+'<input type="hidden" name="EventsTime[event_from_hour][]" value="'+start_hour+'" />:'+start_min+'<input type="hidden" name="EventsTime[event_from_min][]" value="'+start_min+'" /> &nbsp;|&nbsp; '+ '<span class="blue">Cost</span> - '+cost + '<input type="hidden" name="EventsTime[event_cost][]" value="'+cost_val+'" /><a href="#" class="cross"><span class="fa fa-times"></span></a>';
    //alert(str);
    $('.distance_list').show();
    
    $('.distance_list').append('<li>'+str+'</li>');
});
</script>
<?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id'=>'cropModal',
                        'options'=>array(
                            'width'=>'auto',
                            'height'=>'auto',
                            'autoOpen'=>false,
                            'resizable'=>false,
                            'modal'=>true,
                            'overlay'=>array(
                                'backgroundColor'=>'#000',
                                'opacity'=>'0.5'
                            ),
                            'close'=>"js:function(e,ui){ // to overcome multiple submission problem
                                $('#cropModal').empty();
                            }",
                        ),
                    ));
                    //modal dialog content here
                    
                    $this->endWidget('zii.widgets.jui.CJuiDialog');
                ?>








