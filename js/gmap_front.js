/* 
* GMap V3 Geocoding 
* @author : Ambika
* 2012
*/
var base_url="http://localhost/gorun/";
var geocoder = new google.maps.Geocoder();
  var map;
  var marker;
  var image = new google.maps.MarkerImage(
                base_url+'images/map_pin.png'
              );
            
    var shadow = new google.maps.MarkerImage(
                base_url+'images/shadow.png',
                new google.maps.Size(52,40),
                new google.maps.Point(0,0),
                new google.maps.Point(14,40)
              );
  function initialize() {
    var lat_value=document.getElementById('Company_latitude').value; 
    var long_value=document.getElementById('Company_longitude').value;
    //set latlang to Johannesburg, South Africa initially
    if(lat_value=='0' || lat_value=="" )
    {
         lat_value=-26.2041028;
    }
    if(long_value=='0' || long_value=='')
    {
         long_value=28.047305100000017;
    }
    //alert(lat_value);
    var latlng = new google.maps.LatLng(lat_value, long_value);
    var myOptions = {
      zoom: 14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    marker = new google.maps.Marker({
    position: latlng,
    //title: $('#formattedAddress').val(),
    map: map,
    draggable: false,
    icon: image,
    //shadow: shadow,
  });
   
  //geocodePosition(latlng);

  }
