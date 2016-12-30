var waypoint = require('../node_modules/waypoints/lib/jquery.waypoints.js').waypoint;

alert("abc123456");
//$(".reveal-services").remove();
var $revealServices = $('.reveal-services');

$revealServices.waypoint(function (direction) {
	if(direction =='down') {
		$revealServices.addClass('js-animate');
	}else{
		$revealServices.removeClass('js-animate');
	}
},{offset:'75%'});

