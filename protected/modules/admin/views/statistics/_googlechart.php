<?php $impression = 0;
$clickthrough = 0;?>
<script type='text/javascript' src='https://www.google.com/jsapi'></script>

<script type='text/javascript'>
google.load('visualization', '1', {packages:['corechart']});
google.setOnLoadCallback(drawChart);
function drawChart() {
var data = new google.visualization.DataTable();
data.addColumn('string', 'Date');
data.addColumn('number', 'Impressions');
data.addColumn('number', 'Clickthrough');
data.addRows([<?php 
for($i=1;$i<=$daycount; $i++){
    $views = CompanyViews::daily_report_by_company($company_id, $i, $month, $year)->count;
    $impression+=$views; 
    $clicks = CompanyClicks::daily_report_by_company($company_id, $i, $month, $year)->count;
    $clickthrough+=$clicks;
echo '["'.$i.'/'.$month.'/'.$year.'", '.$views.','.$clicks.'],';
}?>]);

var options = { width: 675, height: 240, title: '',legend: 'none',displayMode: 'markers'};

var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script>
<div class="chart_holder">
	<div id="chart_div" class="maps_charts"></div>
</div>

<div class="bottom_count_downs">
<!--<div class="lefts">
<h3>Queries</h3>
<p class="numbers">365</p>
</div>-->

<div class="impress"><h3>Impressions</h3>
<p class="numbers"><?php echo $impression;?></p>
</div>

<div class="click_t"><h3>Clickthrough</h3>
<p class="numbers"><?php echo $clickthrough;?></p>

</div>
<div class="clear"></div>
</div>
