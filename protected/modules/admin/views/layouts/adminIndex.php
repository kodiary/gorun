<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="robots" content="index,nofollow"/>
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle)." | Admin"; ?></title>
</head>
<body>
<div class="container" id="page">
    <!-- load header -->
    <div id="header">
    
    </div>
    <!-- load content -->
    <div>
    <?php echo $content; ?>
	<div class="clear"></div>
    </div>
    
    <!--load footer -->
    <!--
    <div id="footer">
    <p >Access Keys CMS &copy; 2012 | Website designed by <a href="http://www.access-keys.com/" style="color:#C00;" target="_blank">Access-keys</a></p>
    </div>
    -->
</div>
</body>
</html>