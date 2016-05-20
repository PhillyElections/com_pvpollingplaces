var place = (function(d) {
  'use strict';
  var inner = {}, outer = {};
  inner.location={};
  inner.apikey = 'AIzaSyDG7jgg6RbsEKG7UFXsSPi7F5RyRDTasnE';
//key='+inner.apikey+'
  inner.resetBounds = function() {
    var bounds = new google.maps.LatLngBounds();
  };


  // hot init function
  outer.init = function() {
    var script = d.createElement('script');
    script.id = '_gmaps';
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=place.mapDisplay';
    d.body.appendChild(script);
  };

  outer.mapDisplay = function (type) {
    var loc = {};
    if (type) {
      loc=innner.location[type];
    } else {
      loc = inner.location.building;
    }
    
    inner.map = new google.maps.Map(d.getElementById('map'), {
      center: location,
      zoom: 19
    });
  };

  outer.setLocations = function () {
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

  return outer;
})(document);
window.addEvent('domready', function() {
  place.init();
  place.setLocations();
});
