<div style="border: 1px solid #ccc;font-family:sans-serif;">
<div style="background: #F4F4F4;padding:5px;"><img src="<?php echo Yii::app()->createAbsoluteUrl('images/email_logo.png');?>" /></div>
<div style="background: #01A5EC;color:#FFF;padding:25px 20px;font-size:24px;">Event Submission</div>
<div style="background: #FEFEFE;padding:25px 20px;font-size:15px;">
<p>Hi <?php echo $member->fname.' '.$member->lname;?>,</p>
<p>Thank you for submitting your race:<br /><strong><?php echo $title;?>.</strong></p>
<p>We will review your submission shortly and notify you by email if it was approved.</p>
<p>Best Regards<br /><strong style="color: #01A5EC;">Go Run Team</strong></p>
</div>
<div style="background: #2A303E;">
    <div style="width: 50%;float:left">
        <a href=""><img src="<?php echo Yii::app()->createAbsoluteUrl('images/on-facebook.png');?>" /></a>
    </div>
    <div style="width: 50%;float:left">
        <a href=""><img src="<?php echo Yii::app()->createAbsoluteUrl('images/on-twitter.png');?>" /></a>
    </div>
    <div style="clear: both;"></div>
</div>
</div>