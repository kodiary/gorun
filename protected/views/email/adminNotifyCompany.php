
<strong>Hi <?php echo $name;?>,</strong>
<br />
	<div style="margin:0; padding:0;">
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">Thank you for applying to be a member of EXSA through <a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></p>
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">The EXSA office will send you the membership applications forms to be completed, and once your membership has been approved your directory listing will go live!</p>
        
        <h2 style="font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;">Your Profile Details:</h2>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Company Name: <?php echo $name;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Person: <?php echo $contact_person;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Number: <?php echo $number;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail Address: <?php echo $user_email;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Date Created: <?php echo date('d F Y');?></div>
        
        <p>Please use following login details to complete your company profile here - <a href="<?php echo $this->createAbsoluteUrl('/company/login') ?>"><?php echo $this->createAbsoluteUrl('/company/login') ?></a></p>
        <h2 style="font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;">Your Login Details:</h2>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail: <?php echo $user_email;?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">Password: <?php echo $password_real;?></div>

        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
	</div>
<br />
Thanks.