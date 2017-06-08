<div class="col-md-12">
    <div class="breadcrumb">
        <a class="home_bread" href="<?php echo Yii::app()->request->baseUrl; ?>"><span class="fa fa-home"></span></a><img class="right-point" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint.png" />
        Register or login
        <img class="right-point_w" src="<?php echo Yii::app()->request->baseUrl; ?>/images/rightpoint_w.png" />
        Choose email & password 
    </div>
</div>
<div class="content registration">
    
    <div class="col-md-5">
    	<h2 class="blue">Choose Email & Password</h2>
        <form class="row"  id="create-user-form" action="<?php echo Yii::app()->request->baseUrl;?>/hybridauth/default/login/?provider=<?php echo $_GET['provider'];?>" method="post">
            <div class="form-group col-md-12">
                <input type="text" name="email" placeholder="Your email" class="form-control register_email" value="<?php echo (isset($user->email))?$user->email:'';?>" />
            </div>
            <div class="form-group col-md-12">
                <input type="password" name="password_signup" id="password_signup" placeholder="Create Password" class="form-control" />
            </div>
            <div class="form-group col-md-12">
                <input type="password" name="confirm_password" placeholder="Repeat Password" class="form-control" />
            </div>
             <div class="form-group col-md-12">
                <input type="submit" name="signup" value="Go!" class="btn btn-default btnblue2 btn-lg fullwidth" />
            </div>
            <div class="clearfix"></div>
        </form>
     </div>
     <div class="clearfix"></div>
</div>
	<?php 
    /*
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'create-user-form',
			'enableAjaxValidation'=>false,
		)); 
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($user); ?>

	<div class="row">
		<?php echo $form->labelEx($user,'username'); ?>
		<?php echo $form->textField($user,'username'); ?>
		<?php echo $form->error($user,'username'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($user,'email'); ?>
		<?php echo $form->textField($user,'email'); ?>
		<?php echo $form->error($user,'email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); */?>

<!--</div> form -->
<script>
$(function(){
    $( "#create-user-form" ).validate( {
				rules: {
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