<?php 
if(!isset($_POST['month']))
$month = date('m');
else
$month = $_POST['month'];
if(!isset($_POST['year']))
$year = date('Y');
else
$year = $_POST['year'];

if($month == '01')
{
    $prev_month = 12;
    $prev_year = $year-1;
}
else{
$prev_month = $month-1;
$prev_year = $year;
} 

$days = cal_days_in_month ( CAL_GREGORIAN , $month , $year );
$prev_days = cal_days_in_month ( CAL_GREGORIAN , $prev_month , $prev_year );

$timestamp = strtotime($year.'-'.$month.'-01');
$day_position = date('w', $timestamp);

$remaining = $day_position-1;

$arr = array();
$date_arr = array();
$monthNum  = $month;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
$start_date = '';
for($i=0;$i<$remaining;$i++)
{
    $arr[] = $prev_days-$i;
    if($i==0){
    if(strlen($prev_month)<2)
    $pm = '0'.$prev_month;
    else
    $pm = $prev_month;
    
    $pd = $prev_days-1;
    if(strlen($pd)<2)
    {
        $pd = '0'.$pd;
    }
    $start_date = $prev_year.'-'.$pm.'-'.$pd;
    }
     
}

$count = count($arr);
$rem_count = 35-$count;
$start = 1;
for($i=0;$i<$rem_count;$i++)
{
    if($start > $days)
    {
        $start = 1;
    }
    $arr[] = $start;
    $start++;
    
}
if($month==12){
$mon = 1;
$ye = $year+1; 
}
else
{
    $mon = $month+1;
    $ye = $year;
}

if(strlen($mon)<2)
{
    $mon = '0'.$mon;
}

$da = end($arr);
if(strlen($da)<2)
$da = '0'.$da;
$end_date = $ye.'-'.$mon.'-'.$da;
$event= Yii::app()->db->createCommand('select start_date from tbl_events WHERE start_date >= "'.$start_date.'" AND visible = 1 ORDER BY start_date')->queryAll();
$d_count;
foreach($event as $e)
{
    $ev[str_replace('-','_',$e['start_date'])][] = $e;
}
//var_dump($ev);die();
//var_dump($arr);
?>
<input type="hidden" class="month_year" value="<?php echo $month.'_'.$year;?>" />
<?php //echo date('Y-m-d');?>
<div class="calendar">
    <div class="calendar-head">
        <div class="anchor-left"><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/left-arrow.png" /></a></div>
        <div class="month"><?php echo $monthName.' '.$year;?></div>
        <div class="anchor-right"><a href="javascript:void(0);"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/right-arrow.png" /></a></div>
        <div class="clearfix"></div>
    </div>
    <div class="calendar-body">
        <table class="table">
            <tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td><td>Su</td></tr>
            
            <?php 
            $i=0;
            foreach($arr as $a)
            {
                
                $i++;
                $daysplusremaining = $days+$remaining;
                if(strlen($a)<2)
                    $aa = '0'.$a;
                    else
                    $aa = $a;
                if($i<=$remaining)
                {
                    
                    $checker = $prev_year.'_'.$pm.'_'.$aa;
                }
                else
                {
                    if($i<=$daysplusremaining)
                    {
                        $checker = $year.'_'.$month.'_'.$aa;
                    }
                    else
                    {
                        if($month==12)
                        {
                            $nm = '01';
                            $ny = $year+1; 
                        }
                        else
                        {
                            $nm = $month+1;
                            $ny = $year;
                            if(strlen($nm)<2)
                            {
                                $nm = '0'.$nm;
                            }
                        }
                        $checker = $ny.'_'.$nm.'_'.$aa;
                    }
                }
                if(($i-1)%7==0)
                {
                    ?>
                    <tr>
                    <?php
                }
                //echo $checker.'<br/>';
                if(!isset($ev[$checker]))
                echo "<td class='day_num'><a class='bg-grey-light'>".$a."</a></td>";
                else
                echo "<td class='day_num'><a href='javascript:void(0)' class='bg-blue-light get_events' id='".$checker."'>".$a."<span class='event_counter'>".count($ev[$checker])."</span></a></td>";
                if($i%7==0)
                {
                    ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>