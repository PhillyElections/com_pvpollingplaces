var place = (function(d) {
  'use strict';
  var inner = {},
    outer = {};
  inner.markers = {};
  inner.location = {};
  inner.elements = {};
  inner.listener = false;

  for (var type in { 'building', 'entrance', 'accessible' }) {
    inner.markers[type] = false;
    inner.elements[type] = {};
  }

  inner.apikey = 'AIzaSyDG7jgg6RbsEKG7UFXsSPi7F5RyRDTasnE';
  //key='+inner.apikey+'
  // hot init function

  inner.setElements = function() {
    inner.elements.building.lat = d.getElementById('lat');
    inner.elements.building.lng = d.getElementById('lng');
    inner.elements.entrance.lat = d.getElementById('elat');
    inner.elements.entrance.lng = d.getElementById('elng');
    inner.elements.accessible.lat = d.getElementById('alat');
    inner.elements.accessible.lng = d.getElementById('alng');
    console.log(inner.elements);
  };

  inner.setLocations = function() {
    inner.locationName = d.getElementById('location').value;
    for (var type in { 'building', 'entrance', 'accessible' }) {
      inner.location.building = {
        lat: parseFloat(inner.elements.[type].lat.value),
        lng: parseFloat(inner.elements.[type].lng.value)
      };
    }
    console.log(inner.location);
  }

  outer.init = function() {
    var script = d.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=place.createMap';
    d.body.appendChild(script);

    inner.setElements();
    inner.setLocations();
  };

  outer.createMap = function() {
    inner.map = new google.maps.Map(d.getElementById('map'), {
      center: inner.location.building,
      zoom: 19,
      navigationControl: false
    });
    inner.markers.building = outer.createMarker(inner.location.building, inner.locationName);
  };

  outer.createMarker = function(coords, title) {
    var marker = new google.maps.Marker({
      position: coords,
      map: inner.map,
      title: title
    });
    return marker;
  };

  outer.dropListener = function() {
    console.log('dropping listener');
    google.maps.event.removeListener(inner.listener);
  };

  outer.addListener = function(type) {
    console.log('adding listener');
    inner.listener = google.maps.event.addListener(inner.map, 'click', function(event) {
      console.log('listener executed');
      //call function to create marker
      if (inner.markers[type] && typeof inner.markers[type].setMap === 'function') {
        inner.markers[type].setMap(null);
        inner.markers[type] = null;
      }
      inner.markers[type] = outer.createMarker(event.latLng, "Set Me Based On The Click That Activates");
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
