<?php
$condition = new CDbCriteria;
$condition->order="title ASC";

$event_types= EventsType::model()->findAll($condition);
$event_categories= EventsCategory::model()->findAll($condition);
$visitor_profiles= EventsVisitors::model()->findAll($condition);

$all_months=Events::get_existing_month_year();

?>
<div class="event_search_form">
    <h2>EVENTS &amp; EXHIBITIONS </h2>
    <div class="line" style="margin-bottom: 0;"></div>
    <form id="select_event" method="get" action="<?php echo Yii::app()->baseUrl;?>/events/search">
    <div class="select-opt btn-toolbar cuisineList">
        <?php
        if($model)
        {
            $cur_date=date('M Y',$model->date_added);
            $default= array('label'=>ucwords($model->title), 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown','class'=>'show_label'));
        }
        else
        {   
            if(isset($_GET['date'])&& $_GET['date']!="")
                $default= array('label'=>$_GET['date'], 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown','class'=>'show_label'));
            else
                $default= array('label'=>'All Months', 'url'=>'javascript:void(0);','htmlOptions'=>array('data-toggle'=>'dropdown','class'=>'show_label'));
    
        }
        if(!empty($all_months))
        {
            foreach($all_months as $months )
            {
                $array[]=array('label'=>ucwords($months->month." ".$months->year),'url'=>'javascript:void(0);','htmlOptions'=>array('class'=>'dates')); 
            }
        }
        $this->widget('bootstrap.widgets.BootButtonGroup', array(
                'type'=>'primary', 
                'buttons'=>array(
                    $default,            
                array('items'=>$array),
                ),
                'htmlOptions'=>array('class'=>'widerButton'),
                ));
        ?>
       <input type="hidden" name="date" id="search_by_date" value="<?php if(isset($_GET['date'])){echo $_GET['date'];} ?>"/>
    </div> 
    <div class="line"></div>
    
    <div class="sec-event">
    <?php if($visitor_profiles){?>
    <?php
        foreach($visitor_profiles as $profile)
        {?><label class="checkbox">
            <input type="checkbox" class="checkbox" name="eventprofile[]" class="prof" value="<?php echo $profile->id;?>" <?php if((isset($event_profile)&& is_array($event_profile)&& in_array($profile->id,$event_profile)) || (!isset($event_profile))){?>checked="checked"<?php }?>/><?php echo $profile->title;?></label>
        <?php }
        ?>
    <?php }?>
     <div class="clear"></div>
    </div>
    <div class="line"></div>
    <div class="third-row">
    <?php if($event_categories){?>
    <?php
        foreach($event_categories as $category)
        {?><label class="checkbox">
            <input type="checkbox" class="checkbox" name="eventcat[]" class="cat" value="<?php echo $category->id;?>"<?php if((isset($event_category) && is_array($event_category) && in_array($category->id,$event_category)) || (!isset($event_category))){?>checked="checked"<?php }?>/><?php echo $category->title;?></label>
        <?php }
        ?>
    <?php }?>
     <div class="clear"></div>
    </div>
     <div class="line"></div>
     <div class="third-row">
    <?php if($event_types){?>
    <?php
        foreach($event_types as $type)
        {?><label class="checkbox">
            <input type="checkbox" class="checkbox" name="eventtype[]" class="type" value="<?php echo $type->id;?>" <?php if((isset($event_type) && is_array($event_type)&& in_array($type->id,$event_type)) || (!isset($event_type))){?>checked="checked"<?php }?>/><?php echo $type->title;?></label>
        <?php }
        ?>
    <?php }?>
    <div class="clear"></div>
    </div>
    <div class="line"></div>
    <div class="pad10 white">
    <input type="submit" name="update" value="Update Results" id="btn_update" class="btn btn-primary"/>
     <span><?php if(isset($total_results)){echo $total_results." Results";}?></span>
    <a class="clear_selection right" style="cursor: pointer; margin-top: 4px;">reset</a>
    </div>
    </form>
    <div class="line"></div>
    <div style="background: #F6F6F6; height: 10px;"></div>
    
    <div class="pad10">
    
    <form method="get" action="<?php echo Yii::app()->baseUrl;?>/events/search" id="search_event">
    
    <img src="<?php echo Yii::app()->baseUrl."/images/search.png";?>"/>
    <input type="text" name="string" id="string" placeholder="Search Events"/>
    <input type="submit" name="submit" id="btn_search" value="Search" class="btn btn-info"/>
    <div id="event_error" class="error" style="display: none;">Search string is required!</div>
    </form>
    </div>
</div>
<script>
$(document).ready(function(){
   $('.clear_selection').click(function(){
        //console.log('clicked');
        $('.checkbox').each(function(){
            //alert($(this).val());
            $(this).attr('checked','checked');
        });
   }); 
   
   $('#search_event').submit(function(){
        if($('#string').val() == "")
        {
            $('.error').show();
            return false;
        }
   });
   
   $('#string').keyup(function(){
        $('#event_error').hide();
   });
   
    $('.dropdown-menu li').click(function(){
        var value=$(this).children('a').html();
        $('.show_label').html(value);
        $('#search_by_date').val(value);
    });
    
    
    $('#showall_search').click(function(){
         
        <?php if(isset($_GET['update']))
        {?>
        
        $('#select_event').get(0).setAttribute('action', '<?php echo Yii::app()->baseUrl;?>/events/search/showall');
        $('#btn_update').click();
        <?php }
        else {?>
        $('#search_event').get(0).setAttribute('action', '<?php echo Yii::app()->baseUrl;?>/events/search/showall');
        $('#string').val('<?php echo $_GET['string'];?>');
        $('#btn_search').click();
        <?php }?>
        return false;
        
        
    });
});
</script>