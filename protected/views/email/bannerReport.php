<div style="margin:0; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000;">
<p style="margin:0 0 20px 0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000;" >Hi <?php echo $name;?>,</p>
        <p style="margin:0 0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000;">Your banner "<?php echo $data->title;?>"  has performed as following on the <?php echo $this->createAbsoluteUrl('/');?> website.</p>
        
        <div style="height:10px; border-bottom:1px solid #dddddd; margin-bottom:10px;"></div>

	<p style="margin:0 0 20px 0; padding:0;">
    	<span  style="color: #0085C9; padding-right:20px; font-size: 20px; font-family:Arial, Helvetica, sans-serif;">Views: <?php $countViews = $data->countViews($data->id);
        echo $countViews;?></span>
        <span style="color: #0085C9;  padding-right:20px; font-size: 20px; font-family:Arial, Helvetica, sans-serif;">Clicks: <?php $countClicks = $data->countClicks($data->id);echo $countClicks;?></span>
        <span style="color: #0085C9; font-size: 20px; font-family:Arial, Helvetica, sans-serif;">CTR: <?php if($countClicks!=0) echo number_format(($countClicks/$countViews)*100,2); else echo '0'?>%</span>
    </p>

    <p style="margin:0 0 10px 0; padding:0; color:#0085C9; font-family:Arial, Helvetica, sans-serif; font-size:13px;">
    	Booked: <?php echo Banner::fullMonthName($data->from_month)?> <?php echo $data->from_year?>  to <?php echo Banner::fullMonthName($data->to_month)?> <?php echo $data->to_year?>  <span class="bold">(Banner went live on <?php echo Banner::fullMonthName($data->from_month)?> <?php echo $data->from_year?>)</span></p>
        
    <a  style="margin:0; text-decoration:none; padding:0; color:#0085C9; font-family:Arial, Helvetica, sans-serif; font-size:13px;" href="<?php echo Yii::app()->request->hostInfo.'/banner/viewbanner/id/'.$data->id?>">Click here to view banner</a> 
    <div style="height:1px; border-bottom:1px solid #dddddd; margin-top:15px; margin-bottom:15px;"></div>   
     
    <div style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin-top:20px; margin-bottom:5px;"><a href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><img src="<?php echo $this->createAbsoluteUrl('/images/email_logo.png');?>" alt="<?php echo $this->createAbsoluteUrl('/');?>" border="0" /></a></div>
	<p style="margin:0; padding:0; color:#000; font-family:Arial, Helvetica, sans-serif; font-size:13px;">Kind Regards</p>
    <a style="margin:0; text-decoration:none; padding:0; color:#0085C9; font-family:Arial, Helvetica, sans-serif; font-size:13px;" href="<?php echo $this->createAbsoluteUrl('/');?>" target="_blank"><?php echo $this->createAbsoluteUrl('/');?></a>
</div>