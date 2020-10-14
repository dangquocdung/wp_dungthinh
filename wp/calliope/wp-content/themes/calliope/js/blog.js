$(function(){"use strict";

	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");
	//Responsive video	
	$(".video").fitVids();

	$('.bxslider').bxSlider({
		adaptiveHeight: true,
		touchEnabled: true,
		pager: false,
		controls: true,
		auto: false,
		slideMargin: 1
	});

	//Navigation		
	$('ul.slimmenu').on('click',function(){
		var width = $(window).width(); 
		if ((width <= 800)){ 
		    $(this).slideToggle(); 
		}	
	});		
	$('ul.slimmenu').slimmenu(
	{
	    resizeWidth: '800',
	    collapserTitle: '',
	    easingEffect:'easeInOutQuint',
	    animSpeed:'medium',
	    indentChildren: true,
	    childrenIndenter: '&raquo;'
	});	

	//$("html").niceScroll();
});