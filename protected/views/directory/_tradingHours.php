<?php
if($model->opentimes_type!=0)
{?>
  <ul class="opening_hours">
    <?php
    if($model->opentimes_type==1)//type in trading hours
    {?>
        <li class="opening_hours_title"><h3><strong>Trading</strong> Hours</h3></li>
        <?php echo nl2br($model->opentimes);
    }
    if($model->opentimes_type==2 && $tradingHours)//select trading hours from dropdown for each week day
    {?>
    <li class="opening_hours_title"><h3><strong>Trading</strong> Hours</h3></li>
    <li>
    	<div class="left">Monday</div>
        <div class="right"><?php echo($tradingHours->MonClosed==0)? $tradingHours->MonFrom ." to ".$tradingHours->MonTo:'Closed';?></div>
        <div class="clear"></div>
   </li>
   <li> 
   		<div class="left">Tuesday</div>
        <div class="right"><?php echo($tradingHours->TueClosed==0)? $tradingHours->TueFrom ." to ".$tradingHours->TueTo:'Closed';?></div>
        <div class="clear"></div>
   </li>
   <li>
   		<div class="left">Wednesday</div>
        <div class="right"><?php echo($tradingHours->WedClosed==0)? $tradingHours->WedFrom ." to ".$tradingHours->WedTo:'Closed';?></div>
        <div class="clear"></div>
   </li>
   <li>
   		<div class="left">Thursday</div>
        <div class="right"><?php echo($tradingHours->ThuClosed==0)? $tradingHours->ThuFrom ." to ".$tradingHours->ThuTo:'Closed';?></div>
        <div class="clear"></div>
  </li>
  <li>
  		<div class="left">Friday</div>
        <div class="right"><?php echo($tradingHours->FriClosed==0)? $tradingHours->FriFrom ." to ".$tradingHours->FriTo:'Closed';?></div>
        <div class="clear"></div>
   </li>
   <li>
   		<div class="left">Saturday</div>
        <div class="right"><?php echo($tradingHours->SatClosed==0)? $tradingHours->SatFrom ." to ".$tradingHours->SatTo:'Closed';?></div>
       <div class="clear"></div>
    </li>
    <li>
       <div class="left">Sunday</div>
        <div class="right"><?php echo($tradingHours->SunClosed==0)? $tradingHours->SunFrom ." to ".$tradingHours->SunTo:'Closed';?></div>
        <div class="clear"></div>
   </li>
   <li>
   		<div class="left">Public Holidays</div>
        <div class="right"><?php echo($tradingHours->HClosed==0)? $tradingHours->HolidaysFrom ." to ".$tradingHours->HolidaysTo:'Closed';?></div>
     	<div class="clear"></div>
    </li>
    <?php }?>
</ul>    
    <?php }?>