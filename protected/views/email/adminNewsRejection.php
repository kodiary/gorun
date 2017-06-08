<strong>Hello <?php echo $com_name;?></strong>
<br />
<div style="margin:0; padding:0;">
	<p style="font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;"><strong>News Rejected- </strong>Your news item is not suitable for publication and has been rejected and deleted.</p>
    
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;">Please take note of our <a href="<?php echo $this->createAbsoluteUrl('/news-guidelines')?>">News Publishing Guidelines</a></div>

    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;">Kind Regards</div>
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">The EXSA Team</div>
    
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
    <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
</div>