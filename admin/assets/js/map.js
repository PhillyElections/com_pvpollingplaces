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
    console.log(location);
    if (typeof location === 'object' && location.lat) {
      // we have a location, do nothing
    } else {
      location = inner.location.building;
    }
    inner.map = new google.maps.Map(document.getElementById('map'), {
      center: location,
      zoom: 19
    });
  };

  outer.setLocations = function () {
    inner.location.building = {
      lat: parseFloat(document.getElementById('lat').value),
      lng: parseFloat(document.getElementById('lng').value)
    };

    inner.location.entrance = {
      lat: parseFloat(document.getElementById('elat').value),
      lng: parseFloat(document.getElementById('elng').value)
    };

    inner.location.accessible = {
      lat: parseFloat(document.getElementById('alat').value),
      lng: parseFloat(document.getElementById('alng').value)
    };
    console.log(inner.location);
  }

  return outer;
})(document);
window.addEvent('domready', function() {
  map.init();
  map.setLocations();
});
