<?php if($model){$model = $model[0];}?>
<div class="form-group white distances">
    <label class="col-md-12">Distance, time & Cost</label>
    <div class="col-md-4 start">
        <div><span class="dist_lab">SWIM</span><input type="text" placeholder="000" class="three dist1" name="EventsTime[distance_swim_1][]" value="<?php if($model && $model->distance_swim_1){echo $model->distance_swim_1;}?>" /> , <input type="text" placeholder="0" class="one distance_decimal1" name="EventsTime[distance_swim_2][]" value="<?php if($model && $model->distance_swim_2){echo $model->distance_swim_2;}?>" />&nbsp; KM
        
        </div>
        <div><span class="dist_lab">BIKE</span><input type="text" placeholder="000" class="three dist2" name="EventsTime[distance_bike_1][]" value="<?php if($model && $model->distance_bike_1){echo $model->distance_bike_1;}?>" /> , <input type="text" placeholder="0" class="one distance_decimal2" name="EventsTime[distance_bike_2][]" value="<?php if($model && $model->distance_bike_2){echo $model->distance_bike_2;}?>" />&nbsp; KM
        
        </div>
        <div><span class="dist_lab">RUN</span><input type="text" placeholder="000" class="three dist3" name="EventsTime[distance_run_1][]" value="<?php if($model && $model->distance_run_1){echo $model->distance_run_1;}?>" /> , <input type="text" placeholder="0" class="one distance_decimal3" name="EventsTime[distance_run_2][]" value="<?php if($model && $model->distance_run_1){echo $model->distance_run_2;}?>" />&nbsp; KM
        
        </div>
    </div>
    <div class="col-md-4">
        Start Time &nbsp; <input type="text" placeholder="00" class="two start_hour" name="EventsTime[event_from_hour][]" value="<?php if($model && $model->event_from_hour){echo $model->event_from_hour;}?>" /> : <input type="text" placeholder="00" class="two start_min" name="EventsTime[event_from_min][]" value="<?php if($model && $model->event_from_min){echo $model->event_from_min;}?>" />
        <span class="blue small">Start hour in 24 hour format</span>
    </div>
    <div class="col-md-4">
        COST <strong>R</strong> &nbsp; <input type="text" placeholder="0" class="four cost" name="EventsTime[event_cost][]" value="<?php if($model && $model->event_cost){echo $model->event_cost;}?>" /> 
        <!--<a href="javascript:void(0)" class="btn btn-default add_distance">ADD +</a>-->
        <span class="blue small">Costs in Rands (Optional)</span>
    </div>
    
    <div class="clearfix"></div>
    <ul class="distance_list col-md-12" style="display:none;"></ul>
    <div class="clearfix"></div>
</div>

