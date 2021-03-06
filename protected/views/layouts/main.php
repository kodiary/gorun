<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if (isset($_GET['view'])) {
    $seo = CommonClass::getSeoByPage('generic');
    $this->metaDesc = $seo['desc'];
    $this->metaKeys = $seo['keys'];

    $view = $_GET['view'];
    if ($view == 'advertise') {
        $this->pageTitle = "Advertise - " . $seo['title'];
    }
    if ($view == 'privacy') {
        $this->pageTitle = "Privacy Policy - " . $seo['title'];
    }
    if ($view == 'terms') {
        $this->pageTitle = 'Terms & Conditions - ' . $seo['title'];
    }
}
?>
<?php
if (!empty($this->metaDesc)) {
?>
<meta name="description" content="<?php echo $this->metaDesc; ?>" />
<?php
}
?>
<?php
if (!empty($this->metaKeys)) {
?>
<meta name="keywords" content="<?php echo $this->metaKeys; ?>" />
<?php
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/fa/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/jqueryui/jquery-ui.min.css" rel="stylesheet" type="text/css" />    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    
    <title>Home - GoRun</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 
    
    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/jqueryui/jquery-ui.min.js" type="text/javascript"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filter.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/timepicki.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/timepicki.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.Jcrop.min.js"></script>
    
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/slippery/dist/slippry.min.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/slippery/dist/slippry.css" />
    
    
</head>

<body>
<div id="preloader"></div>
<style>
#preloader { display:none;position: fixed;
     left: 0; top: 0; z-index: 999999; width: 100%; height: 100%;
     overflow: visible; opacity:0.6;
     background: #333 url('<?php echo Yii::app()->request->baseUrl; ?>/images/main-loading.gif') no-repeat center center; }
</style>
<script>
 var FB;
    $(document).ready(function() {
        
  $.ajaxSetup({ cache: true });
  $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
    FB.init({
        <?php if($_SERVER['SERVER_NAME'] == 'localhost'){?>
      appId      : '1311325642274761',
      <?php }else{?>
      appId      : '1778078242453264',
      <?php }?>
      xfbml      : true,
      oauth      : true,
      version: 'v2.8' // or v2.1, v2.2, v2.3, ...
    });     
    
    
  });
 });
   function checkLoginState() {
    FB.login(function(response) {
            if (response.authResponse) {
                //resolve(response.authResponse.accessToken);
                 testAPI();
            } else {
             console.log('User cancelled login or did not fully authorize.');
            }
            },{'scope':'email',return_scopes: true}
        );
  FB.getLoginStatus(function(response) {
    
    statusChangeCallback(response);
  });
}

function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {

        FB.login(function(response) {
            if (response.authResponse) {
                //resolve(response.authResponse.accessToken);
                 testAPI();
            } else {
             console.log('User cancelled login or did not fully authorize.');
            }
            },{'scope':'email',return_scopes: true}
        );

    }
  }
  function testAPI() {
    $('#preloader').show();
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=email,name,first_name,last_name,gender', function(response) {
        console.log(response);
        
        $.ajax({
            type: 'post',
            url: '<?php echo Yii::app()->request->baseUrl; ?>/hybridauth/default/fblogin?provider=facebook&fid='+response.id+
                    '&email='+response.email+'&gender='+response.gender+'&first_name='+response.first_name+'&last_name='+response.last_name,
            success: function(msg){
                //alert(msg);
               window.location.href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard";
            }
        })
      //console.log(response);
    
    });
  }
/*
  window.fbAsyncInit = function() {
    FB.init({
      <?php 
      if($_SERVER['SERVER_NAME'] == 'localhost'){?>
      appId      : '1311325642274761',
      <?php }else{?>
      appId      : '1778078242453264',
      <?php }?>
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8',
      
    });
    FB.AppEvents.logPageView();  
    
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
  */
</script>

<div id="status">
</div>
<?php $this->widget('application.extensions.email.debug'); ?>
<div class="wrapper">
    <div class="headerbg">
    <div class="header">
        <a class="logo" href="<?php echo Yii::app()->request->baseUrl; ?>">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="LOGO" />
        </a>
        <div class="left navigations">
        
        <div class="nav col-md-6">
            <ul>
            <?php
            $con = Yii::app()->controller->id;
            if($con == 'bike')
            $act = 2;
            else
            if($con=='triathlon')
            $act = 3;
            else
            if($con=='run'){
            $act =1;
            }
            else
            {
                $con = '';
                $act = 0;
            }
            ?>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/run" class="<?php if($act==1){?>active<?php }?>">Run</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/bike" class="<?php if($act==2){?>active<?php }?>">Bike</a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/triathlon" class="<?php if($act==3){?>active<?php }?>">Tri</a></li>
                <li class="last"><a href="#">Buy</a></li>
                <li class="cart"><span class="cart-count"><a href="#">0</a></span></li>
            </ul>
            
        </div>
       
        <div class="subnav col-md-6 right">
        <?php if(Yii::app()->user->isGuest){?>   
        <!-- IF not logged in -->
        <div class="registration">Not a member? <a href="<?php echo Yii::app()->request->baseUrl; ?>/signup" class="blue">Join now</a> 
        <a href="#" class="btn btn-default bgblue ml15" data-toggle="modal" data-target="#loginModal">Login</a></div>
        <?php }else
        {?>
         <!--IF logged in have the code below uncommented -->
        
            <ul>
                <li><a href="<?php echo Yii::app()->request->baseUrl;?>/dashboard">My profile</a></li>
                <li><a href="#">My results <span class="blue"><?php echo EventResult::model()->countByAttributes(['user_id'=>Yii::app()->user->id]);?></span></a></li>
                <li><a href="#">Credits <span class="blue">0.00</span></a></li>
                <li class="last"><a href="<?php echo Yii::app()->request->baseUrl;?>/member/logout">Logout</a></li>
            </ul>
          <?php }?>
        
        </div>
        
        
        
        
        <div class="clearfix"></div>
        
        
        
        </div>
        <div class="clearfix"></div>
        
        
    </div>
    </div>
    <div class="mainnav">
        <ul class="anchors">
            <?php if($act==1){?><li><a href="<?php echo Yii::app()->request->baseUrl; ?>" class="active">Home</a></li><?php }?>
            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/<?php echo $con;?>">Races</a></li>
            <?php
            if(Yii::app()->controller->id=='events' && Yii::app()->controller->action->id == 'view')
            {?>
            <li><a class="anchor1" href="javascript:void(0);">Results</a></li>
            <li><a class="anchor2" href="javascript:void(0);">Race Ratings</a></li>
            <?php }
            if($con)
            {
                ?>
                
            <li><a href="<?php echo Yii::app()->request->baseUrl;?>/clubs/category/<?php echo $con;?>">Running clubs</a></li>
            <?php
            }
            ?>
            <li><a href="#">News</a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/events/submitResults">Submit Results</a></li>
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
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/run">Run</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/bike">Bike</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/triathlon">Tri</a></li>
                    <li><a href="#">Buy</a></li>
                </ul>
            </div>
            <div class="col-md-3 quick-link">
                <h2>For the South African Athelete</h2>
                <ul>
                    <li><a href="<?php echo Yii::app()->request->baseUrl;?>/about">About Us</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl;?>/advertise">Advertise</a></li>
                    <li><a href="#">Race Result</a></li>
                    <li><a href="#">Leaderboard</a></li>
                    <li><a href="<?php echo Yii::app()->request->baseUrl;?>/clubs/type">Clubs</a></li>
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
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58255cf946be96f0"></script>


</body>
</html>

<script>
$(function(){
    
    $('.anchor1').click(function(){
        $(".race-result-a").click();
        $('html,body').animate({
                scrollTop: $(".race-result-a").offset().top},
                'slow');
    })
    $('.anchor2').click(function(){
        $(".ratinganchor").click();
        $('html,body').animate({
                scrollTop: $(".ratinganchor").offset().top},
                'slow');
    })
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
                      var data = $('.login-form').serialize();
                    
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
	
        
    
});
</script>