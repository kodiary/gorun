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
            var base_url = 'http://gorun.co.za/dev2/';
            }
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
    //alert(latlng.lat());
    $('#Company_latitude').val(latlng.lat());
    $('#Company_longitude').val(latlng.lng());
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
         lat_value=-30.876754796068123;
    }
    if(long_value=='0' || long_value=='')
    {
         long_value=24.293892525000047;
    }
    var latlng = new google.maps.LatLng(lat_value, long_value);
    var zoomin = 14;
    if(lat_value == -30.876754796068123 && long_value == 24.293892525000047)
      var zoomin = 4;
    
    var myOptions = {
      zoom: zoomin,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
   
    var inputmap = document.getElementById('formattedAddress');

    var autocomplete = new google.maps.places.Autocomplete(inputmap);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          anchorPoint: new google.maps.Point(0, -29),
          draggable: true,
          icon: image,
        });



    autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setPosition(place.geometry.location);
          updateMarkerPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);


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
  $('#formattedAddress').val("South Africa");
  //document.getElementById('formattedAddress').value = "South Africa";
  }

  function codeAddress() {
    
    var address="";
    
    address=$(".venue").val();
    if(address!="" || address!="South Africa"){
        if(address.replace('South Africa','')==address)    
        address+=', South Africa';
    }
    else
    {
      address = "South Africa";
    }
    
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