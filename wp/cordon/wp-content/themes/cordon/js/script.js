(function($) {
    "use strict";

	
    $(window).on("load", function() { // makes sure the whole site is loaded
	
        //move to hash after loading
        if (window.location.hash  && $(window.location.hash).length)  {
				var menuheigt = $(".header").height();
				$('html, body').stop().animate({
					scrollTop: $(window.location.hash).offset().top - menuheigt + 2
				}, 300, 'linear');
        }
		
		//script for mobile menu
		$.fatNav();

        //isotope setting(portfolio)
        var $container = $('.portfolio-body');
        $container.imagesLoaded(function() {
            $container.isotope();
        });

        // Custom transform modifier for Stellar.js
        $.stellar.positionProperty.transform3d = {
            setPosition: function(element, newLeft, originalLeft, newTop, originalTop) {
                var distance = newTop - originalTop;
                element.css('transform', 'translate3d(0, ' + distance + 'px, 0');
            }
        };
        if (Modernizr.touch) {
            //add class on touch device
            $('body').addClass('no-para');
        } else {
            //stellar/parallax trigger
			$.stellar({
				positionProperty: 'transform3d',
				horizontalScrolling: false,
				hideDistantElements: false,
				responsive: true
			});
            
        }
		//margin for footer
		$('.transparent').css('height', $('.footer-two').outerHeight() + 'px');
    });



    // script popup image
    $('.popup-img').magnificPopup({
        type: 'image'
    });
	
	// script popup image
    $('.blog-popup-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
	
    //create menu for tablet/mobile
	$(".menu-box >div> ul").clone(false).find("ul,li").removeAttr("id").remove(".sub-menu").appendTo($(".fat-list"));
    //remove empty href
    $(".fat-list a[href='#']").parent().remove();
    $(".fat-list .sub-menu").remove();
    //remove empty ul on mobile menu
    $('.fat-list ul').not(':has(li)').remove();


    //menu for tablet/mobile,slider button, about button,menu link scrolling
    $('.fat-list a[href^="#"],.slide-btn[href^="#"]').on('click', function(event) {
        var $anchor = $(this);
        var menuheigt = $(".nav-box").height();
		if ( $(this).attr("href") !=='#') {
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - menuheigt
        }, 800, 'linear');
		event.preventDefault();
		}
    });



    //sticky navigation
    $(".for-sticky").sticky({
        topSpacing: 0
    });

    // Video responsive
    $("body").fitVids();

    //script for navigation(superfish)
    $('.menu-box ul').superfish({
        delay: 400, //delay on mouseout
        animation: {
            opacity: 'show',
            height: 'show'
        }, // fade-in and slide-down animation
        animationOut: {
            opacity: 'hide',
            height: 'hide'
        },
        speed: 200, //  animation speed
        speedOut: 200,
        autoArrows: false // disable generation of arrow mark-up
    })


    // filter items when filter link is clicked
    var $container = $('.portfolio-body');
    $('.port-filter a').on('click', function() {
        var selector = $(this).attr('data-filter');
        $container.isotope({
            itemSelector: '.port-item',
            filter: selector
        });
        return false;
    });

    //adding active state to portfolio filtr
    $(".port-filter a").on('click', function() {
        $(".port-filter a").removeClass("active");
        $(this).addClass("active");
        setTimeout("$.stellar('refresh');", 600); //refresh stellar alignment
    });
	
	//onepage Page scrolling
    $('.one-pager').onePageNav({
        filter: ':not(.external a)',
        scrollThreshold: 0.25
    });

	
	//run functions on window resize
	$(window).on('resize', function () {
		$('.transparent').css('height', $('.footer-two').outerHeight() + 'px');
	});
	
	//add image mask
    $('.bg-with-mask').each(function() {
        $(this).append('<div class="slider-mask"></div>');
    });
	
	//slider for blog slider
	$('.blog-slider').slick({
        autoplay: true,
        dots: false,
        nextArrow: '<i class="fa fa-arrow-right"></i>',
        prevArrow: '<i class="fa fa-arrow-left"></i>',
        speed: 800,
        fade: true,
        pauseOnHover: false,
        pauseOnFocus: false
    });
	
	//replace the data-background into background image
    $(".blog-img-bg").each(function() {
        var imG = $(this).data('background');
        $(this).css('background-image', "url('" + imG + "') "

        );
    });
	
})(jQuery);