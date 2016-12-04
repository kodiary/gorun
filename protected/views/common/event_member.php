<?php
foreach($models as $m){
?>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/events/view/<?php echo $m->event['slug'];?>" class="listing" title="<?php echo $offset;?>">
            <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/events/<?php if($m->event['logo'] && file_exists(Yii::app()->basePath.'/../images/frontend/events/thumb/'.$m->event['logo'])){?>thumb/<?php echo $m->event['logo']?><?php }else{?>thumb/noimg.jpg<?php }?>"/></div>
            <div class="txt">
                <h3><?php echo $m->event['title'];?></h3>
                <span class="datetime">
                    <?php 
                        $date=date_create($m->event['start_date']);
                        echo date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';
                        if($m->event['end_date']){
                            $date=date_create($m->event['end_date']);
                            echo " - ";
                            echo $date2 = date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';
                        }
                    ?>
                </span> 
                <span class="racetag"><?php echo $m->event['province']?></span>
                <div class="clearfix"></div>
                <?php
                    $distances = EventsTime::model()->findAllByAttributes(['event_id'=>$m->event_id]);
                    foreach($distances as $distance)
                    {?>
                       <span class="distance"><?php echo $distance->distance1;?><?php echo ($distance->distance2!='')?','.$distance->distance2:'';?>k</span> 
                <?php        
                    }
                ?>
                
            </div>
            <div class="clearfix"></div>
        </a>
<?php
}