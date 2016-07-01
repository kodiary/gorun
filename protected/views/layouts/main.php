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
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bmodal.js" type="text/javascript"></script>
	<title>Home - GoRun</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
</head>

<body>

<div class="wrapper">
    <div class="header">
        <div class="logo">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="LOGO" />
        </div>
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
         <!--IF logged in have the code below uncommented -->
        <!--
            <ul>
                <li><a href="#">My profile</a></li>
                <li><a href="#">My results <span class="blue">45</span></a></li>
                <li><a href="#">Credits <span class="blue">0.00</span></a></li>
                <li class="last"><a href="#">Logout</a></li>
            </ul>
            -->
            
        <!-- IF not logged in -->
        <div class="registration">Not a member? <a href="#" class="blue">Join now</a> <a href="#" class="btn btn-default bgblue ml15" data-toggle="modal" data-target="#loginModal">Login</a></div>
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
        <div class="sidebar col-md-3">
            <h2>Race finder</h2>
            <div class="filter">
                <div class="fil-group">
                <a href="javascript:void(0)" class="fil">
                Race type
                 <span class="fa fa-caret-down"></span>
                </a>
                <ul class="option">
                    <li><a href="javascript:void(0);">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                </ul>
                </div>
                <div class="fil-group">
                    <a href="javascript:void(0)" class="fil">All Provinces <span class="fa fa-caret-down"></span></a>
                    <ul class="option">
                    <li><a href="javascript:void(0)">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                    </ul>
                </div>
                <div class="fil-group">
                    <a href="javascript:void(0)" class="fil">All Distances <span class="fa fa-caret-down"></span></a>
                    <ul class="option">
                    <li><a href="javascript:void(0)">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                    </ul>
                </div>
                <div class="fil-group">
                    <a href="javascript:void(0)" class="fil">All Months <span class="fa fa-caret-down"></span></a>
                    <ul class="option">
                    <li><a href="javascript:void(0)">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                    </ul>
                </div>
                <div class="fil-group">
                    <a href="javascript:void(0)" class="fil">2015 <span class="fa fa-caret-down"></span></a>
                    <ul class="option">
                    <li><a href="javascript:void(0)">Option 1</a></li>
                    <li><a href="javascript:void(0)">Option 2</a></li>
                    <li><a href="javascript:void(0)">Option 3</a></li>
                    </ul>
                </div>
                <div class="gap"></div>
                <a href="javascript:void(0)" class="btn btn-inverse btn-lg">Search</a>
            </div>
            <a href="#" class="calendar-view">Calendar View &nbsp; <span class="fa fa-calendar"></span></a>
            <a href="#" class="submit-event">Submit your event &nbsp; <span class="fa fa-plus"></span></a>
        </div>
        <div class="col-md-9 right-content">
            <div class="banner">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/banner.jpg" />
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="listing">
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/events/noimg.png"/></div>
                <div class="txt">
                    <h3>BROOK'S DARK RUN, THE RUN DEAD NIGHT TRAIL RUN - 8 & 4 KM</h3>
                    <span class="datetime">Thurs <strong>24 July, 2016</strong></span> 
                    <span class="racetag">GP</span>
                    <div class="clearfix"></div>
                    <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <hr />
            <a class="btn btn-default btn-lg loadmore">Load More</a>
            
        </div>
        <div class="clearfix"></div>
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
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Member Login</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label class="col-md-12">Email</label>
            <div class="col-md-12"><input type="text" name="email" placeholder="Email or Username" class="form-control" /></div>
            <div class="clearfix"></div>           
            
        </div>
        
        <div class="form-group">
            <label class="col-md-12">Password</label>
            <div class="col-md-12"><input type="password" name="password" placeholder="Password" class="form-control" /></div>
            <div class="clearfix"></div>            
            
        </div>
        
        <div class="form-group">
            
            <div class="col-md-12"><input type="submit" name="submit" value="Login to your account" class="form-control btn btn-default bgblue" /></div>
            <div class="clearfix"></div>
            <div class="remember">
                <input type="checkbox" name="remember" /> Remember Me
            </div>
            <div class="clearfix"></div>            
            
        </div>
        
      </div>
      <div class="modal-footer">
        Not a member yet? <a href="#" class="blue">Join now for free.</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>