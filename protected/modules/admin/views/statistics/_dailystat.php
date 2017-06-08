<table cellpadding="5" border="0" class="table table-bordered table-striped" id="dailystat">
<tr>
    <th>Day</th>
    <th>Advert Viewed</th>
    <th>Contact Clicked</th>
    <th>CTR - Ratio</th>
</tr>
<?php for($i=1;$i<=$daycount; $i++){
    $views = CompanyViews::daily_report_by_company($company_id, $i, $month, $year)->count;
    $clicks = CompanyClicks::daily_report_by_company($company_id, $i, $month, $year)->count;?>
<tr>
<td><?php echo $i.'-'.$month.'-'.$year;?></td>
<td><?php echo $views;?></td>
<td><?php echo $clicks;?></td>
<td><?php if($views!=0) echo number_format(($clicks/$views)*100, 2); else echo '0'?>%</td>
</tr>
<?php }?>
</table>