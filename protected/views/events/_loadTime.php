<hr />

<?php
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return  $interval->format($differenceFormat);
   
}
$date1 = substr($s,0,4).'-'.substr($s,4,2).'-'.substr($s,6,2);
$date2 = substr($e,0,4).'-'.substr($e,4,2).'-'.substr($e,6,2);
$diff = dateDifference($date1,$date2);
for($i=0;$i<=$diff;$i++)
{
    

$date = new DateTime($date1);
$date->add(new DateInterval('P'.$i.'D'));
$date_add = $date->format('Y-m-d') . "\n";


    $date_format=date_create($date_add);
$label =  date_format($date_format,"l, d F Y");
   ?>
   <div class="form-group">
        <label class="col-md-4"><strong><?php echo $label;?></strong></label> 
        <div class="col-md-3"><input class="form-control timepicker" name="start_time[]" placeholder="Start Time" /></div>
        <div class="col-md-1 center-align">-</div>
        <div class="col-md-3"><input class="form-control timepicker" name="end_time[]" placeholder="End Time" /></div> 
        <div class="clearfix"></div>  
   </div>
   <?php 
}
