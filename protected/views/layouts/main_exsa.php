<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/form.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/front_style.css" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->
request->baseUrl; ?>/images/favicon.ico" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js" /></script>
</head>



<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=300753829992400";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php
$background=BackgroundBanner::getActiveBanner();
if($background && $background->image)
{
    if(file_exists(Yii::app()->basePath.'/../images/frontend/full/'.$background->image))
    {
       $imgUrl=$this->createUrl('/images/frontend/full/'.$background->image);
       if($background->link)
       {
            if($background->target==1)$target='_blank';
            else $target='';
       }
       else $target='';
       if($background->color)$background_color="background-color:".$background->color;
       else $background_color="";
?>
<div class="backgroundAd" style="background-image: url(<?php echo $imgUrl;?>);<?php echo $background_color;?>">
<a href="<?php echo $this->createUrl('/banner/background/id/'.$background->id)?>" target="<?php echo $target;?>"></a>
</div>
<?php
    }
}
?>

<div class="head-top">
    <div class="member_area">
    <?php
if (Yii::app()->getModule('company')->user->id) {
?>
     <span><strong>Welcome </strong><?php echo ucwords(Yii::app()->getModule('company')->user->name); ?> / 
     <a href="<?php echo $this->createUrl('/company/info') ?>">View Profile</a></span>
     <a href="<?php echo $this->createUrl('/company/logout'); ?>" class="company-logout">LOG OUT</a>
     <?php
} else {
?>
        <a href="<?php echo $this->createUrl('/company/login'); ?>"><img src="<?php echo
Yii::app()->request->baseUrl; ?>/images/head_top.jpg" /></a>
    <?php
}
?>
    </div>
    <div class="clear">
    </div>
</div>

<div class="container" id="page">
	<div id="header">
    <div class="top_header">
    	<div class="logo">
    		<h1><a href="<?php echo $this->createAbsoluteUrl('/'); ?>"><img src="<?php echo
Yii::app()->request->baseUrl; ?>/images/logo.png" alt="exsa.co.za" /></a></h1>
    	</div><!--#logo-->

        <div class="right_nav_bars">
        <div class="search-sites right">
                <form id="header_search" method="get" action="<?php echo $this->
createUrl('/search'); ?>">
                <input type="text" class="" name="q" id="q1" placeholder="Search EXSA"/>
                <input type="submit" value="go" onclick='if($("#q1").val()=="") return false;' />
                </form>
                </div>
       		<div class="navigations">
            	<ul>
                    <li class="<?php if (Yii::app()->controller->id == 'content' &&
Yii::app()->controller->action->id == 'about')
    echo 'active' ?>">
                        <a href="<?php echo $this->createUrl('/about') ?>">About</a>
                        <ul id="subMember">
                        <?php
    $aboutModel = Contents::displaySubPages('about');
$arr = array();
if ($aboutModel) {
    foreach ($aboutModel as $aboutmenu) {
?>
                            <li><a href="<?php echo $this->createUrl('/about/' .
$aboutmenu->page_seo); ?>"><?php echo
$aboutmenu->title; ?></a></li>
                        <?php }
} ?>
                        </ul>
                    </li>
                    <li class="<?php if (Yii::app()->controller->id == 'events')
    echo 'active' ?>"><a href="<?php echo
$this->createUrl('/events') ?>">Exhibitions</a></li>
                    <li class="<?php if (Yii::app()->controller->id ==
'directory')
        echo 'active' ?>"><a href="<?php echo
$this->createUrl('/directory') ?>">Directory</a></li>
                    <li class="<?php if (Yii::app()->controller->id == 'content' &&
Yii::app()->controller->action->id == 'membership')
            echo 'active' ?>">
                        <a href="<?php echo $this->createUrl('/membership') ?>">Membership</a>
                        <ul id="subMember">
                        <?php
            $membershipmodel = Contents::displaySubPages('membership');
$arr = array();
if ($membershipmodel) {
    foreach ($membershipmodel as $membershipmenu) {
?>
                            <li><a href="<?php echo $this->createUrl('/membership/' .
$membershipmenu->page_seo); ?>"><?php echo
$membershipmenu->title; ?></a></li>
                        <?php }
} ?>
                        </ul>
                    </li>
                    <li class="<?php if (Yii::app()->controller->id == 'jobs')
    echo 'active' ?>"><a href="<?php echo
$this->createUrl('/jobs') ?>">Jobs</a></li>
                    <li class="<?php if (Yii::app()->controller->id ==
'articles')
        echo 'active' ?>"><a href="<?php echo
$this->createUrl('/news') ?>">News</a></li>
                    <li class="<?php if (Yii::app()->controller->id == 'site' &&
Yii::app()->controller->action->id == 'contact')
            echo 'active' ?>"><a href="<?php echo
$this->createUrl('/contact') ?>">Contact</a></li>
                </ul>
                
                <div class="clear"></div>
                <hr style="margin: 2px 0 6px;" />
                <div>
                <?php
                if(Yii::app()->controller->module->id == 'company' && Yii::app()->getModule('company')->user->id)
                {
                  ?>
                  <div class="company-review">Update your Company listing here - update details, post news, photos, or just review your statistics</div>
                  <?php  
                }
                else
                {
                 if (isset($this->breadcrumbs))
		              $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->breadcrumbs, ));
	           }
            ?>
            </div>
            </div><!--#navigations-->
            <div class="clear"></div>
        </div><!--#right_nav_bars-->
        <div class="clear"></div>
    </div><!--#top_header-->
    
	</div><!-- header -->
     <?php if (Yii::app()->controller->module->id == 'company' && Yii::app()->
getModule('company')->user->id) { ?><h3 class="profile-head"><span>Profile:</span><?php echo
ucwords(Yii::app()->getModule('company')->user->name); ?></h3><?php } ?>
    <div class="body_box <?php echo (Yii::app()->controller->module->id == 'company' && Yii::app()->
getModule('company')->user->id)?'members-new':'';?>"><?php echo $content; ?></div>
	<div id="footer">
        <div class="footer_inners">
        <div class="left_logos">
        	<h1><a href="<?php echo $this->createAbsoluteUrl('/'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/foot-logo.jpg" alt="http://www.exsa.co.za" style="height:130px" /></a></h1>
        </div>
        <div class="right_foot_nav">
    <div class="right" style="margin-right: 10px;"> <a href="https://twitter.com/EXSA_SA" target="_blank"><img src="<?php echo
Yii::app()->request->baseUrl; ?>/images/twitter.png" /></a> <a href="http://www.facebook.com/pages/Exhibitions-Events-Association-of-Southern-Africa-EXSA/350682401664996" target="_blank"><img src="<?php echo
Yii::app()->request->baseUrl; ?>/images/facebook.png" /></a></div>
    <div class="search-sites"  style="width: 180px; margin-right:18px ;">
                <form id="footer_search" method="get" action="<?php echo $this->
createUrl('/search'); ?>">
                <input type="text" class="" name="q" id="q" placeholder="Search EXSA" style="width: 135px;"/>
                <input type="submit" value="go" onclick='if($("#q").val()=="") return false;' />
                </form>
    </div>
            
    <div class="bot_nav">
    
    	<ul>
            <li><a class="<?php if (Yii::app()->controller->id == 'content' &&
Yii::app()->controller->action->id == 'about')
    echo 'active' ?>" href="<?php echo
$this->createUrl('/about') ?>">About</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'events')
        echo 'active' ?>" href="<?php echo
$this->createUrl('/events') ?>">Exhibition</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'directory')
            echo 'active' ?>" href="<?php echo
$this->createUrl('/directory') ?>">Directory</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'content' &&
Yii::app()->controller->action->id == 'membership')
                echo 'active' ?>" href="<?php echo
$this->createUrl('/membership') ?>">Membership</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'jobs')
                    echo 'active' ?>" href="<?php echo
$this->createUrl('/jobs') ?>">Jobs</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'articles')
                        echo 'active' ?>" href="<?php echo
$this->createUrl('/news') ?>">News</a></li>
            <li><a class="<?php if (Yii::app()->controller->id == 'site' && Yii::
app()->controller->action->id == 'contact')
                            echo 'active' ?>" href="<?php echo
$this->createUrl('/contact') ?>">Contact</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
             </div>
	</div><!--#inner_footer-->
    </div><!-- footer -->
    <div class="wrapper">
    	<div class="foot_bottom_links">
        	<p>Copyright 2011&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="<?php echo $this->createUrl('/terms-and-conditions') ?>">Terms and Conditions</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="<?php echo $this->createUrl('/privacy-policy') ?>">Privacy Policy</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            Website designed by <a href="http://www.in-detail.com/" target="_blank">In-Detail</a>
        	</p>
        </div>
    </div>
</div><!-- page -->
<div class="clear"></div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5.js"></script>
 <!-- pop up modal -->
 <?php if (Yii::app()->controller->module->id == '')
    echo $this->renderPartial('/directory/_contactModal', false, true); ?>
    
    <div class="clear"></div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-41420263-1', 'exsa.co.za');
    ga('send', 'pageview');

</script>
</body>
</html>