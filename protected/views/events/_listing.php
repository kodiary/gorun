<?php
foreach($model as $m)
{
    

    ?>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>events/detail/<?php echo $m->slug;?>" class="listing">
        <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/events/<?php if($m->logo){?>thumb/<?php echo $m->logo?><?php }else{?>noimg.png<?php }?>"/></div>
        <div class="txt">
            <h3><?php echo $m->title;?></h3>
            <span class="datetime">
            <?php 
                $date=date_create($m->start_date);
                echo date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';
                if($m->end_date){
                    $date=date_create($m->end_date);
                    echo " - ";
                    echo $date2 = date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';}
                ?></span> 
            <span class="racetag"><?php echo $m->province?></span>
            <div class="clearfix"></div>
            <span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
        </div>
        <div class="clearfix"></div>
    </a>
    <?php
}
?>


<hr />
<a class="btn btn-default btn-lg loadmore">Load More</a>