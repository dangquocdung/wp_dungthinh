
$(function(){"use strict";

	$("#status").fadeOut();
	$("#preloader").delay(350).fadeOut("slow");

	$('#portfolio-filter').parents('.twelve').removeClass('columns');

	$('.home-pattern, #slider-wrap').css({'height':($(window).height())+'px'});
	$(window).resize(function(){
	$('.home-pattern, #slider-wrap').css({'height':($(window).height())+'px'});
	});

	$('.flippy').parents('.section').addClass('home-pattern');

	$('.page404').css({'height':($(window).height()-320)+'px'});
 
	  var sync1 = $("#sync3");
	  var sync2 = $("#sync4");
	 
	  sync1.owlCarousel({
	    singleItem : true,
	    slideSpeed : 1000,
		autoPlay : true,
	    navigation: false,
	    pagination:false,
	    afterAction : syncPosition,
	    responsiveRefreshRate : 200,
	  });
	 
	  sync2.owlCarousel({
	    items : 4,
	    itemsDesktop      : [1199,4],
	    itemsDesktopSmall     : [979,4],
	    itemsTablet       : [768,4],
	    itemsMobile       : [479,2],
	    pagination:false,
	    responsiveRefreshRate : 100,
	    afterInit : function(el){
	      el.find(".owl-item").eq(0).addClass("synced");
	    }
	  });
	 
	  function syncPosition(el){
	    var current = this.currentItem;
	    $("#sync4")
	      .find(".owl-item")
	      .removeClass("synced")
	      .eq(current)
	      .addClass("synced")
	    if($("#sync4").data("owlCarousel") !== undefined){
	      center(current)
	    }
	  }
	 
	  $("#sync4").on("click", ".owl-item", function(e){
	    e.preventDefault();
	    var number = $(this).data("owlItem");
	    sync1.trigger("owl.goTo",number);
	  });
	 
	  function center(number){
	    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
	    var num = number;
	    var found = false;
	    for(var i in sync2visible){
	      if(num === sync2visible[i]){
	        var found = true;
	      }
	    }
	 
	    if(found===false){
	      if(num>sync2visible[sync2visible.length-1]){
	        sync2.trigger("owl.goTo", num - sync2visible.length+2)
	      }else{
	        if(num - 1 === -1){
	          num = 0;
	        }
	        sync2.trigger("owl.goTo", num);
	      }
	    } else if(num === sync2visible[sync2visible.length-1]){
	      sync2.trigger("owl.goTo", sync2visible[1])
	    } else if(num === sync2visible[0]){
	      sync2.trigger("owl.goTo", num-1)
	    }
	    
	  }

	$('.flippy ul').flippy({
        interval: 4,
        speed: 800,
        stop: false,
        distance: "100px"
    });

	$(window).load(function () {
	    var $container = $('.portfolio-wrap');
	    var $filter = $('#filter');
	    // Initialize isotope 
	    $container.isotope({
	        filter: '*',
	        layoutMode: 'fitRows',
	        animationOptions: {
	            duration: 750,
	            easing: 'linear'
	        }
	    });
	    // Filter items when filter link is clicked
	    $filter.find('a').click(function () {
	        var selector = $(this).attr('data-filter');
	        $filter.find('a').removeClass('current');
	        $(this).addClass('current');
	        $container.isotope({
	            filter: selector,
	            animationOptions: {
	                animationDuration: 750,
	                easing: 'linear',
	                queue: false,
	            }
	        });
	        return false;
	    });
		
	});

	$(".tipped").tipper();

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

	//Responsive video	
	$(".video").fitVids();

	$(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});	
	$(".group1").colorbox({rel:'group1'});
	
	$('.single-article .columns').removeClass('columns');

	
	$('[data-typer-targets]').typer();
	$('.parallax2').parallax("50%", 0.5);
	$("html").niceScroll();
    
});