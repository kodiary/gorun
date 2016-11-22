<div class="attending">
    <div class="col-md-3">ATTENDING?</div>
    <div class="col-md-9"><a href="javascript:void(0)" class="yes <?php if($me->going == 1){?>bg-blue<?php }else{?>bg-grey<?php }?> going" id="yes">Yes</a><a id="no" href="javascript:void(0)" class="no <?php if($me->going == 1){?>bg-grey<?php }else{?>bg-blue<?php }?> going">No</a> <span class="blue attending-msg">Let other know you will be racing!</span></div>
    <div class="clearfix"></div>
</div>
<script>
$(function(){
   $('.going').click(function(){
    var going = '';
    if($(this).attr('id') == 'yes')
    {
        going = '1';
    }
    else
    {
        going = '0'
    }
    if(going=='1')
    {
        $('#yes').removeClass('bg-grey');
        $('#yes').addClass('bg-blue');
        $('#no').removeClass('bg-blue');
        $('#no').addClass('bg-grey');
    }
    else
    {
        $('#no').removeClass('bg-grey');
        $('#no').addClass('bg-blue');
        $('#yes').removeClass('bg-blue');
        $('#yes').addClass('bg-grey');
    }
    
    $.ajax({
       url:'<?php echo Yii::app()->request->baseUrl; ?>/events/going',
       data:'going='+going+'&event_id=<?php echo $eid;?>&event_type=<?php echo $etype;?>&event_date=<?php echo $edate;?>&id=<?php echo $me->id;?>',
       type:'post', 
    });
   }) 
});
</script>