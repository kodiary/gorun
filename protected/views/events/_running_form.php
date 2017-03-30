<div class="form-group white distances">
    <label class="col-md-12">Distance, time & Cost</label>
    <div class="col-md-4 start">
        Distance &nbsp; <input type="text" placeholder="000" class="three dist" /> , <input type="text" placeholder="0" class="one distance_decimal" name="EventsTime[distance2][]" />&nbsp; KM
        <span class="blue small">Add distances for each item</span>
    </div>
    <div class="col-md-4">
        Start Time &nbsp; <input type="text" placeholder="00" class="two start_hour" /> : <input type="text" placeholder="00" class="two start_min" name="EventsTime[event_from_min][]" />
        <span class="blue small">Start hour in 24 hour format</span>
    </div>
    <div class="col-md-4">
        COST <strong>R</strong> &nbsp; <input type="text" placeholder="0" class="four cost" /> 
        <a href="javascript:void(0)" class="btn btn-default add_distance1">ADD +</a>
        <span class="blue small">Costs in Rands (Optional)</span>
    </div>
    
    <div class="clearfix"></div>
    <ul class="distance_list col-md-7" <?php if(!$model){?>style="display: none;"<?php }?>>
        <?php
        if($model)
        {
            foreach($model as $m)
            {
                ?>
                <li><?php echo $m->distance1?><input name="EventsTime[distance1][]" value="<?php echo $m->distance1?>" type="hidden">,<?php echo $m->distance2?><input name="EventsTime[distance2][]" value="<?php echo $m->distance1?>" type="hidden">km &nbsp;|&nbsp; <span class="blue">Start</span> - <?php echo $m->event_from_hour?><input name="EventsTime[event_from_hour][]" value="<?php echo $m->event_from_hour?>" type="hidden">:<?php echo $m->event_from_min?><input name="EventsTime[event_from_min][]" value="<?php echo $m->event_from_min?>" type="hidden"> &nbsp;|&nbsp; <span class="blue">Cost</span> - R<?php echo $m->event_cost?><input name="EventsTime[event_cost][]" value="<?php echo $m->event_cost?>" type="hidden"><a href="#" class="cross"><span class="fa fa-times"></span></a></li>
                <?php
            }
        }
        ?>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="form-group white">
    <label class="col-md-12">Comrades Qualifier</span></label>
    
    <div class="col-md-12"><input type="checkbox" <?php if($event && $event->comrade_qualifier){?>checked<?php }?> value="1" name="Events[comrade_qualifier]" /> &nbsp; YES, this is an official Comrades Marathon qualifying race.</div>
    <div class="clearfix"></div>
</div>

