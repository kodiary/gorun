<?php if(isset($_GET['id'])){
    $monthLink = $this->createUrl('index', array('id'=>$_GET['id']));
    $weekLink = $this->createUrl('weeklystat', array('id'=>$_GET['id']));
    $dailyLink = $this->createUrl('dailystat', array('id'=>$_GET['id']));
    $graphLink = $this->createUrl('graph', array('id'=>$_GET['id']));
    $yearLink = $this->createUrl('yearlystats', array('id'=>$_GET['id']));
}
else
{
    $monthLink = $this->createUrl('index');
    $weekLink = $this->createUrl('weeklystat');
    $dailyLink = $this->createUrl('dailystat');
    $graphLink = $this->createUrl('graph');
    $yearLink = $this->createUrl('yearlystats');
}
?>
<div class="right_bar_blocks">
<div class="well">
	<h3>STATISTICS</h3>
    <ul>
     <li><a href="<?php echo $yearLink;?>">Yearly Stats</a></li>
    	<li><a href="<?php echo $monthLink;?>">Monthly Stats (default)</a></li>
        <li><a href="<?php echo $weekLink;?>">Weekly Stats</a></li>
        <li><a href="<?php echo $dailyLink;?>">Daily Stats</a></li>
        <li><a href="<?php echo $graphLink;?>">Graph View</a></li>
    </ul>
</div>
</div>