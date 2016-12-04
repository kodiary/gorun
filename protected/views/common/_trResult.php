<?php
foreach($models as $k=>$result){?>
<tr title="<?php echo $offset;?>">
    <td><span class="blue pos"><?php echo (isset($_GET['pos']))?++$_GET['pos']:++$k;?></span></td>
    <td><span class="blue"> <a href="<?php echo Yii::app()->request->baseUrl."/".$result->member['username'];?>" target="_blank"><?php echo $result->member['fname']." ".$result->member['lname'];?></a></span></td>
    <td><span class=""><?php echo str_replace('.',',',$result->distance)."Km";?></span></td>
    <td><span class=""><?php echo EventResult::model()->getAvg($result->user_id,$result->event_type,$result->distance);?></span></td>
    <td><span class="blue"><a href="<?php echo Yii::app()->request->baseUrl."/events/view/".$result->event['slug'];?>" target="_blank"><?php echo $result->dist_time;?></span></td>
    <td><span class="blue"><a href="<?php echo Yii::app()->request->baseUrl."/events/view/".$result->event['slug'];?>" target="_blank"><?php echo date("d M Y",$result->result_date);?></span></td>
</tr>
<?php
}
?>