<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/player/mediaelement-and-player.min.js');?>
<?php
$this->breadcrumbs=array(
	'events'=>array('index'),
	$model->slug,
);?>
<?php /*if(strtotime($model->start_date.' '.$model->start_time) < time()){
    $past_event_status = 1;
 }else $past_event_status = 0;*/?>

<aside class="body_content_left events">
<div class="line"></div>
  <h1><?php echo  $model->title;?></h1>
   <div class="red mem-type"><?php echo CommonClass::formatDate($model->start_date, 'd F Y').(($model->start_date!=$model->end_date && $model->end_date!="0000-00-00")?(" - ".CommonClass::formatDate($model->end_date, 'd F Y')):"");?></div>
    <div class="line" style="margin-bottom: 6px;"></div>
  <div class="left" style="height: 20px; overflow:hidden;">  <!--AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style floatLeft"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff40ba15baa7303"></script> 
    
     </div><!-- AddThis Button END -->
    <div class="floatRight eye">
        <?php echo $model->readcount;?>
    </div>
    <div class="clear"></div>
 
  <div class="line"></div>
  <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
  <!-- past event message -->
    <div class="left events-left">
    <section class="articleContent"> <?php echo $model->description;?> </section>
    <!--articleContent-->

    <div class="line"></div>

    <?php $event_org_detail=Events::get_org_details($model->id,$model->organiser);?>
    <div class="number-new left" style="margin-top:8px;"><?php echo $event_org_detail->contact; ?></div>
    <div class="right" style="margin: 5px 0;">
        <a href="javascript:void(0);" class="btn btn-primary btn-large" onclick='$("#contactTo").html("To <?php echo ucwords($model->title);?>");$("#contactFor").val("<?php echo ucwords($model->title);?>");$("#toEmail").val("<?php echo $event_org_detail->email?>"); $("#contactModal").modal("show");'>Contact</a>
    </div>
    <div class="clear"></div>
    <div class="line"></div>

    <!--exhibition date-->
    <?php if($model->start_date!='0000-00-00'){ ?>
        <div>
            <p><span class="label label-info">DATE</span></p>
            <strong>
                <?php echo CommonClass::formatDate($model->start_date, 'd F Y'); if($model->end_date!='0000-00-00') echo " - " . CommonClass::formatDate($model->end_date, 'd F Y'); ?>
            </strong>
            
        </div>
        <div class="line"></div>
    <?php } ?>
    <!--exhibition date-->
    
    <!--exhibition hours-->    
    <?php if(!empty($event_time)){ ?>
        <div  class="ex-hours">
            <ul class="opening_hours">
                <li class="opening_hours_title">
                    <p><span class="label label-info">EXHIBITION HOURS</span></p>
                </li>
                <?php foreach($event_time as $time){?>
                    <li><div class="dates left"><?php echo CommonClass::formatDate($time->on_date,"l, d F Y");?></div> <div class="times right"><?php echo strtolower($time->from." to ".$time->to);?></div><div class="clear"></div></li>
                <?php }?>
            </ul>
        </div>
        <div class="line"></div>
    <?php } ?>
    
    <!--exhibition hours-->
    
    <!--exhibition venue-->
    <?php if($event_venue){ ?>
        <div class="event-venue">
            <p><span class="label label-info">VENUE</span></p>
            <?php $this->renderPartial('_map',array('model'=>$event_venue));?>
        </div>
        <div class="line"></div>
    <?php }?>
    <!--exhibition venue-->

    <!--exhibition website-->
    <?php if($event_org_detail->website!=''){ ?>
        <span class="label label-info">WEBSITE</span>
        <a class="link" style="display: inline-block ; margin:8px 0 13px 10px;" href="<?php echo $event_org_detail->website;?>" target="_blank"><?php echo $event_org_detail->website;?></a>
        
    <?php }?>
    <!--exhibition website-->
    
   
    </div><!-- left body -->
    
    
    <div class="right events-right">
        <?php
        if($model->logo!="")
        {
            $imagefile=Yii::app()->baseUrl."/images/frontend/full/".$model->logo;
        }
        else
        {
            $imagefile=Yii::app()->baseUrl."/images/events_fallback_full.png";
        } 
        ?>
        <div class="thumbnail">
        <img src="<?php echo $imagefile;?>" alt="exhibition image"/>
        </div>
        
        <?php
            if($model->organiser!=0)
            {
                $companyModel = Company::model()->findByPk($model->organiser);
                if($companyModel){
                    $companyMemberModel = CompanyMember::getMemberByCompany($companyModel->id);
                    if($companyMemberModel){ //now check for member_type [1=>organisers;3=>venues]
                        if(in_array('1',$companyMemberModel) || in_array('3',$companyMemberModel)){ ?>
                        
                            <div class="exsa-mem">
                                <img src="<?php echo Yii::app()->baseUrl."/images/exsa_member.jpg";?>" alt="Exsa Member"/>
                            </div>    
                        
                        <?php } 
                    }
                }
            }
        ?>
        
    </div>
    <div class="clear"></div>
    
    
     <!--exhibition's member's social media detail-->
    <?php
    if($model->organiser!=0)
    {
        $companyModel = Company::model()->findByPk($model->organiser);
        if($companyModel){ ?>
        
            <!--social media-->
            <div class="social-icons-new">
                <?php if($companyModel->facebook!=""){?><a href="<?php echo $companyModel->facebook; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/facebook.gif" alt="Facebook" /></a><?php } ?>
                <?php if($companyModel->twitter!=""){?><a href="<?php echo $companyModel->twitter; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/twitter.gif" alt="Twitter" /></a><?php } ?>
                <?php if($companyModel->pinterest!=""){?><a href="<?php echo $companyModel->pinterest; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pinterest.gif" alt="Pinterest" /></a><?php } ?>
                <?php if($companyModel->google!=""){?><a  style="margin: 0;" href="<?php echo $companyModel->google;?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gplus.gif" alt="GooglePlus" /></a><?php } ?>
            <div class="clear"></div>
            </div>
            <!--social media-->
            
        <?php }
    }
    ?>
    <!--exhibition's members's social media detail-->
    
    <!--exhibition's inputted organizer detail-->
    <div class="org">
    <?php if($org_detail = Organisers::model()->findByAttributes(array('event_id'=>$model->id))){ ?>
            <p><span class="label label-info">ORGANISER DETAILS</span></p>
            <div class="blue" style="margin-bottom: 5px;"><strong><?php echo $org_detail->title;?></strong></div>
            <p><strong>Telepone: <span class="blue"><?php echo $org_detail->contact_number;?></span></strong></p>
            <p><strong>Email: <span class="blue"><?php echo $org_detail->contact_email;?></span></strong></p>
            <?php if($org_detail->website!=''){?>
                <p><strong>Website: <span><a href="<?php echo $org_detail->website;?>" target="_blank" class="blue"><?php echo $org_detail->website;?></a></span></strong></p>
            <?php } ?>
    <?php } ?>
    </div>
    <!--exhibition's inputted organizer detail-->
    
    
    
    <?php if($model->organiser!=0)
    {
        $company=Company::model()->findByPk($model->organiser);
        $this->renderPartial('application.views.directory._view',array('data'=>$company));
    }?>

    <div class="articleNavigation">
    <?php $prev_event = Events::prev_event_by_slug($model->id);
    $next_event = Events::next_event_by_slug($model->id);?>
    
        <?php if(is_object($prev_event)){ $title = ucwords(strtolower($prev_event->title)); ?>
            <aside class="prevLink left">
                <?php echo CHtml::link($title, $this->createUrl('events/'.$prev_event->slug)); ?>
            </aside>
        <?php } ?> <!--prevLink-->
    
    
      <?php if(is_object($next_event)){ $title = ucwords(strtolower($next_event->title)); ?>
            <aside class="nextLink right">
                <?php echo CHtml::link($title, $this->createUrl('events/'.$next_event->slug)); ?>
            </aside>
      <?php } ?> <!--nextLink-->
        
    <div class="clear"></div>
  </div>
  <!--articleNavigation-->
  
  <div class="bottom_prev_next_paginations">
    <div class="lefts_g"></div>
    <div class="right_g"></div>
    <div class="clear"></div>
  </div>
</aside>
<!--leftContainer-->

<aside class="body_content_right">
    <?php $this->renderPartial('_eventSearchForm');?>
</aside>
<div class="clear"></div>