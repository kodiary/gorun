/* 
* GMap V3 Geocoding 
* @author : Bikash Shrestha Desar
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
  function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerPosition(latlng) {
    document.getElementById('Company_latitude').value=latlng.lat();
    document.getElementById('Company_longitude').value=latlng.lng();
}

function updateMarkerAddress(str) {
  document.getElementById('formattedAddress').value = str;
}
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
    var latlng = new google.maps.LatLng(lat_value, long_value);
    var myOptions = {
      zoom: 14,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    marker = new google.maps.Marker({
    position: latlng,
    title: 'Johannesburg, South Africa',
    map: map,
    draggable: true,
    icon: image,
    //shadow: shadow,
  });
   // Update current position info.
  //updateMarkerPosition(latlng);
  geocodePosition(latlng);
	// Add dragging event listeners.
   
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
  }

  function codeAddress() {
    var address="";
    if(document.getElementById("Company_street_add").value!="")
    {
        address+=document.getElementById("Company_street_add").value;
        address+=', ';
    }
    if(document.getElementById("city").value!="")
    {
        address+=document.getElementById("city").value;
         address+=', ';
    }
    province=$("#Company_province option:selected").text();
        
    address+=province+', South Africa';
    geocoder.geocode( { 'address': address,'region':'ZA','partialmatch': true}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
        if(marker != null)
        marker.setMap(null);//clear the previous marker from the map
        latlng=results[0].geometry.location;
        map.setCenter(latlng);
            // Update current position info.
          updateMarkerPosition(latlng);
          geocodePosition(latlng);
            marker = new google.maps.Marker({
            map: map,
			draggable: true,
            position: results[0].geometry.location,
            icon: image,
            //shadow: shadow,
        });
        	// Add dragging event listeners.
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
      } else {
        alert("Geocode could not locate the address. Please recheck your input again!" );
      }
    });
  }
  
  function updateMapPinPosition()
  {
     marker.setMap(null);//clear the previous marker from the map
     var latlng=new google.maps.LatLng(document.getElementById('Company_latitude').value,document.getElementById('Company_longitude').value);
      map.setCenter(latlng);
     marker = new google.maps.Marker({
            map: map,
			draggable: true,
            position: latlng,
            icon: image,
            //shadow: shadow,
        });
    google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
  }