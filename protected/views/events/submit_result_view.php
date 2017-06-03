<div class="sidebar col-md-3">
  <?php echo $this->renderPartial('/sidebar/_menu', false, true); ?>
</div>
<div class="col-md-9 right-content profile_detail"> 
   
        <h1>SUBMIT RESULTS</h1>
        <strong>Submit your race results below</strong>
        <hr />
        <div class="form-group white">
        
            <label class="col-md-12">Find race event
            <br /><span class="blue">Type in race name and select a match</span>
            </label>
            
            <div class="col-md-12">
                <input class="form-control race_title" required="" placeholder="Input race name" name="race_name" value="" type="text">
                <div class="listTypeEvent"></div>
            </div>
           <div class="clearfix"></div>
        </div>
        
        <div class="form-group white">
        
            <label class="col-md-12">OR Find by date
            <br /><span class="blue">Type in race name and select a match</span>
            </label>
            
            <div class="col-md-6 cal">
                <?php $this->renderPartial('/events/_calendar',array('events'=>$events));?>
            </div>
            <div class="col-md-6">
                <h3 class="blue-heading">EVENT THIS DAY</h3>
                <strong class="blue">Select past date from calendar</strong>
                <div class="calendarList"></div>
            </div>
           <div class="clearfix"></div>
        </div>
        
        <div class="form-group white">
        
            <label class="col-md-12">21 recent past events
            <br /><span class="blue">A handful of recent past events to make submitting results easier</span>
            </label>
            
            <div class="col-md-12">
                <?php
                $events = Yii::app()->db->createCommand()
                ->select('id, slug, start_date,title')
                ->from('tbl_events')
                ->where('end_date < "'.date('Y-m-d').'" AND visible=1')
                ->order('start_date')
                ->limit(21)
                ->queryAll();
                foreach($events as $e)
                {
                    $start_date = $e['start_date'];
                    $old_date_timestamp = strtotime($start_date);
                    $new_date = date('d F Y', $old_date_timestamp);  
                    ?>
                    <a class="list21" href="<?php echo Yii::app()->request->baseUrl; ?>/events/view/<?php echo $e['slug'];?>">
                        <?php echo $e['title'];?> | <span class="blue"><?php echo $new_date;?></span>
                    </a>
                    <?php
                }
                ?>
                
            </div>
           <div class="clearfix"></div>
        </div>
 </div>       
<script>
$(function(){
    $('.anchor-left a').live('click',function(){
        $('.calendarList').html('');
        var month_year = $('.month_year').val();
        var arr = month_year.split('_');
        var mon = arr[0];
        var yea = arr[1];
        mon = parseFloat(mon);
        yea = parseFloat(yea);
        
        if(mon==1)
        {
            mon = 12;
            yea = yea-1;
        }
        else{
        mon = mon-1;
        }
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/calendar',
            data:'month='+mon+'&year='+yea,
            type:'post',
            success:function(res){
                $('.cal').html(res);
            }
        })
    });
    
    $('.anchor-right a').live('click',function(){
        $('.calendarList').html('');
        var month_year = $('.month_year').val();
        var arr = month_year.split('_');
        var mon = arr[0];
        var yea = arr[1];
        mon = parseFloat(mon);
        yea = parseFloat(yea);
        
        if(mon==12)
        {
            mon = 1;
            yea = yea+1;
        }
        else{
        mon = mon+1;
        }
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/calendar',
            data:'month='+mon+'&year='+yea,
            type:'post',
            success:function(res){
                $('.cal').html(res);
            }
        })
    });
    $('.get_events').live('click',function(){
        $('.calendarList').html('');
        var id = $(this).attr('id');
        var start_date = id.replace('_','-').replace('_','-');
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/listCalendarEvent',
            data:'start_date='+start_date,
            type:'post',
            success:function(res){
                $('.calendarList').html(res);
            }
        })
   });
   
   $('.race_title').keyup(function(){
        
        var title = $(this).val();
        //var start_date = id.replace('_','-').replace('_','-');
        $.ajax({
            url:'<?php echo Yii::app()->request->baseUrl; ?>/events/listTypeEvent',
            data:'title='+title,
            type:'post',
            success:function(res){
                $('.listTypeEvent').html(res);
            }
        })
   });
})
</script>        
        
 