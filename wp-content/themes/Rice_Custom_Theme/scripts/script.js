
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

    var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].onclick = function(){
	        this.classList.toggle("active");
	        this.nextElementSibling.classList.toggle("show");
	    }
	}
});