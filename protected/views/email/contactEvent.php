
<strong>Hi <?php echo $data['for']?>,</strong>
<br />
	<div style="margin:0; padding:0;">
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">You have a new enquiry sent from the  EXSA website.</p>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Name: <?php echo $data['name'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Number: <?php echo $data['contact'];?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">E-mail Address: <?php echo $data['email'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Messsage:<br /></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:15px;"><?php echo nl2br($data['body']);?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">This message was generated from the following page on the EXSA website:</div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:15px;"><a href="<?php echo $data['link'];?>" target="_blank"><?php echo $data['link'];?></a></div>

        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><?php echo Yii::app()->params['site_name'];?></div>
	</div>
<br />

Thanks.