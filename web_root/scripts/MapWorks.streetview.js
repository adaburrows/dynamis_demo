/*
 * Constructor for custom controls
 * =============================================================================
 */
function MwStreetView(map) {
  var map, location, control_dom, sv_toggle, sv_panel, panorama, sv_first_open;
  // set up variables
  this.map = map;
  this.sv_first_open = true;

  //build the control
  this.buildDom();
  this.setupStreetView();
  this.setCallbacks();

  // add control to map
  this.map.controls[google.maps.ControlPosition.RIGHT].push(this.control_dom);
}

/*
 * Builds the DOM to embed into the map frame
 */
MwStreetView.prototype.setupStreetView = function() {
  // set up the options for the street view
  var sv_options = {
    addressControl: false,
    enableCloseButton: false,
    linksControl: false,
    navigationControl: false,
    visible: false
  };

  // set up the street view panel
  this.panorama = new google.maps.StreetViewPanorama(this.sv_panel, sv_options);
  this.map.setStreetView(this.panorama);
}

/*
 * Builds the DOM to embed into the map frame
 */
MwStreetView.prototype.buildDom = function() {
  this.control_dom = document.createElement('DIV');
  this.control_dom.style.width = "320px";

  // add to controls div
  this.sv_toggle = this.createButton("Street View");
  this.control_dom.appendChild(this.sv_toggle);

  // add the street view to the control
  this.sv_panel = this.createStreetViewPanel();
  this.control_dom.appendChild(this.sv_panel);
}

/*
 * Builds a button DOM to embed into the control
 */
MwStreetView.prototype.createButton = function(label){
  var button = document.createElement("DIV");
  button.innerHTML = label;
  button.setAttribute("style",button.getAttribute("style")+"; float:right; ");
  button.style.textDecoration = "none";
  button.style.color = "#000";
  button.style.backgroundColor = "white";
  button.style.font = "12px Arial";
  button.style.border = "1px solid black";
  button.style.padding = "4px";
  button.style.margin = "5px";
  button.style.textAlign = "center";
  button.style.width = "8em";
  button.style.cursor = "pointer";
  button.style.display = "inline";
  return button;
}

/*
 * Builds the street view DOM to embed into the control
 */
MwStreetView.prototype.createStreetViewPanel = function(){
  var panel = document.createElement("DIV");
  panel.setAttribute("style",panel.getAttribute("style")+"; float: right; height: 200px; width: 300px; ");
  panel.style.textDecoration = "none";
  panel.style.color = "#000";
  panel.style.backgroundColor = "white";
  panel.style.font = "12px Arial";
  panel.style.border = "1px solid black";
  panel.style.padding = "4px";
  panel.style.margin = "5px";
  panel.style.display = "none";
  return panel;
}

/*
 * Set up event handlers
 */
MwStreetView.prototype.setCallbacks = function() {
  //set up self value for closures
  var self = this;

  google.maps.event.addDomListener(this.sv_toggle, 'click', function(){
    if (self.panorama.getVisible()) {
      self.closeStreetView();
    } else {
      if (self.sv_first_open) {
        self.panorama.setPosition(self.location);
        self.sv_first_open = false;
      }
      self.openStreetView();
    }
  });

  google.maps.event.addListener(this.panorama, 'position_changed', function(){
    self.openStreetView();
  });
}

/*
 * Set the location we should be looking towards
 */
MwStreetView.prototype.setLocation = function(location) {
  this.location = location;
}

/*
 * Open the street view
 */
MwStreetView.prototype.openStreetView = function() {
  this.sv_panel.style.display = "block";
  this.panorama.setPov(this.calcPov());
  this.panorama.setVisible(true);
}

/*
 * Close the street view
 */
MwStreetView.prototype.closeStreetView = function() {
  this.sv_panel.style.display = "none";
  this.panorama.setVisible(false);
}

/*
 * Calulates POV for street view so we are alway looking at the location
 */
MwStreetView.prototype.calcPov = function() {
  // fetch the current street view position
  var latlng = this.panorama.getPosition();
  // get the distance between longitudes in radians
  var dLong=this.degs2rads(this.location.lng()-latlng.lng());

  // get the latitudes in radians
  var lat1=this.degs2rads(latlng.lat());
  var lat2=this.degs2rads(this.location.lat());

  // calculate tangental in tangent plane (coordinates mapped onto tangent plane)
  var y=Math.sin(dLong)*Math.cos(lat2);
  var x=Math.cos(lat1)*Math.sin(lat2)-Math.sin(lat1)*Math.cos(lat2)*Math.cos(dLong);

  // map tangent line back into an angle in radians, then map angle to degrees
  var heading = this.rads2degs(Math.atan2(y,x));

  //return a POV object
  return {heading: heading, zoom: 0, pitch: 0};
}

/*
 * Converts from rads to degrees
 */
MwStreetView.prototype.degs2rads=function(degs){
  var rads=degs*Math.PI/180;
  return rads;
}

/*
 * Converts from rads to degrees
 */
MwStreetView.prototype.rads2degs=function(rads){
  var degs=rads*180/Math.PI;
  degs=(degs+360)%360;
  return degs;
}