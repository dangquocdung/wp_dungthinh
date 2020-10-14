/**
 * smartPopup
 * --------
 *
 * author: Andrei Dinca & Alexandra Ipate
 * 		                    _		   _   _____  _
 *		    /\             | |        (_) |  __ \(_)
 *		   /  \   _ __   __| |_ __ ___ _  | |  | |_ _ __   ___ __ _
 *		  / /\ \ | '_ \ / _` | '__/ _ \ | | |  | | | '_ \ / __/ _` |
 *		 / ____ \| | | | (_| | | |  __/ | | |__| | | | | | (_| (_| |
 *		/_/    \_\_| |_|\__,_|_|  \___|_| |_____/|_|_| |_|\___\__,_|
 *
 * email: andrei.webdeveloper@gmail.com
 *
 * version 1.0 release date: 05 01 2011
 *
**/

		//pass the options variable to the function
var	smartPopup = function(options) {
	//Set the default values
	var defaults = {
		'fadeBox'			: 'div#smartPopupfade',
		'fadeOpacity'		: 0.7,
		'fadeBackground'	: 'wp-content/plugins/feedback/frontpage/images/bg-transparent.png',
		'fadeOutTime'		: 200,
		'fadeInTime'		: 300,
		'closeBtn'			: 'a.smartPopup-close',
		'boxWidth'			: '800',
		'boxHeight'			: '600',
		'showOn'			: 'open'
	};

	// extends options object
	options =  jQuery.extend(defaults, options);

	// self define parent class
	var self = this;

	// prevent collisions
	var running = false;

	jQuery("div.smartPopup").each(function() {
		var opts = options;

		// cache jQuery(this) object
		var $this = jQuery(this);

		if( !$this.hasClass('smartPopupSlide') )  {
			// event close
			jQuery('body').on('click', options.closeBtn, function(){
				closeFeedback();
				return false;
			});
		}


		if(options.showOn == 'open'){
			// open feedback box
			openFeedback();
		}else{
			jQuery(window).bind("beforeunload", function(){
				// open feedback box
				openFeedback();
				return false;
			});
		}
		// open feedback box
		function openFeedback(){

			if( !$this.hasClass('smartPopupSlide') )  {
				// count down
				jQuery("body").append('<div id="pietimerholder">Auto Close<br /></div>');
				canvasPieTimer.init(50, "canvaspietimer", "pietimerholder");
			}

			// till close
			jQuery(options.fadeBox).css('display', 'none');

			// extra width and height + 30 (padding)
			if( $this.hasClass('smartPopupSlide') )  {

				$this.css({
					width: options.boxWidth + 'px',
					height: options.boxHeight + 'px',
					display: 'none'
				});

			}else{

				$this.css({
					width: options.boxWidth + 'px',
					height: options.boxHeight + 'px',
					display: 'none',
					// align to center
					marginTop: "-" + (parseInt(options.boxHeight) + 30) / 2 + "px",
					marginLeft: "-" + (parseInt(options.boxWidth) + 30) / 2 + "px"
				});

			}

			// set fade opacity
			jQuery(options.fadeBox).css({
				opacity : options.fadeOpacity,
				background: 'url(' + options.fadeBackground + ')'
			});

			// open it
			jQuery(options.fadeBox).fadeIn(options.fadeInTime);
			$this.fadeIn(options.fadeInTime);
		}

		// close feedback box
		function closeFeedback(){
			jQuery(options.fadeBox).fadeOut(options.fadeOutTime);
			$this.fadeOut(options.fadeOutTime);
			jQuery("div#pietimerholder").fadeOut(options.fadeOutTime);
		}

		var $ = jQuery;

		if( $this.hasClass('smartPopupSlide') )  {

			$('body').on('click', options.closeBtn, function(e){
				e.preventDefault();

				$this.css("margin-left", "-425px");
			    $('#smartPopupPlus').css("margin-left", "10px");

				return false;
			});

			$(document).scroll(function() {
			  var scroll = $(this).scrollTop();
			  if (scroll >= 150) {
			    $this.css("margin-left", "-425px");
			    $('#smartPopupPlus').css("margin-left", "10px");
			  }
			});

			$('body').on('click', '#smartPopupPlus', function() {
			  $this.css("margin-left", "30px");
			  $('#smartPopupPlus').css("margin-left", "-425px");
			});

			$this.on('click', ".smartPopup-close", function() {
			  $this.css("margin-left", "-425px");
			  $('#smartPopupPlus').css("margin-left", "10px");
			});

		}

	});
}
