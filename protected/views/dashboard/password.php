<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-9 right-content profile_detail">
    <div class="col-md-12">
        <h1>PASSWORD</h1>
        <strong><span class="blue">Manage your Password.</span> </strong>
        <br/>
        You can change your password here at anytime.
    </div>
    <div class="clearfix"></div>
    <hr />
      <form action="<?php echo Yii::app()->request->baseUrl;?>/dashboard/password" id="change_password" method="post">
        <div class="form-group">
            <label class="col-md-4"><b>Old Password:</b></label>
            <div class="col-md-6"><?php echo $password;?></div>
            <div class="clearfix"></div>
        </div>
        <hr />
        <div class="form-group ">
            <label class="col-md-4">Password <span class="required">*</span></label>
            <div class="col-md-6">
                <input type="password" name="password" id="password_signup" placeholder="New Password" class="form-control" />
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <label class="col-md-4">Confirm New Password <span class="required">*</span></label>
                <div class="col-md-6">
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" class="form-control" />
                </div>
                <div class="clearfix"></div>
            
        </div>
    <hr />
    
    <div class="form-group center" style="margin-right: 32px;">

        <input type="submit" name="submit" value="Save Changes" class="btn btn-default bgblue " />
        <input type="button" value="Cancel" class="btn btn-default " />
 
    </div>
    </form>
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