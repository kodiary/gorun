<strong>Hi There,</strong>
<br />
	<div style="margin:0; padding:0;">
    <h2 style="font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;">Contact Accounts</h2>
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">A company admin (<?php echo $companyName?>) has contacted accounts with following details:</p>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Name: <?php echo $info['name'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Number: <?php echo $info['contact'];?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail Address: <?php echo $info['email'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><?php echo nl2br($info['body']);?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
	</div>
<br />

Thanks.