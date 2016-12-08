<script src="//cdn.ckeditor.com/4.5.10/basic/ckeditor.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
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
                                  <input type="checkbox" name="type[]" value="<?php echo $event->id."_".$event->cat_id;?>"/>
                                  <div class="control__indicator"></div>
                                </label>
                                
                            </div>
                            
                            <div class="clearfix"></div>
                            
                        <?php
                            
                        }?>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                    <div class="types"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group white">
                    <label class="col-md-12">CLUB DETAILS<br /></label>
                    <div class="col-md-12">Tell us about your club. Limited to 600 characters<span class="blue"> - You have <span class="count_letter">600</span> left</span></div>
                    <div class="col-md-12"><textarea class="form-control description" name="description" placeholder="Club details here…"><?php echo $model->description;?></textarea></div>
                    <div class="clearfix"></div>
                    <div class="club_desc"></div> 
                </div>
                
                <div class="form-group white">
                    <label class="col-md-12">Club Logo (R<span style="text-transform: lowercase;">ecomended</span>)
                    <br /><span class="blue">Size is 440x440px</span></label>
                    <hr />
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
                                      $('#crop_0').val('Crop');
                                    }",
                        ),
                        array('id'=>'crop_0','class'=>'btn btn-crop','onclick'=>'$("#crop_0").val("loading...");')//html options
            );
            ?><br />
            
                        
                        <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                     <div class="clearfix"></div>   
                    </div>
                    <div class="clearfix"></div>
                </div>
                 <div class="form-group white">
                    <label class="col-md-12">Club Cover Image (R<span style="text-transform: lowercase;">ecomended</span>)
                    <br /><span class="blue">Size is 760x220px</span></label>
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
                     <div class="col-md-4" style="margin-right: 30px;"></div>
                    <div class="col-md-6 picact" >
                        <?php echo $this->renderPartial('application.views.gallery._addImagecover',array('member'=>$member,'type'=>'member_cover','id'=>1)); ?>
                        <?php
                                    
                        //crop button
                            echo CHtml::ajaxLink('<span class="fa fa-crop"></span> Crop',
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
                                                  $('#crop1').val('Crop');
                                                }",
                                    ),
                                    array('id'=>'crop1','class'=>'btn btn-crop','onclick'=>'$("#crop1").val("loading...");')//html options
                                );
                            ?><br />
                        
                                    
                            <a href="javascript:void(0)" class="btn btn-remove" onclick="return confirm_delete('Are you sure that you want to remove the image?'); "><span class="fa fa-times" style="color: #E00000;"></span> Remove</a><br />
                    </div>
                    <div class="clearfix"></div>   
                    
                   
                </div>
                 <div class="clearfix"></div>
            </div>
    <table id="address" style="display: none;">
      <tr>
        <td class="label">Street address</td>
        <td class="slimField"><input class="field" id="street_number"
              disabled="true"/></td>
        <td class="wideField" colspan="2"><input class="field" id="route"
              disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">City</td>
        <td class="wideField" colspan="3"><input class="field" id="locality"
              disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">State</td>
        <td class="slimField"><input class="field"
              id="administrative_area_level_1" disabled="true"/></td>
        <td class="label">Zip code</td>
        <td class="wideField"><input class="field" id="postal_code"
              disabled="true"/></td>
      </tr>
      <tr>
        <td class="label">Country</td>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"/></td>
      </tr>
    </table>

                <div class="form-group white">
                    <label class="col-md-12">PROVINCE (R<span style="text-transform: lowercase;">equired</span>)<br /><span class="blue">Input the province and town the club is situated in.</span></label>
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
                        <div class="col-md-7"><input type="text" id="city" class="form-control" placeholder="Closest City or Town" name="city" value="<?php //echo $member->fname;?>" onBlur='codeAddress();' /></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                <div class="white">
                <div class="form-group ">
                    <label class="col-md-12">CLUB LOCATION (R<span style="text-transform: lowercase;">EQUIRED</span>)<br />
                    <span class="blue">Input the venue name or address below to find it on a Google Map. Drag pin to desired location if required</span></label>
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
                    <label class="col-md-12">Club Contact Details(R<span style="text-transform: lowercase;">equired</span>)<br />
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
                            <div class="col-md-6"><input type="text" class="form-control" placeholder="Contact Email" name="contact_email" value="<?php //echo $member->fname;?>" /></div>
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
                    <label class="col-md-12">SOCIAL MEDIA LINKS (O<span style="text-transform: lowercase;">PTIONAL</span>)<br />
                    <span class="blue">These will be displayed as icons on your club page and link to your social media pages</span></label>
                    
                    <div class="form-group">
                        <div class="col-md-12">Facebook Page </div>
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
                <div class="submit_group">
                    <div class="col-md-6">
                        <strong>PLEASE NOTE: Submitting an event requires our approval before it will be displayed live.</strong>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-submit">SUBMIT FOR APPROVAL</button>
                    </div>
                    <div class="clearfix"></div>
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
    tinymce.init({
        selector:'textarea',
        statusbar: false,
        menubar: false,
        plugins:['hr link pagebreak'],
        toolbar: ['bold italic strikethrough bullist numlist blockquote hr alignleft aligncenter alignright link unlink pagebreak'],
        setup:function(ed) {
           ed.on('keyup', function(e) {
                tmp = ed.getContent({format : 'text'});
                currentLength= tmp.length;
                maximumLength = 600;
                var rem_text = maximumLength-currentLength;
                $('.count_letter').text(rem_text);
                
                if( currentLength > maximumLength )
                {
                    ed.undoManager.add();
                    ed.undoManager.transact(function(){
                        ed.setContent(ed.getContent({format : 'text'}).substring(0,600));
                        $('.count_letter').text(0);
                        ed.undoManager.undo();
                     });
                     //ed.undoManager.undo();
                    //tinyMCE.execCommand("mceRemoveControl", true, 'description');
                    //tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
                }
                else
                {
                    ed.undoManager.clear();
                }
               /*console.log('the event object ', e);
               console.log('the editor object ', ed);
               console.log('the content ', ed.getContent().replace(/<(?:.|\n)*?>/gm, ''));*/
           });
           },
        
    });
    
</script>
    <script>
   
$(function(){
    /*
    CKEDITOR.replace( 'description' );
    CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F5f5f5';
	
};
    */
    
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