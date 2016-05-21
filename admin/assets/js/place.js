var place = (function(d) {
  'use strict';
  var inner = {}, outer = {};
  inner.markers.building = inner.markers.entrance = inner.markers.accessible = inner.listener = null;
  inner.location = {};
  inner.apikey = 'AIzaSyDG7jgg6RbsEKG7UFXsSPi7F5RyRDTasnE';
  //key='+inner.apikey+'
  // hot init function
  outer.init = function() {
    var script = d.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=place.mapDisplay';
    d.body.appendChild(script);
  };
  outer.mapDisplay = function() {
    inner.setLocations();
    inner.map = new google.maps.Map(d.getElementById('map'), {
      center: inner.location.building,
      zoom: 19,
      navigationControl: false
    });
    outer.markerDisplay(inner.markers.building, inner.location.building, inner.locationName);
  };
  outer.markerDisplay = function(marker, coords, title) {
    if (marker) {
      marker.setMap(null);
      marker=null;
    }
    marker = new google.maps.Marker({
      position: coords,
      map: inner.map,
      title: title
    });
  };
  inner.setLocations = function() {
    inner.locationName = d.getElementById('location').value;
    inner.location.building = {
      lat: parseFloat(d.getElementById('lat').value),
      lng: parseFloat(d.getElementById('lng').value)
    };
    inner.location.entrance = {
      lat: parseFloat(d.getElementById('elat').value),
      lng: parseFloat(d.getElementById('elng').value)
    };
    inner.location.accessible = {
      lat: parseFloat(d.getElementById('alat').value),
      lng: parseFloat(d.getElementById('alng').value)
    };
    console.log(inner.location);
  }
  outer.deaf = function () {
      google.maps.event.removeListener(inner.listener);   
  };
  outer.listen = function () {
    inner.listener = google.maps.event.addListener(map, 'click', function(event) {
      //call function to create marker
      if (marker) {
        marker.setMap(null);
        marker = null;
      }
      marker = displayMarker(event.latLng, "Set Me Based On The Click That Activates");
    });    
  };
/*
  var infowindow = new google.maps.InfoWindow({
    size: new google.maps.Size(150, 50)
  });
  // A function to create the marker and set up the event window function
  function createMarker(latlng, name, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
      zIndex: Math.round(latlng.lat() * -100000) << 5
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(contentString);
      infowindow.open(map, marker);
    });
    google.maps.event.trigger(marker, 'click');
    return marker;
  }

  function initialize() {
    // create the map
    var myOptions = {
      zoom: 8,
      center: new google.maps.LatLng(43.907787, -79.359741),
      mapTypeControl: true,
      mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
      navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"),
      myOptions);

    google.maps.event.addListener(map, 'click', function() {
      infowindow.close();
    });
    google.maps.event.addListener(map, 'click', function(event) {
      //call function to create marker
      if (marker) {
        marker.setMap(null);
        marker = null;
      }
      marker = createMarker(event.latLng, "name", "<b>Location</b><br>" + event.latLng);
    });
  }
*/
  return outer;
})(document);
window.addEvent('domready', function() {
  place.init();
});
