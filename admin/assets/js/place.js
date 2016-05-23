var place = (function(d) {
  'use strict';
  var inner = {},
    outer = {};
  inner.markers = {};
  inner.location = {};
  inner.elements = {};
  inner.markers = { 'building': false, 'entrance': false, 'accessible': false };
  inner.listener = false;
  inner.elements = { 'building': {}, 'entrance': {}, 'accessible': {} };
  inner.images = {
    'building': '/components/com_voterapp/polling.png',
    'entrance': 'components/com_pvpollingplaces/assets/images/e.png',
    'accessible': 'components/com_pvpollingplaces/assets/images/h.png'
  };

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
    });
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

  inner.setElements = function() {
    inner.elements.building.lat = d.getElementById('lat');
    inner.elements.building.lng = d.getElementById('lng');
    inner.elements.entrance.lat = d.getElementById('elat');
    inner.elements.entrance.lng = d.getElementById('elng');
    inner.elements.accessible.lat = d.getElementById('alat');
    inner.elements.accessible.lng = d.getElementById('alng');
  };

  inner.setLocations = function() {
    inner.locationName = d.getElementById('location').value;
    for each(var type in { 'building', 'entrance', 'accessible' }) {
      inner.location[type] = {
        lat: parseFloat(inner.elements[type].lat.value),
        lng: parseFloat(inner.elements[type].lng.value)
      };
    }
  }

  outer.init = function() {
    var markers = d.querySelectorAll("ul.markers li.marker");
    var script = d.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=place.createMap';
    d.body.appendChild(script);

    inner.setElements();
    inner.setLocations();
    for (var i = 0; i < markers.length; i++) {
      markers[i].addListener('click', function() { inner.addListener(this.dataset.marker, this.textContent || this.innerText || ''); });
    }

  };

  outer.createMap = function() {
    inner.map = new google.maps.Map(d.getElementById('map'), {
      center: inner.location.building,
      zoom: 19,
    });
    for each(var type in { 'building', 'entrance', 'accessible' }) {
      if (inner.location[type].lat)
        inner.markers[type] = inner.createMarker(inner.location[type], inner.images[type], inner.locationName);
    }
  };

  return outer;
})(document);
window.addEvent('domready', function() {
  place.init();
});
