<strong>Hello <?php echo $com_name;?></strong>
<br />
<div style="margin:0; padding:0;">
	<p style="font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;"><strong>Good News - </strong>Your news item has been approved and is now live. Click on the link below to view.</p>
    
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/news/'.$news_slug)?>"><?php echo $this->createAbsoluteUrl('/news/'.$news_slug)?></a></div>

    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;">Kind Regards</div>
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">The EXSA Team</div>
    
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
    <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
</div>