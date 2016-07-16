<div id="mapInfo">

 <?php 
    if($model->latitude!=0 && $model->longitude!=0)
    {?>
        <div class="event-address">
        <p style="margin-bottom: 0;"><strong><?php echo $model->title;?></strong></p>
            <p><strong><?php echo $model->address;?>, <?php echo $model->city;?>, <?php echo Province::model()->findByPk($model->region)->name;?></strong></p>
            <div id="show_event_map"><strong>View Map</strong></div>
        </div>
        <div id="map_view" style="display: none;"><!--style="display: none;"-->
        <div class=" view_maps">
        	<div style="width: 590px; height:340px; position:relative;" id="event-map"></div>
        </div>
        </div>
    <?php
    }
    ?>
</div>

<script type="text/javascript">
/* <![CDATA[ */
 function initialize() {
    var latlng=new google.maps.LatLng(<?php echo $model->latitude; ?>,<?php echo $model->longitude; ?>)
    var myOptions = {
    zoom: 13,
    center:latlng ,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("event-map"), myOptions);
  var marker = new google.maps.Marker({
    position: latlng,
    //title: 'Johannesburg, South Africa',
    map: map,
    draggable: false,
    icon: '<?php echo Yii::app()->baseUrl?>/images/map_pin.png'
  });
  
}
/* ]]> */
</script>
<script>
$(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize);
    
    $('#show_event_map').click(function(){
        
        if($('#map_view').is(':hidden'))
        {
            $('#map_view').css('display','block');
            initialize();
        }
        else
        {
            $('#map_view').hide();
        }

          
    });

});
</script>