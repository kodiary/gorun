<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/gmap_front.js"></script>
<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-9 right-content profile_detail"> 
    <div class="col-md-12">
        <?php
        $arr_cat = [0=>'',1=>'Run',2=>'Bike',3=>'Triathlon'];
         $this->breadcrumbs=array($m_type->title=>'#',Events::model()->getProvinceName($model->province)=>'#',$model->title);
        $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>['style'=>'background:#fff; border:1px solid #ccc; margin-bottom:10px;']
        ));
        ?>
        <div class="white blocks">
        <div class="row">
            <div class="col-md-7">
                <h3 class="blue"><?php echo strtoupper($m_type->title)?></h3>
                <h1 class="big_font"><?php echo $model->title?></h1>
                <div>
                    <span class="datetime">
                        <?php 
                            $date=date_create($model->start_date);
                            echo date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';
                            if($model->end_date){
                                $date=date_create($model->end_date);
                                echo " - ";
                                echo $date2 = date_format($date,"D").' <strong>'.date_format($date,"d F Y").'</strong>';}
                            ?></span> 
                        <span class="racetag"><?php echo $model->province?></span>
                        <div class="clearfix"></div>
                        <span class="blue_bg"><?php echo $arr_cat[$model->event_cat];?></span><span class="distance">5k</span><span class="distance">32k</span><span class="distance">160k</span>
                        <div class="social_share">
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="img-holder">
                    <img class="responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/images/frontend/events/main/<?php if($model->logo && file_exists(Yii::app()->basePath.'/../images/frontend/events/main/'.$model->logo)){ echo $model->logo?><?php }else{?>noimg.jpg<?php }?>" />
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        </div>
        <a href="#" class="result_submit_black">Submit your result</a>
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">RACE INFO</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="display: none;">
                <span class="blue small_bold">DISTANCES AND START TIMES</span>
                
                    <?php
                    //var_dump($m_time);
                    foreach($m_time as $mt)
                    {
                        ?>
                        <div>
                        <?php
                        if($mt->distance1){
                            ?>
                        <span class="e_dis"><?php echo $mt->distance1?>, <?php echo $mt->distance2?>km </span>
                        <?php
                        }
                        ?>
                        <?php
                        if($mt->distance_swim_1){
                            ?>
                        <span class="e_dis">
                            <strong>Run </strong><?php echo $mt->distance_run_1?>, <?php echo $mt->distance_run_2?>km 
                            <strong>Bike </strong><?php echo $mt->distance_bike_1?>, <?php echo $mt->distance_bike_2?>km 
                            <strong>Swim </strong><?php echo $mt->distance_swim_1?>, <?php echo $mt->distance_swim_2?>km 
                        </span>
                        <?php
                        }
                        ?>
                        <span class="e_time"> - <?php echo $mt->event_from_hour?>:<?php echo $mt->event_from_min?> Start- </span>
                        <span class="e_cost">R<?php echo $mt->event_cost?></span>
                        
                        </div>
                        <?php
                    }
                    ?>
                    <div class="pad-top-10">
                            <a class="btn btn-info btn-lg">Enter Online Now</a>
                    </div>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">RACE DETAILS</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="display: none;">
                <?php echo $model->description;?>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">WHERE</div>
                <input type="hidden" required="" onblur='codeAddress()' id="formattedAddress" class="form-control venue" placeholder="Enter venue name or street address" name="Events[venue]" value="<?php echo $model->venue;?>" />
                <input id="Company_latitude" type="hidden" name="Events[latitude]" onchange='updateMapPinPosition()' value="<?php echo $model->latitude;?>" />
                    <input id="Company_longitude" type="hidden" name="Events[longitude]" onchange='updateMapPinPosition()' value="<?php echo $model->longitude;?>" />
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="col-md-12 content">
                <?php echo $model->venue;?>
                
            </div>
            <div class="clearfix"></div>
            <div id="map_canvas" style="height: 200px;background:#e5e5e5;margin-top:15px;" class="content"></div>
        </div>
        
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">ORGANIZER DETAILS</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="display: none;">
                <span class="blue small_bold">ORGANIZER NAME</span>
                <div class="e_dis"><?php echo $model->organizer?></div>
                
                <span class="blue small_bold">ORGANIZER EMAIL</span>
                <div class="e_dis"><?php echo $model->organizer_email;?></div>
                
                <span class="blue small_bold">ORGANIZER NUMBER</span>
                <div class="e_dis"><?php echo $model->organizer_contact?></div>
                
                <span class="blue small_bold">ORGANIZER WEBSITE</span>
                <div class="e_dis"><?php echo $model->organizer_website?></div>
                <div class="clearfix"></div>
                <a class="contact_organizer" href="mailto:<?php echo $model->organizer_email;?>"><span class="fa fa-envelope"></span> Contact Organizer</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <hr />
    <?php //echo $this->renderPartial('/events/_form', array('model'=>$model,'event_type'=>$event_type)); ?>
    
</div>
<div class="clearfix"></div>
<script>

$(function(){
    initialize();
    $('.expand_block').click(function(){
        
        if($(this).parent().find('.content').attr('style')=='display: none;'){
        $(this).attr('style','border-bottom:1px solid #ccc;padding-bottom:5px;margin-bottom:5px');
        $(this).parent().find('.content').show('slow');
        }
        else
        {
            $(this).attr('style','');
            $(this).parent().find('.content').hide('slow');
        }
    })
})
</script>