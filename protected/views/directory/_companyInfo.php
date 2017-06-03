<?php 
    $id = $model->id;
    $name = $model->name;
    $logo = $model->logo;
    $logo_url = Yii::app()->baseUrl."/images/no_image_large.jpg";  
    if($logo!="") 
    {
       if(file_exists(Yii::app()->basePath.'/../images/frontend/main/'.$logo))
        {
          $logo_url=Yii::app()->baseUrl."/images/frontend/main/".$logo;  
        } 
    }
    $desc = $model->detail;
    $address='';
    $province_name = Province::model()->findByPk($model->province)->name;
    if($province_name!='') $address = $province_name;
    $membership=$model->membership;
    if($membership)
    {
       foreach($membership as $member)
        {
            $member_type.=MemberType::model()->findByPk($member->member_id)->type_name.', ';
        } 
    }
?>

<div class="restaurants_infos">
<div class="line"></div>
    <h1><?php echo $name;?></h1>
    <div class="mem-type"><?php echo trim($member_type,', ');?></div>
    <div class="line" style=" margin-bottom: 6.5px;"></div>
    <div class="fl_left" style="height: 20px; overflow:hidden;">
        <!-- AddThis Button BEGIN --> 
        <div class="addthis_toolbox addthis_default_style">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
        </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fcdb85f3b3ac97d"></script>
        <!-- AddThis Button END -->
    </div>
        <div class="eye right"><?php echo number_format(CompanyViews::model()->count('company_id='.$model->id)); ?></div>

    <div class="clear"></div>
    <div class="line" style="border-top: 0;"></div>
	<div class="restaurants_info_left">
	<ul class="address">
        <li class="add_1"><?php echo $address;?></li>
        <li style="margin:2px 0;">
        <div class="fl_left number-new"><?php echo $model->number; ?></div>
        <div class="fl_right">
            <?php
             echo CHtml::ajaxButton('Contact',
                        $this->createUrl('countContact'),
                         array( //ajax options
                            'data'=>array('slug'=>$slug),
                            'type'=>'POST',
                            'success'=>'js:function(data){
                                     $("#btnContact").val("Contact");
                                     $("#contactTo").html("To "+data);
                                     $("#contactFor").val(data);
                                     $("#toEmail").val("'.$model->email.'");
                                     $("#contactModal").modal("show");
                                    }',
                        ),
                        array('id'=>'btnContact','class'=>'btn btn-primary btn-large','onclick'=>'$(this).val("loading...");')//html options
            );?>
        </div>
        <div class="clear"></div>
        </li>
        <?php if(trim($model->fax)!=""){?>
        <li style="margin-top: 0;"><?php echo "Fax: ".$model->fax;?></li>
        <?php } ?>
        <div class="line"></div>
         <li class="address">
            <?php 
            if($model->display_address=='')
            {
                $contactAddress = ucwords(nl2br($model->street_add));
                if($model->suburb) $contactAddress .= ", ".ucwords($model->suburb);
                if($country_name) $contactAddress .= ", ".ucwords($country_name);
            }
            else
            {
                $contactAddress = ucwords(nl2br($model->display_address));           
            }
            ?>
        	<p><strong><?php echo $contactAddress;?></strong></p>
       </li>
       <li class="view_maps"><?php echo CHtml::link('View map', "javascript:void(0)", array('id'=>'view-map', 'class'=>'restro-detail'));?></li>
       <?php
        if(trim($model->website)!="" && trim($model->website)!="http://")
        {
                $website=$model->website;
                if(stripos($model->website,'http://')===false)
                {
                    $website="http://".$model->website;
                }
        ?> 
        <div class="line"></div>      
       	<li><a class="link" href="<?php echo $website;?>" target="_blank"><?php echo $model->website;?></a></li>
        <?php }?>
    </ul>
</div>
<div class="restaurant_info_right">
<div id="logo">
    <div class="thm thumbnail"><?php echo Company::Image($logo, 'main', $name." logo");?></div>   
</div>  
</div>
<div class="clear"></div>

<?php if($model->facebook!="" || $model->twitter!="" || $model->pinterest!="" || $model->google!=""){ ?>
    <div class="social-icons"><!--social media -->
        <?php if($model->facebook!=""){?><a style="margin: 0;" href="<?php echo $model->facebook; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/facebook.gif" alt="Facebook" /></a><?php } ?>
        <?php if($model->twitter!=""){?><a href="<?php echo $model->twitter; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/twitter.gif" alt="Twitter" /></a><?php } ?>
        <?php if($model->pinterest!=""){?><a href="<?php echo $model->pinterest; ?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pinterest.gif" alt="Pinterest" /></a><?php } ?>
        <?php if($model->google!=""){?><a href="<?php echo $model->google;?>" class="" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gplus.gif" alt="GooglePlus" /></a><?php } ?>
    <div class="clear"></div>
    </div>
<?php } ?>

</div><!--#restaurants_infos-->
<!-- Restaurant tabs -->
<div class="restaurants_menus menuadj">
    <!--start menu-->
    <ul class="nav nav-pills">
    <?php $tabUrl = 'javascript:void(0)';?>
        <li class="<?php echo 'active';?>">
            <?php echo CHtml::link('About', $tabUrl, array('id'=>'aboutTab', 'class'=>'restro-detail'));?>
        </li>
    
        <li>
            <?php echo CHtml::link('News', $tabUrl, array('id'=>'newsTab', 'class'=>'restro-detail'));?>
        </li>
    
        <?php if($brochures){?>
        <li>
            <?php echo CHtml::link('Brochures', $tabUrl, array('id'=>'brochureTab', 'class'=>'restro-detail'));?>
        </li>
        <?php } ?>
        
        <?php if($videos){?>
        <li>
            <?php echo CHtml::link('Videos', $tabUrl, array('id'=>'videoTab', 'class'=>'restro-detail'));?>
        </li>
        <?php } ?>
        
        <li><?php echo CHtml::link('Exhibition & Events', $tabUrl, array('id'=>'eventsTab', 'class'=>'restro-detail'));?></li>
        
        <li>
            <?php echo CHtml::link('Map', $tabUrl, array('id'=>'mapTab', 'class'=>'restro-detail'));?>
        </li>
         <!--<li>
            <?php //echo CHtml::link('Jobs', $tabUrl, array('id'=>'jobsTab', 'class'=>'restro-detail'));?>
        </li>-->
    
    </ul>
    <div class="clear"></div>
    <!-- end menu-->
</div>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
    
    $(".restro-detail").click(function(){
        $('.nav-pills li').each(function(index) {
             $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
        
        $("#infoTab").hide();
        $("#aboutInfo").hide();
        $("#brochureInfo").hide();
        $("#mapInfo").hide();
        $("#videoInfo").hide();
        $('#newsInfo').hide();
        $('#eventsInfo').hide();
        $('#jobsInfo').hide();
        
        if(this.id=='aboutTab')
        {
            $("#aboutInfo").show();
        }
        if(this.id=='brochureTab')
        {
            $("#brochureInfo").show();
        }     
        if(this.id=='mapTab' || this.id=='view-map')
        {
            if(this.id=='view-map')
            {
                $("#mapTab").parent().addClass('active');
            }
            $("#mapInfo").show();
            initialize();
        }
        if(this.id=='videoTab')
        {
            $("#videoInfo").show();
        }
        if(this.id=='newsTab')
        {
            $("#newsInfo").show();
        }
        if(this.id=='eventsTab')
        {
            $("#eventsInfo").show();
        }
        if(this.id=='jobsTab')
        {
            $("#jobsInfo").show();
        }
        
    });  
});
//]]>
</script>
<script type="text/javascript">
 //<![CDATA[
 var jbexpandId;

 $(document).ready(function(){

    var firstJob=$('#job li:first').attr('id');
    $('#short_'+firstJob).hide();
    $('#long_'+firstJob).show();
    jbexpandId=firstJob;
        
    window.onload = function() {
        var hash = window.location.hash; // would be "#div1" or something
        if(hash != "" && hash.charAt(1)!='.') 
        {
            var id = hash.substr(1); // get rid of #
            jbexpandId=id;
            document.getElementById('short_'+id).style.display = 'none';
            document.getElementById('long_'+id).style.display = 'block';
            location.href = '#' + id; 
        }
    }

    $('.jbexpand').click(function(){
        var val = $(this).attr('id').split("_");
        var jobid = val[1];
        $('.jbexpanded').slideUp('200');
        if(jbexpandId)
        {
          $('#short_'+jbexpandId).slideDown('200');
        }
        $('#short_'+jobid).slideUp('200');
        $('#long_'+jobid).slideDown('200');
        jbexpandId=jobid;
    });
 });
 //]]>
</script>