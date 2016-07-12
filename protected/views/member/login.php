<div class="sidebar col-md-3">
  
</div>
<div class="col-md-9 right-content profile_detail">
    <div class="col-md-12">
        <h1>Email Address Confirmed Successfully.</h1>
        <strong><span class="blue">Your email address has been verified.</span> </strong>
        <br/>
        Please use the form to login for the first time.
    </div>
    <div class="clearfix"></div>
   
    <div class="col-md-6">
      <form class="login-form" method="post" novalidate="novalidate">
        <hr />
        <?php $this->renderPartial('/common/login');?>
    </form>
    </div>
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
</script>