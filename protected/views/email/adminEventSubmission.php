<div style="border: 1px solid #ccc;font-family:sans-serif;">
<div style="background: #F4F4F4;padding:5px;"><img src="<?php echo Yii::app()->createAbsoluteUrl('images/email_logo.png');?>" /></div>
<div style="background: #01A5EC;color:#FFF;padding:25px 20px;font-size:24px;">Event Submission</div>
<div style="background: #FEFEFE;padding:25px 20px;font-size:15px;">
<p>Hi Admin,</p>
<p>A new race has been submited:<br /><strong><?php echo $title;?>.</strong></p>
<p>View Event here:<br /><a href="<?php echo Yii::app()->createAbsoluteUrl('events/view/'.$slug);?>" style="color: #01A5EC;"><?php echo Yii::app()->createAbsoluteUrl('events/view/'.$slug);?></a></p>
<p>Click on the link to approve or decline it below, or login to admin section to manage this submission.</p>
<?php
$number = rand(1000000,9999999).$id;
?>
<p>To approve:<br /><a style="color: #01A5EC;" href="<?php echo Yii::app()->createAbsoluteUrl('events/approve/'.$number);?>"><?php echo Yii::app()->createAbsoluteUrl('events/approve/'.$number);?></a></p>
<p>To decline:<br /><a style="color: #01A5EC;" href="<?php echo Yii::app()->createAbsoluteUrl('events/decline/'.$number);?>"><?php echo Yii::app()->createAbsoluteUrl('events/decline/'.$number);?></a></p>
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