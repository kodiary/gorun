<?php
//var_dump($events);
foreach($events as $e)
{
    $start_date = $e['start_date'];
    $old_date_timestamp = strtotime($start_date);
    $new_date = date('d F Y', $old_date_timestamp);  
    $distances = $et->findAllByAttributes(array('event_id'=>$e['id']));
    $str='';
    foreach($distances as $d)
    {
        if($d->distance1)
        {
            if($str != '')
            {
                $str = $str.' & ';
            }
            $str = $str.$d->distance1;
            if($d->distance2)
            $str = $str.','.$d->distance2;
        }
            
        
    }
    ?>
    <div class="calendar_list blue"><a href="<?php echo Yii::app()->request->baseUrl; ?>/events/view/<?php echo $e['slug'];?>"><strong><span class="upper"><?php echo $e['title'];?></span> - <?php echo $str;?>KM | <?php echo $new_date;?></strong></a></div>
    <?php
}
?>