<div class="logo" style="background: #F4F4F4;padding:10px 10px 0 10px;">
<img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" />
</div>

<div style="padding: 20px;color:#555; font-size:15px;font-family:Arial, Helvetica, sans-serif;border-left: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;border-bottom: 1px solid #e5e5e5;">
	<strong>Hello <?php echo $name;?>,</strong>
    <br />
    <div style="font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-top:20px;">You have recently requested a password reminder on the GORUN website.</div>
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:10px;">Please find your login details below: </div>
    
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail: <?php echo $email_add;?></div>
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Password: <?php echo $password;?></div>
        
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;">Kind Regards</div>
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">The GORUN Team</div>

</div>
<div style="background: #2a303e none repeat scroll 0 0;padding: 20px 0;display:block;"></div>