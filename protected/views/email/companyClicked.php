
Hello <?php echo $company?>,
<br />
	<div style="margin:0; padding:0;">
		<p style="font-size:13px; font-family:Arial, sans-serif; margin-bottom:13px;">Great News! You have had another <?php echo $count?> clicks on your contact details!</p>
        <p style="font-family:Arial, sans-serif; font-size:13px; margin-bottom:20px;">That means another <?php echo $count?> folks contacted your company.</p>

        <p style="font-family:Arial, sans-serif; font-size:13px;">We just wanted to let you know so that you could get a sense of how many folks are clicking on your listing.</p>

        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
	</div>