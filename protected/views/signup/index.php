<div class="col-md-12">
    <div class="breadcrumb">
        <a class="home_bread" href="<?php echo Yii::app()->request->baseUrl; ?>"><span class="fa fa-home"></span></a><img class="right-point" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint.png" />
        register or login 
        <img class="right-point_w" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint_w.png" />
    </div>
</div>
<div class="content registration">
    <div class="col-md-4">
    <h2 class="blue">Register Now for Free</h2>
        <hr />
    <form class="row" id="signupForm" novalidate="novalidate" method="post" action="<?php echo Yii::app()->request->baseUrl;?>/member/signup">
        
        <div class="form-group col-md-12">
            <input type="text" name="fname" placeholder="Your first name" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="text" name="lname" placeholder="Your last name / surname" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="text" name="email" placeholder="Your email" class="form-control register_email" />
        </div>
        <div class="form-group col-md-12">
            <input type="password" name="password_signup" id="password_signup" placeholder="Create Password" class="form-control" />
        </div>
        <div class="form-group col-md-12">
            <input type="password" name="confirm_password" placeholder="Repeat Password" class="form-control" />
        </div>
        <div class="form-group dobs">
            <div><h3 class="margin-10 col-md-12"><strong>Date of Birth</strong></h3></div>
            <div class="col-sm-12">
            <select name="d_ob">
            <option value="">DAY</option>
                <?php
                for($i=1;$i<32;$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <select name="m_ob">
            <option value="">MONTH</option>
                <?php
                for($i=1;$i<13;$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <select name="y_ob" style="margin-right: 0;">
            <option value="">YEAR</option>
                <?php
                for($i=(date('Y')-100);$i<date('Y');$i++)
                {
                    ?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                }
                ?>
            </select> 
            <div class="clearfix"></div>
            
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group col-md-12">
            <div class="col-md-6 whitebg f_male">
            <label class="control control--radio">Male
              <input type="radio" name="gender" value="1"/>
              <div class="control__indicator"></div>
            </label>
            </div>
            <div class="col-md-6 whitebg f_gender">
                <label class="control control--radio">Female
                    <input type="radio" name="gender" value="0"/>
                    <div class="control__indicator"></div>
                </label>
            </div>
            <div class="clearfix"></div>
            
        </div>
        <div class="form-group col-md-12">
            <input type="submit" name="signup" value="Go!" class="btn btn-default btnblue2 btn-lg fullwidth" />
        </div>
        <div class="clearfix"></div>
        </form>
        <hr class="" style="margin: 5px!important;" />
        <div class="center col-md-12">
        By creating an account, I have read and<br/> agreed to the <a href="<?php echo Yii::app()->request->baseUrl;?>/terms-and-conditions" class="blue" target="_blank">terms and conditions</a> 
        </div>
        <div class="clearfix"></div>
        <hr class="" style="margin: 10px!important;" />
        <div class="center col-md-12">
        <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/googlesign.png" /></a><br /><br />
        <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/fbsign.png" /></a>
        </div>
        <div class="clearfix"></div>
        <hr />
        <div class="center col-md-12"><strong>Already a Member? <a href="<?php echo Yii::app()->request->baseUrl;?>/member/login" >Login Now</a></strong></div>
    </div>
    <!--div class="col-md-4">
        <h2>Password reset</h2>
        <hr />
        <div class="form-group">
            <div>
                <label class="control-label col-md-12">Email</label>
            </div>
            <div class="col-sm-12">
                <input type="text" placeholder="Email or Username" name="email" class="form-control" />
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
            <input type="submit" value="REQUEST PASSWORD RESET" class="btn btn-default bgblue btn-lg fullwidth" />
        </div>
    </div>
    <div class="col-md-4">
        <h2>Member Login</h2>
        <hr />
        <?php $this->renderPartial('/common/login');?>
        
      <div class="center"> 
        Not a member yet? <a href="#" class="blue">Join now for free.</a> 
      </div>
      
    </div-->
    <div class="clearfix"></div>
</div>
<a class="btn btn-default bgblue verify_popup" data-target="#verify_user" data-toggle="modal" href="#" style="display:none">verify</a>
<div class="modal in" id="verify_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<form class="verify_user" method="post" novalidate="novalidate" action="">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
      <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="flash-error col-md-12">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div><!-- /.flash-success -->
<?php endif; ?>
         <div class="form-group">
            <label class="col-md-12">Pin</label>
            <div class="col-md-12">
                <input type="text" id="code" name="code"  placeholder="Pin from email" class="form-control" required="required" />
                
            </div>
            <div class="clearfix"></div>           
            
        </div>
            <div class="form-group">
            
            <div class="col-md-12">
                <input type="submit" name="Verify" value="Verify" class="form-control btn btn-default bgblue" /></div>
            <div class="clearfix"></div>
            
        </div>
      </div>
    </div>
  </div>
</form>
</div>


<script type="text/javascript">
	$( function () {
	   
	   <?php if(Yii::app()->controller->action->id=='confirmation')
       {?>
              
            $('.verify_popup').click();
            $('#verify_user').addClass('show');
            $('.verify_user').validate();
            
       <?php 
       }
       ?>
	    
		  
			$( "#signupForm" ).validate( {
				rules: {
					fname: "required",
					lname: "required",
                    d_ob: "required",
                    m_ob: "required",
                    y_ob: "required",
                    gender: "required",
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
                                return $( ".register_email" ).val();
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
					fname: "Input a first name",
					lname: "Input a last name / surname",
					password_signup: {
						required: "Input a password you will remember",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Password does not match",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: {
					   required:"Input a valid email address",
                        email: "Input a valid email address",
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
					$( element ).parents( ".col-md-12, .dobs" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-md-12, .dobs" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
	</script>

