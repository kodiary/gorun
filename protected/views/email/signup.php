<div class="logo" style="background: #F4F4F4;padding:10px 10px 0 10px;">
<img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" />
</div>
<div style="background: #01A5EC;color:#FFF;padding:25px 20px;font-size:25px; font-family:Arial, Helvetica, sans-serif;">Confirm Your Registration</div>
<div style="padding: 20px;color:#555; font-size:15px;font-family:Arial, Helvetica, sans-serif;border-left: 1px solid #e5e5e5;border-right: 1px solid #e5e5e5;border-bottom: 1px solid #e5e5e5;">
Hi <?php echo $fname." ".$lname?> ,<br />
Thank you for creating an account on the Go Run SA website.<br/><br/>
Verify your regestration by clicking on the link below or by copying and pasting this link on tyhe browser.
<br/>When prompted please enter the following One Time Pin: <strong><?php echo $pin;?></strong>
<br/><br/>Verification link:<br/>
<a href='<?php echo $url;?>' taget='_blank'><?php echo $url;?></a>
</div>
<div class="email_footer"></div>