
<strong>Hi There,</strong>
<br />
	<div style="margin:0; padding:0;">
        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:20px;">Somebody has contacted on <?php echo $this->createAbsoluteUrl('/contact');?> with following details:</p>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Name: <?php echo $data['name'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Contact Number: <?php echo $data['contact'];?></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:15px;">E-mail Address: <?php echo $data['email'];?></div>
        
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:5px;">Messsage:<br /></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-bottom:15px;"><?php echo nl2br($data['body']);?></div>

        <div style="font-family:Arial, Helvetica, sans-serif; margin-bottom:5px; font-size:13px;"><a style="color:#005FA5; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a></div>
        <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><?php echo Yii::app()->params['site_name'];?></div>
	</div>
<br />

Thanks.