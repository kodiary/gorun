
<div id="mapInfo" style="width:100%;height:200px;margin-bottom:20px;">
 <?php 
    if($model->latitude!=0 && $model->longitude!=0)
    {
    ?>
    <div class="thumbnail">
    	<div style="width: 100%; height:200px; position:relative;" id="restro-map"></div>
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
    zoom: 15,
    center:latlng ,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("restro-map"), myOptions);
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
<div class="clearfix"></div>