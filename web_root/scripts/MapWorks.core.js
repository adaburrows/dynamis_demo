/*
 * Constructor for the MapWorks JS object
 * =============================================================================
 */
function MapWorks(div_name, zoom) {
  // member variables
  var map_id, map, mapOptions, zoom, center, locations, sv_control;

  // initialize state vaiables
  this.locations = new Array();
  this.map_id = map_id;
  this.zoom = zoom;
  this.center = new google.maps.LatLng(0, 0);

  // set up map options
  this.map_options = {
    zoom: this.zoom,
    center: this.center,
    mapTypeControl: true,
    mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      position: google.maps.ControlPosition.TOP
    },
    navigationControl: true,
    navigationControlOptions: {
      style: google.maps.NavigationControlStyle.SMALL,
      position: google.maps.ControlPosition.TOP_LEFT
    },
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    streetViewControl: true
  };

  // set up the map
  this.map = new google.maps.Map(document.getElementById(div_name), this.map_options);
}

/*
 * Center the map
 */
MapWorks.prototype.Center = function(lat,lng) {
  // set the center of the scene
  this.map.panTo(new google.maps.LatLng(lat, lng));
}

MapWorks.prototype.add = function(location, onError){
  var place = new MwPlace(this.map, location);
  if(onError) {
      place.onError = onError;
  }
  this.locations.push(place);
}

MapWorks.prototype.centroid = function() {
  var lat = 0;
  var lng = 0;
  for (place in this.locations) {
    lat += this.locations[place].lat();
    lng += this.locations[place].lng();
  }
  lat /= this.locations.length;
  lng /= this.locations.length;
  return {lat: lat, lng: lng};
}

/*
 * Constructor for the MapWorks JS object
 * =============================================================================
 */
function MwPlace(map, location) {
  // member variables
  var map, name, coord, address, results, marker, info, info_content,
      info_showing, attached, company_id;
  this.coord = false;
  this.map = map;
  this.name = '';
  this.address = false;
  this.info_content = false;
  this.company_id = false;

  if(location.propertyIsEnumerable('name')) {
    this.name = location.name;
  }
  if(location.propertyIsEnumerable('info')) {
    this.setInfo(location.info);
  }
  if(location.propertyIsEnumerable('company_id')) {
    this.company_id = location.company_id;
  }
  if(location.propertyIsEnumerable('coord')) {
    this.setCoord(location.coord.lat, location.coord.lng);
  } else if(location.propertyIsEnumerable('address')) {
    this.address = location.address;
    this.setAddress(location.address);
  }

}

/*
 * Set the coordinate for the location by lat, lng
 */
MwPlace.prototype.setCoord = function(lat, lng) {
  this.coord = new google.maps.LatLng(lat, lng);
  this.makeMarker();
}

/*
 * Set the address
 */
MwPlace.prototype.setAddress = function (address) {
  // get a geocoder, if successful call geocoder_callback
  var geocoder = new google.maps.Geocoder();
  var self = this;
  if (geocoder) {
   geocoder.geocode( {'address': address}, function(results, status) {
     // if the geocoder was successful, set the location and build the scene
     // if not, display an error about the address
     if (status == google.maps.GeocoderStatus.OK) {
       self.coord = results[0].geometry.location;
       if(self.company_id) {
         self.updateDbCoord();
       }
       self.makeMarker();
     } else {
       self.onError();
     }
    });
  }
}

MwPlace.prototype.onError = function() {
}

MwPlace.prototype.lat = function() {
  return this.coord.lat();
}

MwPlace.prototype.lng = function() {
  return this.coord.lng();
}

MwPlace.prototype.updateDbCoord = function() {
  var company_id = this.company_id;
  var lat = this.lat();
  var lng = this.lng();
  var params = {
    url: '/companies/setCoord/'+company_id+'/'+lat+'/'+lng+'.json',
    dataType: 'json',
    success: function(data) {
      alert(data.status);
    }
  };
  $.ajax(params);
}

/*
 * Add the location to the specified map
 */
MwPlace.prototype.makeMarker = function () {
  // set up marker options
  this.marker = new google.maps.Marker({
    map: this.map,
    position: this.coord,
    title: this.name
  });
  if(this.info) {
    // set up event listener for toggling the info box's visibility
    var self = this;
    google.maps.event.addListener(this.marker, 'click', function() {
      if (self.info_showing == true) {
        self.info.close();
        self.info_showing = false;
      } else {
        self.info.open(self.map, self.marker);
        self.info_showing = true;
      }
    });
  }
}

/*
 * Sets up the info box
 */
MwPlace.prototype.setInfo = function(info_content) {
  this.info_content = info_content;
  this.info = new google.maps.InfoWindow({
    content: this.info_content
  });
}