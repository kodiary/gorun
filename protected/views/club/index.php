<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail">
            <div class="col-md-12">
                <h1>ADD YOUR CLUB</h1>
                <strong><span class="blue">Add Your Club.</span> </strong>
            </div>
            <div class="clearfix"></div>
            
            <hr />
            
            <form action="<?php echo Yii::app()->request->baseUrl;?>/dashboard" id="profile-detail" method="post">
                <div class="form-group">

                    <label class="col-md-3">Club Name<span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="Club Name..." name="name" value="<?php //echo $member->fname;?>" /></div>

                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-12">Club Description <span class="blue">- Provide a description of the club</span><span class="required">*</span></label>
                    <div class="col-md-12"> <textarea class="form-control username" placeholder="Club description..." name="username"> </textarea></div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                
                <div class="form-group">
                    <label class="col-md-12">Club Logo <span class="blue">- Include an club logo or photo (Optional)</span></label>
                    <div class="clearfix"></div>
                        <div class="profilepic ">
                        <div class="profile_img " id="upimage_0">
                        <?php
                        if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo))
                        {
                            $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                        }
                        else
                        {
                            $img_url=Yii::app()->baseUrl.'/images/noimage.jpg';    
                        }
                        ?>
                        <img src="<?php echo $img_url;?>"/>
                        </div>
                        <div class="col-md-6">
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

                    <div class="col-md-3">
                        <label> <strong>Club Type</strong><span class="required">*</span> </label>
                    </div>
                    <div class="col-md-7">
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Running" />Running</span>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Canoe" />Canoe</span>
                        <div class="clearfix"></div>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Swimming" />Swimming</span>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Cross Country" />Cross Country</span>
                        <div class="clearfix"></div>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Cycling" />Cycling</span>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Dog Allowed" />Dogs Allowed</span>
                        <div class="clearfix"></div>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Duathlon" />Duathlon</span>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Fun Run" />Fun Run</span>
                        <div class="clearfix"></div>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Mountain Biking" />Mountain Biking</span>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Road Run" />Road Run </span>
                        <div class="clearfix"></div>
                        <span class="col-md-6 checkbox"><input type="checkbox" name="type[]" value="Triathlon" />Triathlon</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                 
                <div class="form-group">
                    <label class="col-md-12"><strong>Location</strong> <span class="blue">-Where is this club located?</span></label>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Club Address/Venue<span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="Street Address" name="street_address" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                 <div class="form-group">
                    <label class="col-md-3">City / Town <span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="Suburb Town or City" name="city" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                 <div class="form-group">
                    <label class="col-md-3">Province<span class="required">*</span></label>
                    <div class="col-md-7"><select name="province"><option>Select Province</option></select></div>
                    <div class="clearfix"></div>
                
                </div>
                <hr />
                 
                <div class="form-group">
                    <label class="col-md-12"><strong>Time Trials</strong> <span class="blue">-Does your club have a weekly trial(Optional)</span></label>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Day / Time<span class="required">*</span></label>
                    <div class="col-md-7">
                        <div class="col-md-6">
                            <select name="day[]">
                                <option>Select Day</option>
                                <option value="Mondays">Mondays</option>
                                <option value="Tuesdays">Tuesdays</option>
                                <option value="Wednesdays">Wednesdays</option>
                                <option value="Thursdays">Thursdays</option>
                                <option value="Fridays">Fridays</option>
                                <option value="Saturdays">Saturdays</option>
                                <option value="Sundays">Sundays</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="time[]">
                                <option>Select Time</option>
                                <?php for($i=4;$i<=22 ;$i=$i+.5)
                                    {
                                        if($i<12)
                                        {
                                            $time = $i.":00 am";
                                            if(str_replace('.5',":30 am",$i)!=$i)
                                                $time = str_replace('.5',":30 am",$i);
                                        }
                                        elseif($i==12 || $i ==12.5)
                                        {
                                            $time = $i.":00 pm";
                                            if(str_replace('.5',":30 pm",$i)!=$i)
                                            $time = str_replace('.5',":30 pm",$i);
                                        }    
                                        elseif($i>=13)
                                        {
                                            $time = ($i-12).":00 pm";
                                            if(str_replace('.5',":30 pm",$i)!=$i)
                                            $time = str_replace('.5',":30 pm",$i-12);
                                        }
                                            
                                        echo "<option value=".$time.">".$time."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                
                </div>
                 <div class="form-group">
                    <label class="col-md-3">Description<span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="Optional description" name="city" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                 <hr />
                 
                <div class="form-group">
                    <label class="col-md-12"><strong>Contact Details</strong> <span class="blue">-Complete the contact details below</span></label>
                    <div class="clearfix"></div>
                </div>
                
                <hr />
                <div class="form-group">
                    <label class="col-md-3">Contact Person<span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="Street Address" name="street_address" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                <hr />
                <div class="Contact_Number">
                    <div class="form-group">
                        <label class="col-md-3">Contact Number <span class="required">*</span></label>
                        <div class="col-md-7"><input type="text" class="form-control" placeholder="Contact Number" name="contact_number[]" value="<?php //echo $member->fname;?>" /></div>
                        <input type="button" value="+Add" class="btn btn-default col-md-1" onclick="addmore('Contact_Number');"/>
                        <div class="clearfix"></div>
                    
                    </div>
                </div>
                <div class="Contact_Email">
                    <div class="form-group ">
                        <label class="col-md-3">Contact E-mail <span class="required">*</span></label>
                        <div class="col-md-7"><input type="text" class="form-control" placeholder="Contact email" name="contact_email[]" value="<?php //echo $member->fname;?>" /></div>
                        <input type="button" value="+Add" class="btn btn-default col-md-1" onclick="addmore('Contact_Email');" />
                        <div class="clearfix"></div>
                    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3">Website <span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="http://" name="city" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                <div class="form-group">
                    <label class="col-md-3">Facebook page <span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="http://" name="city" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
                <div class="form-group">
                    <label class="col-md-3">Twitter Page <span class="required">*</span></label>
                    <div class="col-md-7"><input type="text" class="form-control" placeholder="http://" name="city" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                </div>
  
</form>
            
        </div>
        <div class="clearfix"></div>
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

    <script>
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
    //Add more
    function addmore(div)
    {
        
        $("."+div).append('<div class="form-group">'+
                        '<label class="col-md-3">'+div.replace("_",' ')+'<span class="required">*</span></label>'+
                        '<div class="col-md-7"><input type="text" class="form-control" placeholder="'+div.replace("_",' ')+'" name="'+div+'[]" value="" /></div>'+
                        '<input type="button" value="Remove" class="btn btn-danger" onclick="$(this).parent().remove();"  />'+
                        '<div class="clearfix"></div>'+
                
                    '</div>');
        
    }
    
    $(function(){
			$( "#profile-detail" ).validate( {
			 onkeyup: false,
				rules: {
					fname: "required",
					lname: "required",
                    d_ob: "required",
                    m_ob: "required",
                    y_ob: "required",
                    gender: "required",
                    username: 'required',
					password_signup: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password_signup"
					},
					email: {
						required: true,
						email: true,
                        remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=email",
                            type: "post",
                            data: {
                              email: function() {
                                return $( ".profile_email" ).val();
                                }

					       }
                        }
                    },
                    username: {
                        required: true,
                        remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=username",
                            type: "post",
                            data: {
                              username: function() {
                                return $( ".username" ).val();
                                }

					       }
                        }
                    },
					agree: "required"
				},
                groups: {
                    y_ob: "d_ob m_ob y_ob"
                },
				messages: {
					fname: "Input a firstname",
					lname: "Input a lastname/Surname",
					password_signup: {
						required: "Input a password you will remember",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: {
					    required:"Input an email address",
                        email: "Input a valid email address",
                        remote: $.validator.format("{0} is already taken.")
                    },
                	username: {
					    required:"Input a username",
                        remote: $.validator.format("{0} is already taken.")
                    },
					agree: "Please accept our policy",
                    y_ob: "Please select a date of birth",
                    m_ob: "Please select a date of birth",
                    d_ob: "Please select a date of birth",
                    gender: "Please select a gender"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
                    
					error.addClass( "help-block" );

					if ( element.attr( "name" ) == "d_ob" || element.attr( "name" ) == "m_ob" || element.attr( "name" ) == "y_ob" ) {
						error.insertAfter( ".y_ob" );
					}
                    else if(element.prop('type')=== 'radio')
                    {
                        error.insertAfter( ('.f_gender'));
                    }
                     else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group, .dobs" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group, .dobs" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
	</script>