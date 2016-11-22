<?php
foreach($memEvents as $m){
?>

   <a href="<?php echo Yii::app()->request->baseUrl; ?>/events/view/<?php echo $m->event['slug'];?>" class="listing loadResult_<?php echo $m->id;?>" title="<?php echo $offset;?>">
    <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/events/<?php if($m->event['logo'] && file_exists(Yii::app()->basePath.'/../images/frontend/events/thumb/'.$m->event['logo'])){?>thumb/<?php echo $m->event['logo']?><?php }else{?>thumb/noimg.jpg<?php }?>"/></div>
    <div class="txt">
        <h3><?php echo $m->event['title'];?></h3>
        <span class="distance"><?php echo $m->dist_time;?></span>
        <span class="datetime">
        <?php 
            $date=date_create($m->event['start_date']);
            echo date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';
            if($m->event['end_date']){
                $date=date_create($m->event['end_date']);
                echo " - ";
                echo $date2 = date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';}
            ?></span> 
        <span class="racetag"><?php echo $m->event['province']?></span>
        <div class="clearfix"></div>
        <span class="distance"><?php echo $m->distance;?>k</span>
    </div>
    <div class="clearfix"></div>
</a>
<?php }