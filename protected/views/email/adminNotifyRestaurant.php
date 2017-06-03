
<strong>Hi <?php echo $ResName;?>,</strong>
<br />
	<div style="margin:0; padding:0;">
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">Thank you for signing up as a member of <a href="http://www.restaurants.co.za" target="_blank">Restaurants.co.za.</a></p>
        
        <h2 style="font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;">Your Profile Details:</h2>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Restaurant Name: <?php echo $ResName;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Person: <?php echo $Contact;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Number: <?php echo $Phone;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail Address: <?php echo $Email;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Date Created: <?php echo date('d F Y');?></div>
        
        <p>Please use following login details to complete your restaurants profile here - <a href="<?php echo $this->createAbsoluteUrl('/restaurant/login') ?>"><?php echo $this->createAbsoluteUrl('/restaurant/login') ?></a></p>
        <h2 style="font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;">Your Login Details:</h2>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail: <?php echo $Email;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Password: <?php echo $password;?></div>

        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:10px;"><a href="http://www.restaurants.co.za"><img src="<?php echo Yii::app()->request->hostInfo;?>/images/email_logo.png" height="92" width="305" alt="restaurants.co.za" border="0" /></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="http://www.restaurants.co.za" target="_blank">http://www.restaurants.co.za</a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">The South African Restaurant Guide</div>
	</div>
<br />

Thanks.