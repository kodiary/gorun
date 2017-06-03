<div id="branchInfo" class="restaurants_infos" style="display:none;">
<?php 
if($branches){
foreach($branches as $model)
{ ?>
    <h2 class="border_tagLine"><span class="blue"><?php echo ucfirst($model->name); ?></span></h2>
    <div class="margintopbot10">
    <div class="left fl_left">
        <ul class="contact_info">
        	<li class="call"><p><span class="blue"><?php echo $model->number; ?></span></p></li>
            <li class="address">
            <?php 
                if($model->display_address=='')
                {
                    $contactAddress = ucwords(nl2br($model->street_add));
                    if($model->suburb) $contactAddress .= ", ".ucwords($model->suburb);
                    if($country_name) $contactAddress .= ", ".ucwords($country_name);
                }
                else
                {
                    $contactAddress = ucwords(nl2br($model->display_address));           
                }
            ?>
        	<p><?php echo $contactAddress;?></p>
            </li>
            <li class="contact_details">
                <p><?php if($model->fax!="") echo "Fax: ".$model->fax;?></p>
                <p><?php if($model->email!=""){?> E-mail: <a href="mailto:<?php echo $model->email;?>"><?php echo $model->email;?></a><?php }?></p>
                <p><?php if($model->manager!="") echo "<strong><span class='blue'>Branch Manager: ".$model->manager.'</span></strong>';?></p>
            </li>
        </ul>
    </div>
    
    <div class="right fl_right">
        <input type="hidden" id="lat_<?php echo $model->id; ?>" value="<?php echo $model->latitude; ?>"/>
        <input type="hidden" id="long_<?php echo $model->id; ?>" value="<?php echo $model->longitude; ?>"/>
        <?php if($model->latitude!=0 && $model->longitude!=0)
        {
            $province_name = Province::model()->findByPk($model->province)->name;
            ?>
            <div class="thumbnail">
                <div style="width: 312px; height:312px;" class="branchMap" id="<?php echo $model->id;?>"></div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="clear"></div>
    </div> 
<?php }} ?>
</div>

<script type="text/javascript">
/* <![CDATA[ */
 function initializeGMap(elementId) {
    var latlng=new google.maps.LatLng($('#lat_'+elementId).val(),$('#long_'+elementId).val())
    var myOptions = {
    zoom: 15,
    center:latlng ,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById(elementId), myOptions);
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