var place = (function(d) {
  'use strict';
  // instantiate 
  var inner = {},
    outer = {};
  inner.markers = {};
  inner.location = {};
  inner.elements = {};
  inner.types = ['building', 'entrance', 'accessible'];
  inner.listener = false; // we will have only one map listener
  inner.images = {
    'building': '/components/com_voterapp/polling.png',
    'entrance': 'components/com_pvpollingplaces/assets/images/e.png',
    'accessible': 'components/com_pvpollingplaces/assets/images/h.png'
  };

  for (var type of inner.types) {
    inner.markers[type] = false;
    inner.elements[type] = {};
  }

  // private methods
  inner.addListener = function(type, title) {
    // we only allow one listener at a time
    inner.dropListener();
    inner.listener = google.maps.event.addListener(inner.map, 'click', function(event) {
      //call function to create marker
      if (inner.markers[type] && typeof inner.markers[type].setMap === 'function') {
        inner.markers[type].setMap(null);
        inner.markers[type] = null;
      }
      inner.markers[type] = inner.createMarker(event.latLng, inner.images[type], title);
      inner.elements[type].lat.value = event.latLng.lat();
      inner.elements[type].lng.value = event.latLng.lng();
      inner.cloneValues();
    });
  };

  inner.bindElements = function() {
    inner.elements.building.lat = d.getElementById('lat');
    inner.elements.building.lng = d.getElementById('lng');
    inner.elements.entrance.lat = d.getElementById('elat');
    inner.elements.entrance.lng = d.getElementById('elng');
    inner.elements.accessible.lat = d.getElementById('alat');
    inner.elements.accessible.lng = d.getElementById('alng');
  };

  inner.cloneValues = function() {
    for (var type of inner.types) {
      if (inner.elements[type].lat > 0) {
        d.getElementById('display-' + type).textContent = inner.elements[type].lat + "," + inner.elements[type].lng;
      }
    }
  };

  inner.createMarker = function(coords, image, title) {
    var marker = new google.maps.Marker({
      position: coords,
      map: inner.map,
      title: title,
      icon: image
    });
    return marker;
  };

  inner.dropListener = function() {
    google.maps.event.removeListener(inner.listener);
  };

  inner.setLocations = function() {
    inner.locationName = d.getElementById('location').value;
    for (var type of inner.types) {
      inner.location[type] = {
        lat: parseFloat(inner.elements[type].lat.value),
        lng: parseFloat(inner.elements[type].lng.value)
      };
    }
  }

  // public methods
  outer.createMap = function() {
    inner.map = new google.maps.Map(d.getElementById('map'), {
      center: inner.location.building,
      zoom: 19,
    });
    for (var type of inner.types) {
      if (inner.location[type].lat)
        inner.markers[type] = inner.createMarker(inner.location[type], inner.images[type], inner.locationName);
    }
  };

  outer.init = function() {
    var markers = d.querySelectorAll("ul.markers li.marker");
    var cancel = d.querySelectorAll("ul.markers li.marker-cancel");
    var script = d.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=place.createMap';
    d.body.appendChild(script);

    inner.bindElements();
    inner.cloneValues();
    inner.setLocations();
    for (var i = 0; i < markers.length; i++) {
      markers[i].addListener('click', function() { inner.addListener(this.dataset.marker, this.textContent || this.innerText || ''); });
    }
    cancel[0].addListener('click', function() { inner.dropListener() });
  };

  return outer;
})(document);

window.addEvent('domready', function() {
  place.init();
});
