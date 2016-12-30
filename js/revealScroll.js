
var waypoint = require('../node_modules/waypoints/lib/jquery.waypoints.js').waypoint;

alert("abc123456");
//$(".reveal-services").remove();
var $revealServices = $('.reveal-services');

$revealServices.waypoint(function () {
	console.log('Waypoint');
});

