<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<div class="sidebar col-md-3">
          <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
        </div>
        <div class="col-md-9 right-content profile_detail">
            
                <h1>ADD YOUR CLUB</h1>
                <span>
                    Add your club details below. You can edit these details at any time.<br />
                    Please note this is subject to approval before being posted live.
                </span>
            
            <div class="clearfix"></div>
            
            <hr />
            
            <form action="<?php echo Yii::app()->request->baseUrl;?>/clubs/create" id="club-detail" method="post">
                
                <div class="form-group white">
                    <label class="col-md-12">CLUB NAME</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Your Club Name" name="title" value="<?php //echo $member->fname;?>" />
                        <span class="blue"><strong>Vanity URL:http://www.gorun.co.za/clubs/your-club-name</strong></span>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                  <div class="form-group white">

                    
                    <label class="col-md-12">CLUB ACTIVITIES<br /></label>
                   
                    <div class="col-md-12">
                        <?php 
                        foreach($events as $event)
                        {?>
                            <div class="col-md-6 checkboxes">
                                <label class="control control--checkbox"><?php echo $event->title;?>
                                  <input type="checkbox" name="type[]" value="<?php echo $event->id;?>"/>
                                  <div class="control__indicator"></div>
                                </label>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                            
                        <?php
                            
                        }?>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="types"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">CLUB DETAILS<br /></label>
                    <div class="col-md-12">Tell us about your club.Limited to 600 characters<span class="blue">-You have <span class="count_letter">600</span> left</span></div>
                    <div class="col-md-12"><textarea class="form-control description" name="description"><?php echo $model->description;?></textarea></div>
                    <div class="clearfix"></div>
                    <div class="club_desc"></div> 
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Club Logo (O<span style="text-transform: lowercase;">ptional</span>)
                    <br /><span class="blue">Include a club logo or photo</span></label>
                    <div class="clearfix"></div>
                        <div class="profilepic col-md-12">
                        <div class="club_img " id="upimage_0" style="margin-right: 30px;">
                        <?php
                        if(file_exists(Yii::app()->basePath.'/../images/frontend/thumb/'.$member->logo) && $member->logo)
                        {
                            $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->logo;
                        }
                        else
                        {
                            $img_url='';    
                        }
                        if($img_url){?>
                        <img src="<?php echo $img_url;?>"/>
                        <?php }
                        ?>
                        </div>
                        <div class="col-md-6 picact" style="margin-top: 20px;">
                        <?php echo $this->renderPartial('application.views.gallery._addImage',array('member'=>$member,'type'=>'club')); ?>
                        
                        
                      
            <?php
                        
            //crop button
             echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
                        $this->createUrl('gallery/cropPhoto?height=180&width=220'),
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
                        array('id'=>'crop_'.$member->id,'class'=>'btn btn-crop','onclick'=>'$("#crop_'.$member->id.'").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                     <div class="clearfix"></div>   
                    </div>
                    <div class="clearfix"></div>
                </div>
                 <div class="form-group white">
                    <h2 class="col-md-12">Cover Photo <span class="grey">(Recomended)</span></h2>
                    
                     <div class="col-md-12 profilepic">
                        <div class="profile_cover" id="upimage_1">
                        <?php
                        if($member->cover && (Yii::app()->basePath.'/../images/frontend/thumb/'.$member->cover))
                        {
                            $img_url=Yii::app()->baseUrl.'/images/frontend/thumb/'.$member->cover;
                            echo '<img src="'.$img_url.'"/>';
                        }
                        
                        ?>
                            
                        </div>
                    <div class="col-md-12 picact">
                    <?php echo $this->renderPartial('application.views.gallery._addImagecover',array('member'=>$member,'type'=>'member_cover','id'=>1)); ?>
                        
                      
            <?php
                        
            //crop button
             echo CHtml::ajaxButton('Crop',
                        $this->createUrl('gallery/cropPhoto?height=220&width=760&crop_cover=cover'),
                         array( //ajax options
                         'data'=>array('fileName'=>"js:function(){ return $('.uploaded_cover').val()}",'id'=>$member->id),
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
                                      $('#crop1_".$member->id."').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop1_'.$member->id,'class'=>'btn btn-default','onclick'=>'$("#crop1_'.$member->id.'").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-danger" onclick="return confirm_delete('Are you sure that you want to remove the image?'); ">Remove</a><br />
                    </div>
                        
                    
                   
                </div>
                 <div class="clearfix"></div>
            </div>
    <table id="address" style="display: none;">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"></input></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"></input></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"></input></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"></input></td>
      </tr>
    </table>

                <div class="form-group white">
                    <label class="col-md-12">Location<br /><span class="blue">Where is this club located?</span></label>
                      <div class="form-group">
                        <div class="col-md-3">Your location<span class="required">*</span></div>
                        <div class="col-md-7">
                            <select name="province" class="form-control" onchange='codeAddress();' id="Company_province">
                                <option value="">Select Province</option>
                        <?php $provinces = Province::model()->findAll();
                            foreach($provinces as $province){?>
                                <option value="<?php echo $province->id;?>"><?php echo $province->name;?></option>
                        <?php }?>
                                
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                  
                    <div class="form-group">
                        <div class="col-md-3">City / Town <span class="required">*</span></div>
                        <div class="col-md-7"><input type="text" id="city" class="form-control" placeholder="Suburb Town or City" name="city" value="<?php //echo $member->fname;?>" onBlur='codeAddress();' /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                <div class="white">
                <div class="form-group ">
                    <label class="col-md-12">CLUB LOCATION (REQUIRED)<br />
                    <span class="blue">Input the venue name or address below to find it on Google Map.Drag pin to desired location if required.</span></label>
                    <div class="col-md-10"><input type="text" id="Company_street_add" class="form-control" placeholder="Enter Venue Name or Street Address" onFocus="geolocate()" name="street_address" value="<?php //echo $member->fname;?>" /></div>
                    
                    <div class="clearfix"></div>
                
                    <div class="form-group" style="display: none;">
                    	<div class="col-md-3">Coordinates</div>
                        <div class="controls col-md-7">
                            <div class="sn_group">
                            	<div class="s1 col-md-3 padding-left-0">
                                    <input type="text" class="form-control" name="latitude" id="Company_latitude" value="<?php echo $model->latitude;?>" placeholder="Latitude" style="width:127px;" onblur="updateMapPinPosition()"/>
                                <?php //echo $form->textField($model, 'latitude',array('placeholder'=>'Latitude','style'=>'','onBlur'=>'updateMapPinPosition();') );?>
                                </div>
                                <div class="s2 col-md-3">
                                    <input type="text" class="form-control" name="longitude" id="Company_longitude" value="<?php echo $model->longitude;?>" placeholder="Longitude" style="width:125px;margin-left:50px;;" onblur="updateMapPinPosition()"/>
                                <?php //echo $form->textField($model, 'longitude',array('placeholder'=>'Longitude','style'=>'width:125px;margin-left:50px;','onBlur'=>'updateMapPinPosition();') ); ?>
                                </div>
                                <div class="clear"></div>
                             </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                
                    <input type="hidden" name="formattedAddress" id="formattedAddress" value=""/>
                    <div class="clearfix"></div>
                </div>
                 
                </div>
                 <div class="form-group"> 
                     <!-- gmap -->
                    <div id="map_canvas" style="width: 100%; height: 300px;"></div>
                    <div class="clearfix"></div>
                  </div>
              
                 
                <!--div class="form-group white">
                    <label class="col-md-12">Time Trials<br /><span class="blue">Does your club have a weekly trial(Optional)</span></label>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-md-3">Day / Time</div>
                        <div class="col-md-7">
                            <div class="col-md-6 padding-left-0">
                                <select name="trial_day" class="form-control">
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
                                <select name="trial_time" class="form-control">
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
                        <div class="col-md-3">Description</div>
                        <div class="col-md-7"><input type="text" class="form-control" placeholder="Optional description" name="trial_desc" value="<?php //echo $member->fname;?>" /></div>
                        <div class="clearfix"></div>
                    
                    </div>
                 </div-->
                 
                <div class="form-group white">
                    <label class="col-md-12">Club Contact Details(Required)<br />
                    <span class="blue">Display contact details of the club</span></label>
                    <div class="Contact_Number">
                        <div class="form-group">
                            <div class="col-md-12">Contact Number</div>
                            <div class="col-md-6"><input type="text" class="form-control" placeholder="Contact Number" name="contact_number" value="<?php //echo $member->fname;?>" /></div>
                            <!--input type="button" value="+Add" class="btn btn-default col-md-1" onclick="addmore('Contact_Number');"/-->
                            <div class="clearfix"></div>
                        
                        </div>
                    </div>
                
                    <div class="Contact_Email">
                        <div class="form-group ">
                            <div class="col-md-12">Email Address (Will display a Contact Button)</div>
                            <div class="col-md-6"><input type="text" class="form-control" placeholder="Contact email" name="contact_email" value="<?php //echo $member->fname;?>" /></div>
                            <!--input type="button" value="+Add" class="btn btn-default col-md-1" onclick="addmore('Contact_Email');" /-->
                            <div class="clearfix"></div>
                        
                        </div>
                    </div>
                    
                  <div class="form-group">
                    <div class="col-md-12">Website Address</div>
                    <div class="col-md-6"><input type="url" class="form-control" placeholder="Organiser Website Address" name="website" value="<?php //echo $member->fname;?>" /></div>
                    <div class="clearfix"></div>
                
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="white form-group">
                    <label class="col-md-12">SOCIAL MEDIA LINKS (OPTIONAL)<br />
                    <span class="blue">These will be displayed as icons on your club page an link to your social media pages</span></label>
                    
                    <div class="form-group">
                        <div class="col-md-12">Facebook page </div>
                        <div class="col-md-6"><input type="url" class="form-control" placeholder="http://" name="fb_page" value="<?php //echo $member->fname;?>" /></div>
                        <div class="clearfix"></div>
                    
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12">Twitter Handle </div>
                        <div class="col-md-6"><input type="url" class="form-control" placeholder="http://" name="twitter_page" value="<?php //echo $member->fname;?>" /></div>
                        <div class="clearfix"></div>
                    
                    </div>
                    
                     <div class="form-group">
                        <div class="col-md-12">Google + Page </div>
                        <div class="col-md-6"><input type="url" class="form-control" placeholder="http://" name="google" value="<?php //echo $member->fname;?>" /></div>
                        <div class="clearfix"></div>
                    
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="white form-group">
                    <label class="col-md-12">Visibility<br />
                    <span class="blue">Events are subject to approval before going live and visible to public.</span></label>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                    <span><strong>PLEASE NOTE:</strong> Submitting a club requires our <br /> approval before it will be displayed live.</span>
                    </div>
                    <div class="col-md-6 padding-left-0">
                    <input type="submit" name="submit" class="btn btn-submit" value="SUBMIT FOR APPROVAL" />
                    </div>
                </div>
                <div class="clearfix"></div>
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
   
$(function(){
    
    CKEDITOR.replace( 'description' );
    CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F5f5f5';
	
};
    
    
})

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
        if(div == 'Contact_Number')
        var type = 'text';
        else
        var type = 'email';
        $("."+div).append('<div class="form-group">'+
                        '<div class="col-md-3">'+div.replace("_",' ')+'<span class="required">*</span></div>'+
                        '<div class="col-md-7"><input type="'+type+'" class="form-control" placeholder="'+div.replace("_",' ')+'" name="'+div+'[]" value="" /></div>'+
                        '<input type="button" value="Remove" class="btn btn-danger" onclick="$(this).parent().remove();"  />'+
                        '<div class="clearfix"></div>'+
                
                    '</div>');
        
    }
    
    $(function(){
			$( "#club-detail" ).validate( {
			 //onkeyup: false,
				rules: {
					title: "required",
					description: "required",
                    street_address: "required",
                    city: "required",
                    province: "required",
                    //contact_person: "required",
                    'type[]':"required",
                   	contact_email: {
						required: true,
						email: true,
                       /* remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=email",
                            type: "post",
                            data: {
                              email: function() {
                                return $( ".profile_email" ).val();
                                }

					       }
                        }*/
                    },
                  
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

					if ( element.attr( "name" ) == "type[]") {
						error.insertAfter( ".types" );
					}
                    else if(element.attr('name')=== 'description')
                    {
                        error.insertAfter( ('.club_desc'));
                    }
                     else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
	</script>