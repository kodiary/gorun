<div class="sidebar col-md-2">
  
</div>
<div class="col-md-10 right-content profile_detail">
    <div class="col-md-7 verified center" <?php echo (Yii::app()->user->hasFlash('notverified'))?'':'style="display: none;"';?>>
        <h1 class="font-16">Email Address Confirmed Successfully!</h1>
        <strong><span class="blue">Your email address has been verified!</span> </strong>
        <br/>
        Please use the form to login for the first time...
    </div>
    <div class="clearfix"></div>
   <div class="col-md-1"></div>
    <div class="col-md-5">
      <form class="login-form1" method="post" novalidate="novalidate">
        <hr class="margin-10" />
        <?php $this->renderPartial('/common/login');?>
    </form>
    <div class="center"> 
        Not a member yet? <a href="<?php echo Yii::app()->request->baseUrl;?>/signup" class="blue"><strong>Join now for Free.</strong></a> 
      </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
$(function(){
    $('#password_signup').val("");
			$( "#change_password" ).validate( {
			 onkeyup: false,
				rules: {
				
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password_signup"
					},

				},
                messages: {
				    password: {
						required: "Input a password you will remember",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
				
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
					$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
  $( ".login-form1" ).validate( {
				rules: {
				
					LoginForm_password: "required",
				
					LoginForm_username: {
						required: true,
						email: true
					},
					
				},
				messages: {
					LoginForm_password: {
						required: "Please provide a password",
						
					},
				
					LoginForm_username: "Email or username is not valid.",
					
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".form-group" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
		,
            submitHandler: function(form) {
                      var data = $('.login-form1').serialize();
                    
                    $.ajax({
                        type:"post",
                        url:"<?php echo Yii::app()->request->baseUrl; ?>/member/login",
                        data:data,
                        success: function(msg){
                                   if(msg=='OK')
                                   {
                                        window.location.href ="<?php echo Yii::app()->request->url; ?>"
                                   }
                                   else if(msg == 'Not Verified')
                                   {
                                        $('.error-verification').show();
                                        $('.error-login').hide();
                                   }
                                   else
                                   {
                                        $('.error-login').show();
                                       $('.error-verification').hide();
                                   }
                        }
                    })
                }
           	}
             );
	
</script>