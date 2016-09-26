<div class="form-group white distances">
    <label class="col-md-12">Distance, time & Cost</label>
    <div class="col-md-4 start">
        Distance &nbsp; <input type="text" placeholder="000" class="three dist" /> , <input type="text" placeholder="0" class="one distance_decimal" />&nbsp; KM
        <span class="blue small">Add distances for each item</span>
    </div>
    <div class="col-md-4">
        Start Time &nbsp; <input type="text" placeholder="00" class="two start_hour" /> : <input type="text" placeholder="00" class="two start_min" />
        <span class="blue small">Start hour in 24 hour format</span>
    </div>
    <div class="col-md-4">
        COST <strong>R</strong> &nbsp; <input type="text" placeholder="0" class="four cost" /> 
        <a href="javascript:void(0)" class="btn btn-default add_distance">ADD +</a>
        <span class="blue small">Costs in Rands (Optional)</span>
    </div>
    
    <div class="clearfix"></div>
    <ul class="distance_list col-md-7" style="display: none;"></ul>
    <div class="clearfix"></div>
</div>
<div class="form-group white">
    <label class="col-md-12">Comrades Qualifier</span></label>
    
    <div class="col-md-12"><input type="checkbox" value="1" name="Events[comrade_qualifier]" /> &nbsp; YES, this is an official Comrades Marathon qualifying race.</div>
    <div class="clearfix"></div>
</div>
<script>
$('.add_distance').live('click',function(){
    //alert('test');
    
    var dist1 = $('.dist').val();
    var dist2 = $('.distance_decimal').val(); 
    var start_hour = $('.start_hour').val();
    var start_min = $('.start_min').val();
    var cost = $('.cost').val();
    
    if(!dist1)
    dist1 = '000';
    if(!dist2)
    dist2 = '0';
    if(!start_hour)
    start_hour = '00';
    if(!start_min)
    start_min = '00';
    if(!cost){
    cost = 'N/A';
    cost_val = '';
    }
    else{
    cost_val = cost;
    cost = 'R'+cost;
    
    }
    
    var str = dist1+'<input type="hidden" name="EventsTime[distance1][]" value="'+dist1+'" />,'+dist2+'<input type="hidden" name="EventsTime[distance2][]" value="'+dist2+'" />km &nbsp;|&nbsp; <span class="blue">Start</span> - '+start_hour+'<input type="hidden" name="EventsTime[event_from_hour][]" value="'+start_hour+'" />:'+start_min+'<input type="hidden" name="EventsTime[event_from_min][]" value="'+start_min+'" /> &nbsp;|&nbsp; '+ '<span class="blue">Cost</span> - '+cost + '<input type="hidden" name="EventsTime[event_cost][]" value="'+cost_val+'" /><a href="#" class="cross"><span class="fa fa-times"></span></a>'
    //alert(str);
    $('.distance_list').show()
    $('.distance_list').append('<li>'+str+'</li>');
});
</script>
