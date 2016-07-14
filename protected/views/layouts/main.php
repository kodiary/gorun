<!DOCTYPE HTML>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Anwar Ali" />
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/fa/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filter.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    
	<title>Home - GoRun</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
</head>

<body>

<div class="wrapper">
    <div class="header">
        <a class="logo" href="<?php echo Yii::app()->request->baseUrl; ?>">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="LOGO" />
        </a>
        <div class="left navigations">
        
        <div class="nav col-md-6">
            <ul>
                <li><a href="#" class="active">Run</a></li>
                <li><a href="#">Bike</a></li>
                <li><a href="#">Tri</a></li>
                <li class="last"><a href="#">Buy</a></li>
                <li class="cart"><span class="cart-count"><a href="#">0</a></span></li>
            </ul>
            
        </div>
       
        <div class="subnav col-md-6 right">
        <?php if(Yii::app()->user->isGuest){?>   
        <!-- IF not logged in -->
        <div class="registration">Not a member? <a href="<?php echo Yii::app()->request->baseUrl; ?>/signup" class="blue">Join now</a> <a href="#" class="btn btn-default bgblue ml15" data-toggle="modal" data-target="#loginModal">Login</a></div>
        <?php }else
        {?>
         <!--IF logged in have the code below uncommented -->
        
            <ul>
                <li><a href="<?php echo Yii::app()->request->baseUrl;?>/dashboard">My profile</a></li>
                <li><a href="#">My results <span class="blue">45</span></a></li>
                <li><a href="#">Credits <span class="blue">0.00</span></a></li>
                <li class="last"><a href="<?php echo Yii::app()->request->baseUrl;?>/member/logout">Logout</a></li>
            </ul>
          <?php }?>
        
        </div>
        
        
        
        
        <div class="clearfix"></div>
        
        
        
        </div>
        <div class="clearfix"></div>
        
        
    </div>
    <div class="mainnav">
        <ul class="anchors">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Races</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Race Ratings</a></li>
            <li><a href="#">Running clubs</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Submit Results</a></li>
        </ul>
    </div>
    <div class="row maindiv">
    <?php if (Yii::app()->user->hasFlash('error') || Yii::app()->user->hasFlash('success')){?>
    
    <div class="col-md-12" style="margin-top: 10px;">
      <?php if (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo Yii::app()->user->getFlash('error'); ?>
        </div><!-- /.flash-error -->
         <?php endif;
          if(Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div><!-- /.flash-success -->
        <?php endif;?>
    </div>
    <?php }?>
    <?php echo $content; ?>
        
    </div>
    <div class="footer">
        <div class="footerin">
            <div class="logo_footer col-md-2 nopadd">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_footer.png" alt="LOGO" />
            </div>
            <div class="footer_links">
            <div class="footer_racetype col-md-2 nopaddleft">
                <ul class="col-md-7 nopadd">
                    <li><a href="#">Run</a></li>
                    <li><a href="#">Bike</a></li>
                    <li><a href="#">Tri</a></li>
                    <li><a href="#">Buy</a></li>
                </ul>
            </div>
            <div class="col-md-3 quick-link">
                <h2>For the South African Athelete</h2>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Advertise</a></li>
                    <li><a href="#">Race Result</a></li>
                    <li><a href="#">Leaderboard</a></li>
                    <li><a href="#">Clubs</a></li>
                </ul>
            </div>
            <div class="quick-link col-md-6">
                <h2>The Races</h2>
                <ul class="">
                    <li class="col-md-6"><a href="#">Guateng <span class="blue">56</span></a></li>
                    <li class="col-md-6"><a href="#">Northern West Province <span class="blue">15</span></a></li>
                    <li class="col-md-6"><a href="#">Western Cape <span class="blue">15</span></a></li>
                    <li class="col-md-6"><a href="#">Limpopo <span class="blue">0</span></a></li>
                    <li class="col-md-6"><a href="#">KwaZulu Natal <span class="blue">10</span></a></li>
                    <li class="col-md-6"><a href="#">Mpumalanga <span class="blue">15</span></a></li>
                    <li class="col-md-6"><a href="#">Northern Cape <span class="blue">6</span></a></li>
                    <li class="col-md-6"><a href="#">Free State <span class="blue">8</span></a></li>
                    <li class="col-md-6"><a href="#">Eastern cape <span class="blue">7</span></a></li>
                    <li class="col-md-6"><a href="#">International <span class="blue">15</span></a></li>
                </ul>
            </div>
            <div class="col-md-1 footer_social nopadd">
            <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/facebook.png" alt="facebook" /></a>
            <a href="#"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/twitter.png" alt="twitter" /></a>
            </div>
            <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="footer-low">
        <div class="footer-low-in">Copyright 2016 - Designed and developed by In-Detail Advertising - Contact us for advertising opportunities.</div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<form class="login-form" method="post" novalidate="novalidate">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Member Login</h4>
      </div>
      <div class="modal-body">
        <!-- Normal -->      
        <?php $this->renderPartial('/common/login');?>
        </div>
      <div class="modal-footer">
        Not a member yet? <a href="<?php echo Yii::app()->request->baseUrl; ?>/signup" class="blue">Join now for free.</a>
      </div>
    </div>
  </div>
  </form>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js" type="text/javascript"></script>
</body>
</html>
<script>
/*
document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                if(e.target.getAttribute('type')=='email')
                {
                   
                    $('.failed_email').show();
                    $('.failed_email').find('input').focus();
                    $('.main_email').find('input').attr('disabled','disabled');
                    $('.main_email, .success_email').find('input').removeAttr('required');
                    $('.failed_email, .success_email').find('input').val(e.target.value);
                    $('.main_email').hide();
                    $('.success_email').hide();
                    
                }
                if(e.target.getAttribute('type')=='password')
                {
                   $('.password').addClass('has-error');
                   $('.failed_pwd').show();
                  
                }
               
                //e.target.setCustomValidity("This field cannot be left blank");
                
            }
            else
            {
                if(e.target.getAttribute('type')=='password')
                {
                   $('.password').removeClass('has-error');
                   $('.failed_pwd').hide();
                  
                }
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                if(e.target.getAttribute('type')=='email')
                {
                   
                    $('.failed_email').show();
                    $('.failed_email').find('input').focus();
                    $('.main_email').find('input').attr('disabled','disabled');
                    $('.main_email, .success_email').find('input').removeAttr('required');
                    $('.failed_email, .success_email').find('input').val(e.target.value);
                    $('.main_email').hide();
                    $('.success_email').hide();
                    
                }
                if(e.target.getAttribute('type')=='password')
                {
                   $('.password').addClass('has-error');
                   $('.failed_pwd').show();
                  
                }
                
                
                //e.target.setCustomValidity("This field cannot be left blank");
                
            }
            else
            {
                
                if(e.target.getAttribute('type')=='email')
                {
                    $('.main_email').find('input').attr('disabled','disabled');
                    $('.success_email').show();
                    $('.success_email').find('input').focus();
                    $('.failed_email').hide();
                    $('.main_email').hide();
                    $('.main_email, .failed_email').find('input').removeAttr('required');
                    $('.failed_email, .success_email').find('input').val(e.target.value);
                }
                if(e.target.getAttribute('type')=='password')
                {
                    $('.password').removeClass('has-error');
                    $('.failed_pwd').hide();
                }
            }
        };
    }
})*/
$(function(){
    //alert("<?php echo Yii::app()->controller->id;?>");
    $.validator.setDefaults({
		submitHandler: function() {
			
		}
	});
    
    $( ".login-form" ).validate( {
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
				
					LoginForm_username: "Email or Username is not valid.",
					
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
                      var data = $(form).serialize();
                    
                    $.ajax({
                        type:"post",
                        url:"<?php echo Yii::app()->request->baseUrl; ?>/member/login",
                        data:data,
                        success: function(msg){
                                   if(msg=='OK')
                                   {
                                   
                                        window.location.href ="<?php echo Yii::app()->request->baseUrl; ?>/dashboard";
                                        //$('.error-login').html('Invalid Username/Email or Password');
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
	
        
    
});
</script>