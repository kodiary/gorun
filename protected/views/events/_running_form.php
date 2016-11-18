<div class="form-group white distances">
    <label class="col-md-12">Distance, time & Cost</label>
    <div class="col-md-4 start">
        Distance &nbsp; <input type="text" placeholder="000" class="three dist" name="EventsTime[distance1][]" /> , <input type="text" placeholder="0" class="one distance_decimal" name="EventsTime[distance2][]" />&nbsp; KM
        <span class="blue small">Add distances for each item</span>
    </div>
    <div class="col-md-4">
        Start Time &nbsp; <input type="text" placeholder="00" class="two start_hour" name="EventsTime[event_from_hour][]" /> : <input type="text" placeholder="00" class="two start_min" name="EventsTime[event_from_min][]" />
        <span class="blue small">Start hour in 24 hour format</span>
    </div>
    <div class="col-md-4">
        COST <strong>R</strong> &nbsp; <input type="text" placeholder="0" class="four cost" name="EventsTime[event_cost][]" /> 
        <!--<a href="javascript:void(0)" class="btn btn-default add_distance">ADD +</a>-->
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

