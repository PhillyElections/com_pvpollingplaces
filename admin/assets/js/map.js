var map = (function(d) {
  'use strict';
  var inner = {}, outer = {};

  inner.apikey = 'AIzaSyDG7jgg6RbsEKG7UFXsSPi7F5RyRDTasnE';

  inner.resetBounds = function() {
    bounds = new google.maps.LatLngBounds();
  };


  // hot init function
  outer.init = function() {
    var script = document.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key='+inner.apikey+'v=3.exp&callback=map.display';
    document.body.appendChild(script);
  };

  outer.display = function (location) {
    if (typeof location === 'object' && location.lat) {
      // we have a location, do nothing
    } else {
      location = inner.location.building;
    }
    inner.map = new google.maps.Map(document.getElementById('map'), {
      center: {location},
      zoom: 22
    });
  };

  outer.setLocations = function () {
    inner.location.building = {
      lat: d.getElementById('lat'),
      lng: d.getElementById('lng')
    };

    inner.location.entrance = {
      lat: d.getElementById('elat'),
      lng: d.getElementById('elng')
    };

    inner.location.accessible = {
      lat: d.getElementById('alat'),
      lng: d.getElementById('alng')
    };
  }

  return outer;
})(document);
window.addEvent('domready', function() {
  map.init();
  map.setLocations();
});
