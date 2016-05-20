var map = (function(d) {
  'use strict';
  var inner = {}, outer = {};
  inner.location={};
  inner.apikey = 'AIzaSyDG7jgg6RbsEKG7UFXsSPi7F5RyRDTasnE';
//key='+inner.apikey+'
  inner.resetBounds = function() {
    bounds = new google.maps.LatLngBounds();
  };


  // hot init function
  outer.init = function() {
    var script = document.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=map.display';
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
      lat: d.getElementById('lat').value,
      lng: d.getElementById('lng').value
    };

    inner.location.entrance = {
      lat: d.getElementById('elat').value,
      lng: d.getElementById('elng').value
    };

    inner.location.accessible = {
      lat: d.getElementById('alat').value,
      lng: d.getElementById('alng').value
    };
    console.log(inner.location);
  }

  return outer;
})(document);
window.addEvent('domready', function() {
  map.init();
  map.setLocations();
});
