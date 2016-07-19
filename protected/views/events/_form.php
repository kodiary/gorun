<form action="<?php echo Yii::app()->request->baseUrl;?>/dashboard" id="profile-detail" method="post">
                <div class="form-group">
                    <label class="col-md-2">Event title<span class="required">*</span></label>
                    <div class="col-md-9"><input type="text" class="form-control" placeholder="Your Event Title" name="title" value="<?php echo $model->title;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-2">Event Date<span class="required">*</span></label>
                    <div class="col-md-9"><input type="checkbox" name="is_multiple_date" value="1" /> &nbsp; Multiple Date Event</div>
                    <div class="clearfix"></div>
                </div>
               
                <div class="form-group">
                    <label class="col-md-2">Event Date<span class="required">*</span></label>
                    <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="Start Date" id="start_date" name="start_date" value="<?php echo $model->start_date;?>" /></div>
                    <div class="col-md-1"><span class="fa fa-arrow-circle-right icon-circle"></span></div>
                    <div class="col-md-4"><input type="text" class="form-control datepicker" placeholder="End Date" id="end_date" name="end_date" value="<?php echo $model->end_date;?>" /></div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-md-2">Event Times<span class="required">*</span></label>
                    <div class="col-md-9"><input type="checkbox" class="include_times" name="include_times" value="1" /> &nbsp; Include Times</div>
                    <div class="clearfix"></div>
                </div>
                <div class="load_time" style="display: none;"></div>
                <hr />
                <div class="form-group">
                    <label class="col-md-11">Event Description<span class="blue"> - Provide the description of the event - try to keep it short</span></label>
                    <div class="col-md-11"><textarea class="form-control description" name="description"><?php echo $model->description;?></textarea></div>
                    <div class="clearfix"></div>
                </div>
                <hr />
                
                
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
                <div class="form-group">
                <input type="submit" name="submit" value="Save Changes" class="btn btn-default bgblue btn-lg" />
                </div>
                
            </form>

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








