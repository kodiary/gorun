<!-- start profiling callstack -->
<table class="yiiLog" width="100%" cellpadding="2">
	<tr>
		<th colspan="2">
			Profiling Callstack Report
		</th>
	</tr>
	<tr>
	    <th>Procedure</th>
		<th>Time (s)</th>
	</tr>
<?php
foreach($data as $index=>$entry)
{
	$color=($index%2)?'#F5F5F5':'#FFFFFF';
	list($proc,$time,$level)=$entry;
	$proc=CHtml::encode($proc);
	$time=sprintf('%0.5f',$time);
	$spaces=str_repeat('&nbsp;',$level*8);

	echo <<<EOD
	<tr style="background:{$color}">
		<td>{$spaces}{$proc}</td>
		<td align="center">{$time}</td>
	</tr>
EOD;
}
?>
</table>
<!-- end of profiling callstack -->