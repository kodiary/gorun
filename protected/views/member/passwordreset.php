<div class="col-md-12">
<div class="breadcrumb">
    <a class="home_bread" href="<?php echo Yii::app()->request->baseUrl; ?>"><span class="fa fa-home"></span></a><img class="right-point" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint.png" />
    register or login 
    <img class="right-point_w" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint_w.png" />
</div>
</div>
<div class="content registration">
    <form action="<?php echo Yii::app()->request->baseUrl;?>/member/passwordreset" method="post" id="Pwdreset">
        <div class="col-md-4">
        <h2 class="blue">Password reset</h2>
        <hr />
        
        <div class="form-group row">
            <div>
                <label class="control-label col-md-12">Email</label>
            </div>
            <div class="col-sm-12">
                <input type="email" placeholder="Email or Username" name="email" class="form-control" />
            </div>
            <div class="clearfix"></div>
        </div>
        <div>
            <input type="submit" value="REQUEST PASSWORD RESET" class="btn btn-default bgblue btn-lg fullwidth" name="btnRemindPass" />
        </div>
    </div>
    </form>
</div>
<script>
$(function(){
    $( "#Pwdreset" ).validate( {
				rules: {
					email: {
						required: true,
						email: true,
                        /*remote: {
                            url: "<?php echo Yii::app()->request->baseUrl;?>/member/checkemail?type=email",
                            type: "post",
                            data: {
                              email: function() {
                                return $( ".register_email" ).val();
                                }

					       }
                        }*/
                    },
					
				},
                messages: {
					email: {
					   required:"Input a valid email address",
                        email: "Input a valid email address",
                        remote: $.validator.format("{0} is already taken.")
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
					$( element ).parents( ".col-sm-12, .dobs" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-12, .dobs" ).addClass( "has-success" ).removeClass( "has-error" );
				},
                
			} );

			
		} );
	
</script>