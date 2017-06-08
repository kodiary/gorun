<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ERROR 404 Page</title>
<script>
    function goto_home(url){
        location.href = url;     
    }
</script>
</head>

<body  onload="setTimeout(goto_home('<?php echo  $this->createAbsoluteUrl('/');?>'), 5000000);" style="background: #FFF;">
<div style="width:980px; margin:0 auto;">
<div class="body_box">
	<div class="">
        <center>
    	   <a href="<?php echo  $this->createAbsoluteUrl('/');?>"><img src="<?php echo Yii::app()->baseUrl;?>/images/404.jpg" /></a>                   
        </center>
    </div>	
    <div class="clear"></div>
</div>
</div>
</body>
</html>