/* 
* GMap V3 Geocoding 
* @author : Ambika
* 2012
*/
var path = window.location.pathname;
        var base_url;
        if (path.replace('gorun/', '') != path) {
            base_url = 'http://localhost/gorun/';
        } else {
            var base_url = 'http://gorun.co.za/dev/';
            }
var geocoder = new google.maps.Geocoder();
  var map;
  var marker;
  var image = new google.maps.MarkerImage(
                base_url+'images/image.png',
                new google.maps.Size(28,40),
                new google.maps.Point(0,0),
                new google.maps.Point(14,40)
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
    document.getElementById('Venues_Latitude').value=latlng.lat();
    document.getElementById('Venues_Longitude').value=latlng.lng();
}

function updateMarkerAddress(str) {
  document.getElementById('formattedAddress').value = str;
}
  function initialize() {
    var lat_value=document.getElementById('Venues_Latitude').value; 
    var long_value=document.getElementById('Venues_Longitude').value;
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
      zoom: 8,
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
    shadow: shadow,
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
    if(document.getElementById("streetAdd").value!="")
    {
        address+=document.getElementById("streetAdd").value;
        address+=', ';
    }
    if(document.getElementById("city").value!="")
    {
        address+=document.getElementById("city").value;
         address+=', ';
    }
    if($("#Venues_region option:selected").val()!="") province=$("#Venues_region option:selected").text();
    else province="";
    address+=province+', South Africa';
    geocoder.geocode( { 'address': address,'region':'ZA','partialmatch': true}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
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
            shadow: shadow,
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
     var latlng=new google.maps.LatLng(document.getElementById('Venues_Latitude').value,document.getElementById('Venues_Longitude').value);
      map.setCenter(latlng);
     marker = new google.maps.Marker({
            map: map,
			draggable: true,
            position: latlng,
            icon: image,
            shadow: shadow,
        });
    google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
  });
  }