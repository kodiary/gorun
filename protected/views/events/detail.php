<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Gjdm_0nJk17UVBPoV5Im40uQeguoRAo"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/gmap_front.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-star-rating.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/dropzone/css/dropzone.css" rel="stylesheet"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dropzone/dropzone.js"></script>
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
        
        
        
        <?php
        if($past==1/* && (isset($check['going']) && $check['going'] == 1)*/)
        {
            if(!isset($check['result'])){
            ?>
            <?php $this->renderPartial('/events/_submit_result',array('m_time'=>$m_time,'tri_result'=>$tri_result,'race_result'=>$race_result));?>
        <?php 
            }
            else
            {
                if(!isset($check['tri_result']))
               $this->renderPartial('/events/_your_result',array('model'=>$check['result'],'m_time'=>$m_time,'race_result'=>$race_result,'tri_result'=>$tri_result));
               else
               $this->renderPartial('/events/_your_result',array('model'=>$check['result'],'model_tri'=>$check['tri_result'],'m_time'=>$m_time,'tri_result'=>$tri_result,'race_result'=>$race_result,));
            }
        }
        else{
             $this->renderPartial('/events/_attending',array('me'=>$me,'eid'=>$model->id,'etype'=>$model->event_type,'edate'=>$model->start_date));
        }
        ?>
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">RACE INFO</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="<?php if($past==1){?>display: none;<?php }?>">
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
                    
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">RACE DETAILS</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="<?php if($past==1){?>display: none;<?php }?>">
                <?php echo $model->description;?>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="white padtopbot5">
            <a class="expand_block col-md-12" href="javascript:void(0)">
                <div class="floatLeft">EVENT FLYER</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="col-md-12 content" style="<?php if($past==1){?>display: none;<?php }?>">
            <?php
            $flyer = $files->findAllByAttributes(['event_id'=>$model->id]);
            foreach($flyer as $fl)
            {
                ?>
                <a class="pdf-anc" href="javascript:void(0)" onclick="$('.popover2 .modal-body').html('<iframe src=\'https://docs.google.com/gview?url=<?php echo urlencode(Yii::app()->createAbsoluteUrl('files/events').'/'.$fl->file);?>&embedded=true\' style=\'width:100%; height:700px;\' frameborder=\'0\'></iframe><p>');$('.popover2 .modal-title').html('<?php echo $fl->file;?>');" data-toggle="modal" data-target="#docModal"><span class="fa fa-file-pdf-o"></span><br /><?php echo $fl->file;?></a>
                <?php
            }
            ?>
            
                
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
        <?php
        if(isset($_GET['submitted']) && $_GET['submitted']=='review')
        {
            ?>
            
        <div class="alert alert-success alert-dismissible reviewMsg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Review submitted successfully.
        </div>
        <?php
        }
        ?>
        <?php
        if(isset($_GET['deleted']) && $_GET['deleted']=='review')
        {
            ?>
            
        <div class="alert alert-success alert-dismissible reviewMsg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          Review deleted successfully.
        </div>
        <?php
        }
        ?>
        <div class="white padtopbot5 reviewpad" style="border: none;padding:0;">
            
            <a class="expand_block ratinganchor col-md-12 extra_border" href="javascript:void(0)" style="padding-top: 7px;padding-bottom:7px;">
                <div class="floatLeft">RACE REVIEWS</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <div class="content col-md-12" style="<?php if($past==1){}else{?>display: none;<?php }?>">
                <?php echo $this->renderPartial('/events/_review', array('pics'=>$pics,'race_result'=>$race_result,'members'=>$members,'average'=>$average,'review'=>$review,'all_review'=>$all_review));?>
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="white padtopbot5" style="">
            
            <a href="javascript:void(0)" class="expand_block col-md-12 race-result-a">
                <div class="floatLeft">RACE RESULTS</div>
                <div class="floatRight"><span class="fa fa-angle-down"></span></div>
                <div class="clearfix"></div>
            </a>
            <?php $this->renderPartial('/events/_board',['past'=>$past,'results'=>'race_result','event_id'=>$model->id,'members'=>$members,'model'=>$model,'m_time'=>$m_time]);?>
            
            
            
            <div class="clearfix"></div>
        </div>   
        
        
        
    </div>
    <div class="clearfix"></div>
    <hr />
   
    
</div>
<div class="clearfix"></div>
<!-- Modal -->

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<?php
                            $my_rating = $review->rate; 
                            if(!$my_rating)
                            $my_rating = 0;
                            ?>
<script>
$(function(){
    initialize();
    $("#stars-default").rating('create',{coloron:'#0393D9',value:<?php echo $my_rating;?>,onClick:function(){ $('.rate_val').val(this.attr('data-rating'));}});
    <?php
    if(isset($_GET['deleted']))
    {
        ?>
        $('.reviewMsg').show();
          $('html,body').animate({
                scrollTop: $(".reviewMsg").offset().top},
                'slow');
                //alert('test');
        <?php
    }
    if(isset($_GET['submitted']))
    {
        if($_GET['submitted']=='result'){
        ?>
        $('.submitMsg').show();
        $('html,body').animate({
                scrollTop: $(".submitMsg").offset().top},
                'slow');
        <?php
        }
        else
        {
          ?>
          $('.reviewMsg').show();
          $('html,body').animate({
                scrollTop: $(".reviewMsg").offset().top},
                'slow');
                //alert('test');
          <?php  
        }
    }
    ?>
    $('.delete-review').click(function(){
       var con = confirm('Are you sure you want to delete your review?');
       var user_id = '<?php echo Yii::app()->user->id;?>';
        var event_id = '<?php echo $model->id;?>';
       if(con)
       {
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/deletereview',
            data:'user_id='+user_id+'&event_id='+event_id,
            type:'post',
            success:function(res){
                window.location = '<?php echo Yii::app()->request->baseUrl;?>/events/view/<?php echo $model->slug;?>?deleted=review';
            }
        })
       } 
    });
    $('.submit-review').click(function(){
        var review = $('.review_text').val();
        var user_id = '<?php echo Yii::app()->user->id;?>';
        var event_id = '<?php echo $model->id;?>';
        var rate = $('.rate_val').val();
        if(rate==0)
        {
            alert('You must rate atleast 1 star');
            return false;
        }
        var review_date = '<?php echo date('Y-m-d');?>'
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/submitreview',
            data:'review='+review+'&user_id='+user_id+'&event_id='+event_id+'&rate='+rate+'&review_date='+review_date,
            type:'post',
            success:function(res){
                if($('.pics').length>0)
                {
                    var pics = '';
                    $('.pics').each(function(){
                        if(pics=='')
                        {
                            pics = $(this).val();
                        }
                        else
                        pics = pics+','+$(this).val();
                        
                    })
                    if(pics){
                    $.ajax({
                    url:'<?php echo Yii::app()->request->baseUrl; ?>/events/submitpics',
                    type:'post',
                    data:'pics='+pics+'&id='+res,
                    success:function(){
                        window.location = '<?php echo Yii::app()->request->baseUrl;?>/events/view/<?php echo $model->slug;?>?submitted=review';
                    }  
                    })
                    }
                    
                }
                else{
                window.location = '<?php echo Yii::app()->request->baseUrl;?>/events/view/<?php echo $model->slug;?>?submitted=review';
                }
            }
        })
        
    });
    $('#submit_result').click(function(){
        var chec = '';
        $('.submit_input').each(function(){
                    var t_val = $(this).val();
                    t_val = parseInt(t_val);
                    if(t_val>60)
                    {
                        
                        chec = false;
                         return false;
                    }
                    else
                    {
                        
                        chec = true;
                       
                    }
                })
                //alert(chec);
                if(chec){
        var user_id = '<?php echo Yii::app()->user->id;?>';
        var event_id = '<?php echo $model->id;?>';
        var event_category = '<?php echo $model->event_cat;?>';
        var event_type = '<?php echo $model->event_type;?>';
        var result_date = '<?php echo $model->start_date;?>';
        var is_tri_swim = '0';
        var is_tri_bike = '0';
        var is_tri_run = '0';
        
        var transition_time = '0';
        var $this = '';
        var count = 0;
        var total = $('.submit_result_parent').length;
        $('.submit_result_parent').each(function(){
            count++;
            var checker = count+'_'+total;
            var distance = $(this).find('.distance').val();
            if($(this).find('.event_time_id').val())
            var event_time_id = $(this).find('.event_time_id').val();
            else
            var event_time_id = 0;
            if($(this).find('.id').val())
            var id = $(this).find('.id').val();
            else
            id = 0;
            if($('.is_tri').val()=='0')
            {
                var dist_hour = $(this).find('.hour').val();
                var dist_min = $(this).find('.min').val(); 
                var dist_sec = $(this).find('.sec').val();
                
                
            }
            else
            {
                if($(this).find('.tri_type').val() == 's')
                {
                    var dist_hour = $(this).find('.hour_s').val();
                    var dist_min = $(this).find('.min_s').val(); 
                    var dist_sec = $(this).find('.sec_s').val();
                    is_tri_swim = '1';
                    is_tri_bike = '0';
                    is_tri_run = '0';
                    transition_time = '0';
                }
                if($(this).find('.tri_type').val() == 't1')
                {
                    var dist_hour = $(this).find('.hour_t1').val();
                    var dist_min = $(this).find('.min_t1').val(); 
                    var dist_sec = $(this).find('.sec_t1').val();
                    transition_time = '1';
                    is_tri_swim = '0';
                    is_tri_bike = '0';
                    is_tri_run = '0';
                }
                if($(this).find('.tri_type').val() == 'b')
                {
                    var dist_hour = $(this).find('.hour_b').val();
                    var dist_min = $(this).find('.min_b').val(); 
                    var dist_sec = $(this).find('.sec_b').val();
                    is_tri_bike = '1';
                    is_tri_swim = '0';
                    is_tri_run = '0';
                    transition_time = '0';
                }
                if($(this).find('.tri_type').val() == 't2')
                {
                    var dist_hour = $(this).find('.hour_t2').val();
                    var dist_min = $(this).find('.min_t2').val(); 
                    var dist_sec = $(this).find('.sec_t2').val();
                    transition_time = '2';
                    is_tri_swim = '0';
                    is_tri_bike = '0';
                    is_tri_run = '0';
                }
                if($(this).find('.tri_type').val() == 'r')
                {
                    var dist_hour = $(this).find('.hour_r').val();
                    var dist_min = $(this).find('.min_r').val(); 
                    var dist_sec = $(this).find('.sec_r').val();
                    is_tri_run = '1';
                    is_tri_swim = '0';
                    is_tri_bike = '0';
                    transition_time = '0';
                }
            }
            $this = $(this);
            $this.find('.e_dis_block').each(function(){
                    $(this).find('input').each(function(){
                        $(this).val('');
                        
                    })
                 })
            $.ajax({
               url:'<?php echo Yii::app()->request->baseUrl; ?>/events/submitresult',
               type:'post',
               data:'id='+id+'&checker='+checker+'&user_id='+user_id+'&event_id='+event_id+'&event_category='+event_category+'&event_type='+event_type+'&dist_hour='+dist_hour+'&dist_min='+dist_min+'&dist_sec='+dist_sec+'&distance='+distance+'&is_tri_swim='+is_tri_swim+'&is_tri_bike='+is_tri_bike+'&is_tri_run='+is_tri_run+'&transition_time='+transition_time+'&result_date='+result_date+'&event_time_id='+event_time_id,
               success:function(res){
                if(res=='last')
                //
                $('.submit-result-form').hide();
                window.location = '<?php echo Yii::app()->request->baseUrl;?>/events/view/<?php echo $model->slug;?>?submitted=result';
               } 
            });
        });
        }
        else
        {
            return false;
        }
        
    })
    $('.expand_block').click(function(){
        
        if($(this).parent().find('.content').attr('style')=='display: none;'){
            $(this).parent().find('.searchblock').show();
        if($(this).hasClass('ratinganchor'))
        $(this).attr('style','padding-bottom:5px;padding-top:5px;border-bottom:none;');
        else    
        $(this).attr('style','border-bottom:1px solid #ccc;padding-bottom:5px;margin-bottom:5px');
        if($(this).parent().hasClass('reviewpad'))
        {
            $(this).parent().removeClass('padtopbot5');
            $(this).parent().addClass('padtop5');
        }
        $(this).parent().find('.content').show('slow');
        }
        else
        {
            if($(this).parent().hasClass('reviewpad'))
            {
                $(this).parent().addClass('padtopbot5');
                $(this).parent().removeClass('padtop5');
            }
            $(this).attr('style','padding-top: 7px;padding-bottom:7px;');
            $(this).parent().find('.content').hide('slow');
        }
    });
    $('.clearResult').click(function(){
        $('.e_dis_block').each(function(){
            $(this).find('input').each(function(){
                $(this).val('');
            })
        })
    })
})
</script>
<div class="modal fade popover2" id="docModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" style="color: #444;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Member Login</h4>
      </div>
      <div class="modal-body">
        <!-- Normal -->      
        <?php $this->renderPartial('/common/login');?>
        </div>
      
    </div>
  </div>

</div>