<?php
    $act = Yii::app()->controller->action->id;
    $con = Yii::app()->controller->id;
    if($con == 'bike')
    $act = 2;
    else
    if($con=='triathlon')
    $act = 3;
    else
    $act =1;
    if(Yii::app()->user->getId() && $con == 'events' && $act=='index'){
        $edit_mode = 1;
    }
?>
<div class="listing-parent">
<input type="hidden" class="offset" value="0" />
<?php

foreach($model as $m)
{
    //echo Yii::app()->basePath;die();
    $etime = EventsTime::model()->findAllByAttributes(array('event_id'=>$m->id));
    ?>
    <div class="listing">
        <div class="row">
            <div class="col-md-9">
                <a href="<?php if($m->visible){
                        echo Yii::app()->request->baseUrl; ?>/events/view/<?php echo $m->slug;
                    } else {echo "javascript:void(0)";}?>" <?php if(!$m->visible){?>onclick="alert('Pending Approval. You can edit/delete your event for now.');return false;"<?php }?>>
                <div class="img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/events/<?php if($m->logo && file_exists(Yii::app()->basePath.'/../images/frontend/events/thumb/'.$m->logo)){?>thumb/<?php echo $m->logo?><?php }else{?>thumb/noimg.jpg<?php }?>"/></div>
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
                    <?php
                    
                    foreach($etime as $mt)
                            {
                                if($mt->distance1){
                                ?>
                                <span class="distance"><?php echo $mt->distance1?> <?php if($mt->distance2)echo ','.$mt->distance2?>k</span>
                                <?php
                                }
                                else
                                {
                                if($mt->distance_swim_1){
                                    ?>
                                <span class="distance">
                                    <?php echo $mt->distance_run_1?>, <?php echo $mt->distance_run_2?>km / <?php echo $mt->distance_bike_1?>, <?php echo $mt->distance_bike_2?>km / <?php echo $mt->distance_swim_1?>, <?php echo $mt->distance_swim_2?>km 
                                </span>
                                <?php
                                }
                                   }}?>
                </div>
                <div class="clearfix"></div>
                </a>
            </div>
            <?php
            if(!Yii::app()->user->isGuest && $m->created_by == Yii::app()->user->id){
            ?>
            <div class="col-md-3 event_action">
                <a href="<?php echo Yii::app()->request->baseUrl; ?>/events/create/<?php echo $m->id;?>" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </div>
            <?php }?>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php
}
?>

</div>
<hr />
<?php if(count($model)>'2'){?>
<a class="btn btn-default btn-lg loadmore">Load More</a>
<?php }?>
<script>
$('.loadmore').click(function(){
   var cat =  '<?php echo $act;?>';
   var offset = $('.offset').val();
                       $('.offset').val(parseInt(offset)+10);
                       $.ajax({
                        url:'<?php echo Yii::app()->request->baseUrl;?>/events/loadEvents',
                        data:'offset='+offset+'&cat='+cat,
                        type:'post',
                        success:function(res){
                            if(res){
                                //$('.all-review .clearfix:last').remove()
                            $('.listing-parent').append(res);
                            }
                        }
                       }); 
});
</script>