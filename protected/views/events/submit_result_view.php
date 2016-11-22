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
                <input class="form-control" required="" placeholder="Input race name" name="race_name" value="" type="text">
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
            </div>
           <div class="clearfix"></div>
        </div>
 </div>       
<script>
$(function(){
    $('.anchor-left a').live('click',function(){
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
})
</script>        
        
 