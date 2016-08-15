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
    
    <div class="col-md-12"><input type="checkbox" value="1" name="comrades" /> &nbsp; YES, this is an official Comrades Marathon qualifying race.</div>
    <div class="clearfix"></div>
</div>
<div class="form-group white">
    <label class="col-md-12">Event Info<br /><span class="blue">All the details about your event</span></label>
    
    <div class="col-md-12"><textarea class="form-control description" name="description"><?php echo $model->description;?></textarea></div>
    <div class="clearfix"></div>
</div>
<script>
$(function(){
    CKEDITOR.replace( 'description' );
    CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F5f5f5';
	
};
    $('.add_distance').click(function(){
        
       var distance = $('.dist').val();
       var distance_decimal = $('.distance_decimal').val();
       var start_hour = $('.start_hour').val();
       var start_min = $('.start_min').val();
       var cost = $('.cost').val();
       if((!distance && !distance_decimal))
       {
        $('.dist').attr('style','border-color: #a94442;');
        return false;
       }
       else
       {
        $('.dist').removeAttr('style');
        
       }
       if(!start_hour && !start_min)
        {
            $('.start_hour').attr('style','border-color: #a94442;');
             $('.start_min').attr('style','border-color: #a94442;');
             return false;
        }
        else
        {
            $('.start_hour').removeAttr('style');
            $('.start_min').removeAttr('style');
        }
        var dist = distance;
        if(distance=='')
        {
            distance = '0.'+distance_decimal;
        }
        if(start_hour=='')
        start_hour='00';
        if(start_min=='')
        start_min ='00';
        if(cost=='')
        cost = 'n/a';
        cost = 'R'+cost;
        var st = distance;
        var st = st+'km &nbsp;|&nbsp; <span class="blue">Start</span> - '+start_hour+':'+start_min+' &nbsp;|&nbsp; <span class="blue">Cost</span> - '+cost;
        $('.distance_list').show();
        $('.distance_list').append(
        '<li>'+st+'<a href="javascript:void(0)" class="delete_distance" onclick="$(this).closest(\'li\').remove();"><b class="fa fa-times"></b></a></li>'+
        '<input type="hidden" name="distance[]" value="'+dist+'" /><input type="hidden" name="distance_decimal[]" value="'+distance_decimal+'" /><input type="hidden" name="start_hour[]" value="'+start_hour+'" /><input type="hidden" name="start_min[]" value="'+start_min+'" /><input type="hidden" name="cost[]" value="'+cost.replace('R','')+'" />'
        );
       
    });
    
})
</script>