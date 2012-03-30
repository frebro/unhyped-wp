
var unhyped = {
  gmaps_init: function() {
    console.log('UNHYPED gmaps init');
    var myOptions = {
      center: new google.maps.LatLng(-34.397, 150.644),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
};

jQuery(document).ready(function($) {
	console.log('UNHYPED document load');
  unhyped.gmaps_init();
});
