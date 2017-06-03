<div id="mapInfo" style="display:none;">
<div class="line" style="margin-top: 0;"></div>
<div class="left" style="width: 45%; margin:10px;">
    <div class="blue">Physical Address</div>
    <div><?php echo nl2br($model->display_address); ?></div>
</div>
<div class="left"  style="width: 45%; margin:10px;">
    <div class="blue">Postal Address</div>
    <div><?php echo nl2br($model->postal_address); ?></div>
</div>
<div class="clear"></div>

 <?php 
    if($model->latitude!=0 && $model->longitude!=0)
    {
    ?>
    <div class="thumbnail">
    	<div style="width: 590px; height:340px; position:relative;" id="restro-map"></div>
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