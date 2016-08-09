
jQuery(document).ready(function($) {
   
	// HEADER
    $(window).scroll(function () {
        if ($(window).scrollTop() > 20) { 
            $('#header').addClass('shrink');
        }
        else{
            $('#header').removeClass('shrink');
        }
    });
});