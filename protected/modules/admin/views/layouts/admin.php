<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="robots" content="index,nofollow"/>
    	<!-- blueprint CSS framework -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/fa/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/front_style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/jqueryui/jquery-ui.min.js" type="text/javascript"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filter.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.Jcrop.min.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle)." | Admin"; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 
</head>
<body>
<div class="container" id="page">
	<div class="header_blocks"></div>
    <!-- load header -->
    <div id="admin_header" class="">
    <div class="top_head_sections">
        <div class="col-md-1 logo_admin">
        <a href="#">ADMIN</a>
        </div>
    	<div class="col-md-9 nav-admin">
            
            <?php if(!Yii::app()->user->isGuest) $this->widget('AdminMenu'); ?>
             
   		</div>
        <div class="col-md-2 text-right">
    			<?php echo CHtml ::link('Log Out',array('/admin/logout'),array('class'=>'btn btn-info'))?>
        </div>
        <div class="clear"></div>
    </div>
    
    

    </div>
    
    
    
    <!-- load content -->
    <div class="admin_body_content">
    <?php
    $company_controllers=array('company','membertype','services','member/services','member/events','resources','resourcecategory','brochures','member/articles','gallery','videos','member/jobs','member/resources','statistics');
    $club_controllers=array('club','membertype','services','member/services','member/events','resources','resourcecategory','brochures','member/articles','gallery','videos','member/jobs','member/resources','statistics');
    $events_controllers = array('events', 'eventscategory', 'eventstype', 'eventsvisitors');
    $article_controllers = array('articles', 'tags');
    $newsletter_controller = array('newsletters', 'newslettertemplate', 'newslettersendlimit', 'subscriberslist', 'subscribers');
    $contents_controllers=array('contents','accounts');
    $jobs_controllers=array('jobs');
     
    if(in_array(Yii::app()->controller->id,$company_controllers)){?>
        <nav class='subMenu'><?php $this->widget('CompanyMainMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id,$club_controllers)){?>
        <nav class='subMenu'><?php $this->widget('ClubMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id,$events_controllers)){?>
        <nav class='subMenu'><?php $this->widget('EventMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id, $article_controllers)){?>
        <nav class='subMenu'><?php $this->widget('ArticleMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id,$newsletter_controller)){?>
        <nav class='subMenu'><?php $this->widget('NewsletterMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id,$contents_controllers)){?>
        <nav class='subMenu'><?php $this->widget('PageMenu');?></nav>
    <?php
    }elseif(in_array(Yii::app()->controller->id,$jobs_controllers)){?>
        <nav class='subMenu'><?php $this->widget('JobsMenu');?></nav>
    <?php
    }?> 
    
    <div class="clear"></div>
    <div class="admin_setting_nav">
    	<?php if(Yii::app()->controller->id=='setting') $this->widget('SettingMenu');?>
        <?php if(Yii::app()->controller->id=='banner' || Yii::app()->controller->id=='slideshow' || Yii::app()->controller->id=='patronslider') $this->widget('BannerMenu');?>      
     </div>
    <?php echo $content; ?>
    </div>
    
    <!--load footer -->
    <!--
    <div id="footer">
    <p >Kodiary &copy; 2016 | Website designed by <a href="http://www.kodiary.com/" style="color:#C00;" target="_blank">Kodiary</a></p>
    </div>
    -->
</div>
</body>
</html>