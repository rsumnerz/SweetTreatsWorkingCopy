

var thumbnail = function(element){
	// if the element does or doesn't have a class of those below, then add the class, if yes, then remove the class

	$(element).toggleClass('test col-xs-6 col-md-3');

	// Fixing Bootstrap margin left and right bug
	$('.container').toggleClass('container');
	// $('a').toggleClass('thumbnail');


    // Styling the right image
	if($(element).hasClass('test')){
		$(".test a img").addClass('locating');
	}

	// else, then removing
	else{
		$('img').removeClass('locating');
	}
};