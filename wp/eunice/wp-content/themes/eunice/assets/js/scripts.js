/*
Template Name: Eunice
Author: VictorThemes
Version: 1.0
*/

/* ************* SOME FUNTION INIT INDEX ******************

1.ISOTOPE FILTER INIT FUNCTION
2.ISOTOPE MASONARY INIT FUNCTION
3.GRID JUSTIFY GALLERY INIT FUNCTION
4.BLOG CAROUSEL INIT AND CUSTOM HEIGHT FUNCTION
5.LIGHTBOX DATA FORMATE CLASS FUNCTION
6.NICE SCROLL INIT FUNCTION
7.CUSTOM SLIDEDOWN MENU FUNCTION
8.FULL WIDTH SLIDER FIX ISSU  FUNCTION
9.CUSTOM MOBIL MENU FUNCTION FUNCTION
10.FULL WIDTH SLIDER GALLERY  OWL CAROUSEL  INIT FUNCTION
11.FULL WIDTH SLIDER KENBURNS SLIDER INIT FUNCTION
12.PORTFOLIO SINGLE FULL WIDTH  OWL CAROUSEL INIT FUNCTION
13.MEMBER TESTIMONIALS OWL CAROUSEL INIT FUNCTION
14.CUSTOM FULL WIDTH SLIDER GALLERY SHOW HIDE OPTION FUNCTION
15.RIBBON  OWL CAROUSEL INIT AND MOUSE WHEEL INIT FUNCTION
16.CUSTOM SLIDER HEIGHT FUNCTION
17.LIGHT GALLERY LIGHTBOX INIT FUNCTION
18.SOME CUSTOM  STYLE FOR CONTACT FORM 7 FUNCTION
19.CUSTOM DEFAULT HTML TABLE CLASS FUNCTION
20.CUSTOM THEAM MEMBER IMAG HEIGHT  FUNCTION
21.GOOGLE MAP INIT FUNCTION
22.MOBIL TOUCH ENABLE
--------------------
->DOCUMENT READY ALL FUNCTION  CALL
->WINDOW LOAD RESIZE ALL FUNCTION  CALL
->ONLY WINDOW LOAD FUNTION CALL

************************************* */

(function($){
'use strict';

/*============ 2.ISOTOPE MASONARY INIT FUNCTION ===========*/
function grid_masonary(){
	var $content = $("body").has(".masonary-grid").length;
	if(true == $content){
		var $grid = $('.masonary-grid').isotope({
		  itemSelector: '.grid-img',
		  percentPosition: true
		});
	}
	return;
}

/*============ 3.GRID JUSTIFY GALLERY INIT FUNCTION ===========*/
function justify_gallery(){
	var $content = $("body").has(".fit-grid").length;
	if(true == $content){
		$(".fit-grid").justifiedGallery({
			selector:'.media-box',
			rowHeight:260
		});
	}
	return;
}

/*============ 5.LIGHTBOX DATA FORMATE CLASS FUNCTION ===========*/
function data_formate(){
	var $content = $("body").has(".media-light-box[data-format='text'] .lightbox-btn").length;
	if(true == $content){
		$(".media-light-box[data-format='text'] .lightbox-btn").parents(".single-img").addClass("text-formate");

	}
	return;
}

/*============ 6.NICE SCROLL INIT FUNCTION ===========*/
function NiceScroll(){
	if (!Modernizr.touch){
		// $("html").niceScroll({
		// 	cursorcolor: "#121212",
		// 	cursorwidth: "5px",
		// 	cursorborder: "0px solid #121212",
		// 	cursorborderradius: "0px",
		// 	background: "#E0E0E0",
		// 	autohidemode: false
		// });
		$(".header-content, .full-screen  .owl-thumbs").niceScroll({
			cursorcolor: "rgb(136, 136, 136)",
			cursorwidth: "3px",
			cursorborder: "0px solid rgb(136, 136, 136)",
			cursorborderradius: "0px",
			autohidemode: true
		});
	}
	return;
}

/*============ 7.CUSTOM SLIDEDOWN MENU FUNCTION ===========*/
function menuDropdown(){

	$("#mainnavmenu > li.menu-item-has-children > a").on("click",function(e){
		e.preventDefault();
	});

	$('#mainnavmenu li').children('.children').addClass('sub-menu');
var menuseletor = $('#mainnavmenu li');

	menuseletor
	.find('.current-menu-item')
	.closest('.sub-menu')
	.show()
	.closest('li.menu-item-has-children, li.page_item_has_children')
	.addClass('active-dropdown');
	menuseletor.hover(function() {
		var $this = $(this);
		if(!$this.find('ul li').is('.current-menu-item')){
			$this
			.addClass('active-dropdown')
			.find('.sub-menu')
			.stop(true, false, true)
			.slideToggle(500,function(){
				if($(this).is(":hidden")){
					$(this).closest('li.menu-item-has-children, li.page_item_has_children').removeClass('active-dropdown');
				}else{
					$(this).closest('li.menu-item-has-children, li.page_item_has_children').addClass('active-dropdown');
				}
			});
		}
		return;
	});
}

/*============ 8.FULL WIDTH SLIDER FIX ISSU  FUNCTION ===========*/
// function full_slider_fix(){
// 	$("#fullwidth_slider_warp").closest(".wpb_content_element ").css("margin-bottom","0px");
// }

/*============ 9.CUSTOM MOBIL MENU FUNCTION FUNCTION ===========*/
function mobil_menu_swice(){
	$(".nav-view-btn").on("click", function(event){
			event.preventDefault();
			if ( $(this).hasClass("close") ) {
				$(".header-area").stop().animate({right:"-250px"}, 500);
				$("#movil-nav-icon").attr("class","fa fa-navicon");
			} else {
				$(".header-area").stop().animate({right:"0px"}, 500);
				$("#movil-nav-icon").attr("class","fa fa-close");
			}
			$(this).toggleClass("close");
			return false;
		});
}

/*============  10.FULL WIDTH SLIDER GALLERY  OWL CAROUSEL  INIT FUNCTION ===========*/
function fullheifgt_slider(){
	var $windowheight = $(window).height(),
	mq = window.matchMedia( "(max-width: 991px)");
	if(!mq.matches){
		$("#fullwidth_slider_warp.full-screen .owl-item > div")
		.height($windowheight);
	}else{
		$("#fullwidth_slider_warp.full-screen .owl-item > div")
		.height($windowheight - 53);
	}
}
// set owl-carousel width equals to owl-wrapper width
function owlWrapperWidth( selector ) {
  $(selector).each(function(){
    $(this).find('.owl-carousel').outerWidth( $(this).closest( selector ).innerWidth() );
  });
}

// trigger on start and resize
owlWrapperWidth( '#fullwidth_slider_warp' );
$( window ).resize(function() {
  owlWrapperWidth( $('#fullwidth_slider_warp') );
});
function fullwidth_slider_init(){
	var $contentGallery = $("body").has("#gallery-slider").length;
	if(true == $contentGallery){
		var owlgallery = $("#gallery-slider");
		owlgallery.on('initialized.owl.carousel', function(e) {
			 var carousel,item, itemlength;
			fullheifgt_slider();
			$("#fullwidth_slider_warp.full-screen   .gallary-slider-length, #fullwidth_slider_warp.gallery  .gallary-slider-length")
			.addClass("gallary-slider-length-active");
		    if (!e.namespace) return
		    	carousel = e.relatedTarget;
				item = carousel.relative(carousel.current());
				item = (10 > item) ? "0"+(item+1) : item+1;
				itemlength = carousel.items().length;
				itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
		    $('.gallary-slider-length')
		    .text(item + '/' + itemlength);
  		}).owlCarousel({
				loop: true,
	      items: 1,
				animateOut: 'fadeOut',
	  		animateIn: 'fadeIn',
	      center:true,
	      thumbs: true,
	      thumbImage: true,
	      thumbContainerClass: 'owl-thumbs',
	      thumbsPrerendered: true,
	      thumbItemClass: 'owl-thumb-item',
				dots:false,
	      nav: true,
	      navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
	      autoplay:true
		});

		owlgallery.on('changed.owl.carousel', function(e) {
			var itemIndex, itemlength;
  			if (!e.namespace || e.property.name != 'position') return
  				itemIndex = e.relatedTarget.relative(e.item.index);
  				itemIndex = (10 > itemIndex) ? "0"+(itemIndex+1) : itemIndex+1;
  				itemlength =  e.item.count;
  				itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
		  	$('.gallary-slider-length').text( itemIndex + '/' + itemlength);
		});

	}
return;
}

/*============  11.FULL WIDTH SLIDER KENBURNS SLIDER INIT FUNCTION ===========*/
function kenburns_slider_init(){
	var $contentKenburns = $("body").has("#kb-canvas-slide").length;
	if(true == $contentKenburns){
		$(".main-content-area").css({
			"height":"100%",
			"overflow":"hidden"
		});

		 var $canvas = $('#kb-canvas-slide'), $mapseletor;
			$canvas.attr('width',$(".main-content-area").width());
			$canvas.attr('height', $(window).height());
			$mapseletor = $(".kenburns-slide-img-init img");
			var img = $mapseletor.map(function() {
			  return $(this).attr("src");
			});
			var  image = [];
			for (var i=0; i<img.length; i++) {
				image[i]=img[i];
			}

			$(".single-kenburns").each(function() {
				var cationCheck = $(this).children(".kb_caption").length > 0;
				if(cationCheck){
					return $(this).children(".kb_caption");
				}else{
					return $(this).append('<div class="kb_caption"></div>');
				}
			});

			var kb_caption = $mapseletor.next().map(function() {
			  return $(this).html();
			});
			if(kb_caption){
				var  kb_captions = [];
				for (var i=0; i<img.length; i++) {
					kb_captions[i]=kb_caption[i];
				}
			}

			var kb = $canvas.kenburned({
					images : image,
					frames_per_second: 30,
					display_time: 5000,
					fade_time: 1000,
					zoom: 1.2,
					background_color:'#151515',
					kbr_captions:kb_captions
				});
			$(window).on("resize",function(){
				kb.resize($(".main-content-area").width(),$(window).height());
			});

			$('.kenburns-prev-slide').on("click",function(ev) {
				ev.preventDefault();
				kb.prevSlide();
			});
			$('.kenburns-next-slide').on("click",function(ev) {
				ev.preventDefault();
				kb.nextSlide();
			});
			var  itemlen = $(".kenburns-slide-img-init img").length;
			itemlen = (10 > itemlen && 0 < itemlen) ? "0"+itemlen : itemlen;
			$(".kenburns-all-count").text(itemlen);

	}
return;
}

/*============  12.PORTFOLIO SINGLE FULL WIDTH  OWL CAROUSEL INIT FUNCTION ===========*/
function portfolio_slider_init(){
	var $contentPortfolio = $("body").has("#portfolio-slider").length;
	if(true == $contentPortfolio){
		var owlPortfolio = $("#portfolio-slider");
		owlPortfolio.on('initialized.owl.carousel', function(e) {
			 var carousel,item, itemlength;
		    if (!e.namespace) return
		    	carousel = e.relatedTarget;
				item = carousel.relative(carousel.current());
				item = (10 > item) ? "0"+(item+1):item+1;
			itemlength = carousel.items().length;
			itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
		    $('.portfolio-slider-length')
		    .text(item + '/' + itemlength);
  		}).owlCarousel({
	        items:1,
			autoplay:true,
			animateIn: 'fadeIn',
			animateOut: 'fadeOut',
			loop:true,
			margin:0,
			nav:true,
			dots:false,
	        navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],

		});
		owlPortfolio.on('changed.owl.carousel', function(e) {
			var itemIndex, itemlength;
  			if (!e.namespace || e.property.name != 'position') return
  				itemIndex = e.relatedTarget.relative(e.item.index);
  				itemIndex = (10 > itemIndex)? "0"+(itemIndex+1):itemIndex+1;
  			itemlength =  e.item.count;
  			itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
		  	$('.portfolio-slider-length').text( itemIndex + '/' + itemlength);
		});

	}
return;
}
/*============ 13.MEMBER TESTIMONIALS OWL CAROUSEL INIT FUNCTION ===========*/
function member_testimonials(){
	var $contentTestimonial = $("body").has("#testimonials").length;
	if(true == $contentTestimonial){
		$("#testimonials").owlCarousel({
	        items:1,
			autoplay:false,
			loop:true,
			margin:0,
			nav:false,
			dots:true

		});
	}
	return;
}

/*============ 14.CUSTOM FULL WIDTH SLIDER GALLERY SHOW HIDE OPTION FUNCTION ===========*/
function slider_gallery_show(){
	$("#fullwidth_slider_warp  .gallery-open").on("click",function(){
		$(this).parents("#fullwidth_slider_warp").toggleClass('show-gallery-width');
		return false;
	});
}

/*============  15.RIBBON  OWL CAROUSEL INIT AND MOUSE WHEEL INIT FUNCTION ===========*/
function ribbon_page_carousel(){
	var $contentmousewheel = $("body").has("#ribbon_carousel_mousewheel").length;
	var $content = $("body").has("#ribbon_carousel").length;
	if(true == $contentmousewheel){
		if (!Modernizr.touch){
			$("#ribbon_carousel_mousewheel").niceScroll({
				cursorcolor: "#121212",
				cursorwidth: "5px",
				cursorborder: "0px solid #121212",
				cursorborderradius: "0px",
				autohidemode: false,
				smoothscroll: true,
				horizrailenabled: true,
				scrollspeed:30,
				mousescrollstep:90,
				touchbehavior: true
			});
		}
	}
	if(true == $content){

		var owlRibbon = $("#ribbon_carousel");
		owlRibbon.on('initialized.owl.carousel', function(e) {
			 var carousel,item, itemlength;
		    if (!e.namespace) return
		    	carousel = e.relatedTarget;
				item = carousel.relative(carousel.current());
				item = (10 > item) ? "0"+(item+1):item+1;
				itemlength =  carousel.items().length;
	  			itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
		    $('.ribbon_carousel_length')
		    .text(item + '/' + itemlength);
  		}).owlCarousel({
			items:2,
			loop:true,
			nav: true,
			margin: 20,
			dots:false,
			navText:['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			slideBy:1,
			    responsive:{
			        0:{
			            items:1
			        },
			        678:{

			            items:1
			        },
			        960:{

			            items:2,

			        },
			        1200:{
			            items:2
			        }
			    }
		});
		owlRibbon.on('changed.owl.carousel', function(e) {
			var itemIndex, itemlength;
  			if (!e.namespace || e.property.name != 'position') return
  				itemIndex = e.relatedTarget.relative(e.item.index);
  				itemIndex = (10 > itemIndex) ? "0"+(itemIndex+1):itemIndex+1;
	  			itemlength =  e.item.count;
	  			itemlength = (10 > itemlength && 0 < itemlength) ? "0"+itemlength : itemlength;
			  	$('.ribbon_carousel_length').text( itemIndex + '/' + itemlength);
		});
	}
return;
}

/*============ 16.CUSTOM SLIDER HEIGHT FUNCTION ===========*/
function slider_height(){
	var $windowheight = $(window).height();
	$(".photo-proofing-warp")
	.height($windowheight);
	$("#ribbon_carousel_mousewheel  .rib-single-item, #ribbon_carousel_mousewheel  .rib-single-item img, #ribbon_carousel .rib-single-item")
	.height($windowheight-40);
	$("#fullwidth_slider_warp.full-screen  .owl-thumbs")
	.height($("#fullwidth_slider_warp.full-screen  #gallery-slider").height());
}

/*=============  17.LIGHT GALLERY LIGHTBOX INIT FUNCTION ===========*/
function grid_lightbox_album(){
	 $('.album-custom-shortcode').lightGallery({
		 selector: "[data-rel='gallery']",
        download: false,
		thumbnail:false
	 });
}

function grid_lightbox(){
	 $('#grid-warp').lightGallery({
		 selector: "[data-rel='lightgallery']",
        download: false,
		thumbnail:false

	 });
}

/*============= 18.SOME CUSTOM  STYLE FOR CONTACT FORM 7 FUNCTION ===========*/
function wpcf7_form_input(){
	// input range and number filed
		var $rangeSelect,$numberFi;
		$rangeSelect = $(".wpcf7-form-control-wrap input[type='range']");
		$numberFi = $(".wpcf7-form-control-wrap input[type='number']");

		$numberFi.on("change",function(){
			var max = parseInt($(this).attr('max'));
			var min = parseInt($(this).attr('min'));

		    if ($(this).val() > max)
		    {
		          $(this).attr("disabled","disabled");
		          $(this).val(max);
		    }
		    if($(this).val() < min){
		    	$(this).attr("disabled","disabled");
		        $(this).val(min);
		    }

			$rangeSelect.val($(this).val());

		});

		$rangeSelect.on("change",function(){
			var $rangeVal = $(this).val();
			$numberFi.removeAttr("disabled");
			$numberFi.val($rangeVal);
		});

	// input file upload
	var fileSelec = $(".wpcf7-form-control-wrap input[type='file']");
	fileSelec.parent().addClass("file-upload");
	fileSelec.before("<span class='file-btn'>Upload</span>");
	fileSelec.after("<span class='file-name'>No file selected</span>");
	fileSelec.on("change",function(){
		var fileName = $(this).val();
		$(this).next(".file-name").text(fileName);
	});

	// input date picker
	var $datPick = $("body").has("input.wpcf7-date[type='date']").length;
	if(true == $datPick){
		$('input.wpcf7-date[type="date"]').datepicker().attr('type','text');
		$('.wpcf7-date').datepicker({
		    format: 'mm/dd/yyyy',
		    startDate: '-3d'
		});
	}
  // input checkbox
  var $checkBoxSelector = $(".wpcf7-checkbox label input[type='checkbox']");
  $checkBoxSelector.after("<span class='checkbox-btn'></span>");

  // input radio
  var $radioSelector = $(".wpcf7-radio label input[type='radio']");
  $radioSelector.after("<span class='radio-btn'></span>");
}

/*============= 19.CUSTOM DEFAULT HTML TABLE CLASS FUNCTION ===========*/
function default_table_addclass(){
	var tableclass = $(".single-post-page table").attr("class");
	if(undefined == tableclass || null == tableclass){
		$(".single-post-page  table").addClass("table");
	}
	return;
}

/*============= 20.CUSTOM THEAM MEMBER IMAG HEIGHT  FUNCTION ===========*/
function member_img_height(){
	var $imgHeight = $(".member-img").height();
	$(".member-t-call").height($imgHeight);
}

/*============= 21.CUSTOM MOBIL TOUCH HOVER TRIGGER FUNCTION ===========*/
function mobil_touch(){
	$('.single-img, .single-member-info').on('click touchend', function(e) {
		$(this).trigger('hover');
	});
}

/*============= DOCUMENT READY ALL FUNCTION  CALL ===========*/
$(function(){
	if (typeof NiceScroll == 'function'){
			NiceScroll();
		}
	if (typeof menuDropdown == 'function'){
			menuDropdown();
		}
	if (typeof mobil_menu_swice == 'function'){
			mobil_menu_swice();
		}
	if (typeof slider_gallery_show == 'function'){
			slider_gallery_show();
		}
	if (typeof fullwidth_slider_init == 'function'){
		fullwidth_slider_init();
	}
	if (typeof portfolio_slider_init == 'function'){
		portfolio_slider_init();
	}

	if (typeof ribbon_page_carousel == 'function'){
			ribbon_page_carousel();
		}
	if (typeof grid_lightbox == 'function'){
			grid_lightbox();
		}
	if (typeof grid_lightbox_album == 'function'){
			grid_lightbox_album();
		}
	if (typeof full_slider_fix == 'function'){
			full_slider_fix();
		}
	if (typeof data_formate == 'function'){
			data_formate();
		}
	if (typeof member_testimonials == 'function'){
			member_testimonials();
		}
	if (typeof default_table_addclass == 'function'){
			default_table_addclass();
		}
	if (typeof kenburns_slider_init == 'function'){
		kenburns_slider_init();
	}
	if (typeof mobil_touch == 'function'){
		mobil_touch();
	}
	$('.share-plus a').click(function(e){
		e.preventDefault();
		$('.hidden-icons').addClass('active');
		$('.share-plus').addClass('hidden');
		$('.share-minus').removeClass('hidden');
	});
	$('.share-minus a').click(function(e){
		e.preventDefault();
		$('.hidden-icons').removeClass('active');
		$('.share-plus').removeClass('hidden');
		$('.share-minus').addClass('hidden');
	});
});

/*============= WINDOW LOAD RESIZE FUNTION CALL ===========*/
$(window).on("load  resize",function(){
	if (typeof fullheifgt_slider == 'function'){
			fullheifgt_slider();
		}
	if (typeof fullwidth_slider_init == 'function'){
		fullwidth_slider_init();
	}
	if (typeof slider_height == 'function'){
			slider_height();
		}
	if (typeof member_img_height == 'function'){
			member_img_height();
		}
	if (typeof google_map_api == 'function'){
			google_map_api();
	}
});

/*============= ONLY WINDOW LOAD FUNTION CALL ===========*/
$(window).load(function(){
	if (typeof grid_masonary == 'function'){
			grid_masonary();
		}
	if (typeof fullwidth_slider_init == 'function'){
		fullwidth_slider_init();
	}
	if (typeof justify_gallery == 'function'){
			justify_gallery();
		}
/*	if (typeof blog_js_init == 'function'){
			blog_js_init();
		}*/
	if (typeof wpcf7_form_input == 'function'){
			wpcf7_form_input();
	}
	$(".owl-thumbs").addClass("owl-thumbs-active");
	$("#fullwidth_slider_warp.full-screen   .gallery-open").addClass("gallery-open-active");
	$("#cap-mask-preloder").delay(100).fadeOut("slow",function(){
		$("body").removeAttr('data-preloder');
	});
	$('a.load_more_btn').css('display', 'block');

});

})(jQuery);