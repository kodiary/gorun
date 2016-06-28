<table cellpadding="5" border="0" class="table table-bordered table-striped">
<tr>
    <th>Week</th>
    <th>Mon</th>
    <th>Tues</th>
    <th>Wed</th>
    <th>Thur</th>
    <th>Fri</th>
    <th>Sat</th>
    <th>Sun</th>
    <th>Average</th>
    <th>Total</th>
</tr>
<?php 
//$week_number = date('N', strtotime('2012-01-01'));//starting from 1 for monday and 7 for sunday
$start_week = $year.'-01-02';

//$current_year=date('Y', time());
//$current_month =date('m', time()); 
if($week>1){
    //$start_week_day = date('d', strtotime($start_week. " +$week Week - 7 day"));
    $start_week_day = date('Y-m-d', strtotime($start_week. " +$week Week - 7 day"));
    $end_week = date('Y-m-d', strtotime($start_week . " +$week Week -1 day"));
    //$end_week_day = date('d', strtotime($end_week));
    $end_week_day = date('Y-m-d', strtotime($end_week));
}
else
{
    $start_week_day = date('Y-m-d', strtotime($start_week));
    $end_week = date('Y-m-d', strtotime($start_week . " +$week Week -1 day"));
    $end_week_day = date('Y-m-d', strtotime($end_week));
}
$month = date('m', strtotime($end_week));

//$weekReport = CompanyClicks::weeklyReport($start_week_day, $end_week_day, $company_id);
$weekval = CompanyClicks::date_range($start_week_day, $end_week_day);


//date('Y-m-d', $end_week);die();
?>
<tr>
<td><?php echo "w$week"."-".$year;?></td>
<?php 
for($i=0;$i<=6;$i++){?>
    <td><?php echo date('d', strtotime($weekval[$i]))."-".date('m', strtotime($weekval[$i]));?></td>
    <?php }?>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
<td>Views</td>
    <?php $countViews = 0;
for($i=0;$i<=6;$i++){ 
    $views = CompanyViews::daily_report_by_company($company_id,date('d', strtotime($weekval[$i])), date('m', strtotime($weekval[$i])), date('Y', strtotime($weekval[$i])))->count;
    $countViews+= $views;?>
    <td><?php echo $views;?></td>
    <?php }?>
    <td><?php echo  number_format($countViews/7,2);?></td>
    <td><?php echo  number_format($countViews,2);?></td>
</tr>

<tr>
<td>Clicks</td>
    <?php $countClicks = 0;
for($i=0;$i<=6;$i++){ 
    $clicks = CompanyClicks::daily_report_by_company($company_id,date('d', strtotime($weekval[$i])), date('m', strtotime($weekval[$i])), date('Y', strtotime($weekval[$i])))->count;
    $countClicks+= $clicks;?>
    <td><?php echo $clicks;?></td>
    <?php }?>
    <td><?php echo  number_format($countClicks/7,2);?></td>
    <td><?php echo  number_format($countClicks,2);?></td>
</tr>

<tr>
<td>CTR - Ratio</td>
    <?php $countClicks = 0;
    $countViews = 0;
    $CTR_sum = 0;
    for($i=0;$i<=6;$i++){ 
    $clicks = CompanyClicks::daily_report_by_company($company_id,date('d', strtotime($weekval[$i])), date('m', strtotime($weekval[$i])), date('Y', strtotime($weekval[$i])))->count;
    $views = CompanyViews::daily_report_by_company($company_id,date('d', strtotime($weekval[$i])), date('m', strtotime($weekval[$i])), date('Y', strtotime($weekval[$i])))->count;
    $countClicks+= $clicks;
    $countViews+= $views;
    if($views!=0)
        $CTR_sum+= ($clicks/$views)*100;?>
    <td><?php if($views!=0) echo number_format(($clicks/$views)*100, 2); else echo '0'?>%</td>
    <?php }?>
    <td><?php echo ($CTR_sum!=0)?  number_format($CTR_sum/7, 2) : 0;?>%</td>
    <td><?php echo  number_format($CTR_sum,2);?>%</td>
</tr>
</table>