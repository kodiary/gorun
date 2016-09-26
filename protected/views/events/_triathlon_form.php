<div class="form-group white distances">
    <label class="col-md-12">Distance, time & Cost</label>
    <div class="col-md-4 start">
        <div><span class="dist_lab">SWIM</span><input type="text" placeholder="000" class="three dist1" name="EventsTime[distance_swim_1]" /> , <input type="text" placeholder="0" class="one distance_decimal1" name="EventsTime[distance_swim_2]" />&nbsp; KM
        
        </div>
        <div><span class="dist_lab">BIKE</span><input type="text" placeholder="000" class="three dist2" name="EventsTime[distance_bike_1]" /> , <input type="text" placeholder="0" class="one distance_decimal2" name="EventsTime[distance_bike_2]" />&nbsp; KM
        
        </div>
        <div><span class="dist_lab">RUN</span><input type="text" placeholder="000" class="three dist3" name="EventsTime[distance_run_1]" /> , <input type="text" placeholder="0" class="one distance_decimal3" name="EventsTime[distance_run_2]" />&nbsp; KM
        
        </div>
    </div>
    <div class="col-md-4">
        Start Time &nbsp; <input type="text" placeholder="00" class="two start_hour" name="EventsTime[event_from_hour]" /> : <input type="text" placeholder="00" class="two start_min" name="EventsTime[event_from_min]" />
        <span class="blue small">Start hour in 24 hour format</span>
    </div>
    <div class="col-md-4">
        COST <strong>R</strong> &nbsp; <input type="text" placeholder="0" class="four cost" name="EventsTime[event_cost]" /> 
        <a href="javascript:void(0)" class="btn btn-default add_distance">ADD +</a>
        <span class="blue small">Costs in Rands (Optional)</span>
    </div>
    
    <div class="clearfix"></div>
    <ul class="distance_list col-md-12" style="display:none;"></ul>
    <div class="clearfix"></div>
</div>
<script>
$('.add_distance').live('click',function(){
    //alert('test');
    
    var dist1 = $('.dist1').val();
    var dist2 = $('.distance_decimal1').val(); 
    var dist3 = $('.dist2').val();
    var dist4 = $('.distance_decimal2').val(); 
    var dist5 = $('.dist3').val();
    var dist6 = $('.distance_decimal3').val(); 
    var start_hour = $('.start_hour').val();
    var start_min = $('.start_min').val();
    var cost = $('.cost').val();
    
    if(!dist1)
    dist1 = '000';
    if(!dist3)
    dist2 = '000';
    if(!dist5)
    dist3 = '000';
    if(!dist2)
    dist2 = '0';
    if(!dist4)
    dist4 = '0';
    if(!dist6)
    dist6 = '0';
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
    
    var str = '<strong>SWIM</strong>: '+dist1+'<input type="hidden" name="EventsTime[distance_swim_1][]" value="'+dist1+'" />,'+dist2+'<input type="hidden" name="EventsTime[distance_swim_2][]" value="'+dist2+'" />km / <strong>BIKE</strong>: '+dist3+'<input type="hidden" name="EventsTime[distance_bike_1][]" value="'+dist3+'" />,'+dist4+'<input type="hidden" name="EventsTime[distance_bike_2][]" value="'+dist4+'" />km / <strong>RUN</strong>: '+dist5+'<input type="hidden" name="EventsTime[distance_run_1][]" value="'+dist5+'" />,'+dist6+'<input type="hidden" name="EventsTime[distance_run_2][]" value="'+dist6+'" />km  &nbsp;|&nbsp; <span class="blue">Start</span> - '+start_hour+'<input type="hidden" name="EventsTime[event_from_hour][]" value="'+start_hour+'" />:'+start_min+'<input type="hidden" name="EventsTime[event_from_min][]" value="'+start_min+'" /> &nbsp;|&nbsp; '+ '<span class="blue">Cost</span> - '+cost + '<input type="hidden" name="EventsTime[event_cost][]" value="'+cost_val+'" /><a href="#" class="cross"><span class="fa fa-times"></span></a>';
    //alert(str);
    $('.distance_list').show()
    $('.distance_list').append('<li>'+str+'</li>');
});
</script>
