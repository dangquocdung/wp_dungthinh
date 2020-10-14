(function($) {
    "use strict";
    if (Modernizr.touch) {
		//remove animation on touch device
        $('.animated').removeClass('animated')
        $('.ani-width').removeClass('ani-width');
    } else {
        $.fn.queued = function() {
            var self = this;
            var func = arguments[0];
            var args = [].slice.call(arguments, 1);
            return this.queue(function() {
                $.fn[func].apply(self, args);
            });
        }
        //animate css
        $(window).on("load", function() { // makes sure the whole site is loaded
            //script for animate.css
			
            $('.animated').not('.slider .animated').each(function() {
                var self = $(this);
				if ($(this).data('animated')) {
					self.css('opacity','0');
				};
                $(this).waypoint(function(direction) {
                    self.each(function() {
                        var Delay = $(this).data('delay');
                        var Animated = $(this).data('animated');
						var animationDuration = $(this).data('duration');
                        if ($(this).data('animated')) {
                            //change the class based on data-animated value
                            $(this).queued('addClass', Animated)
							.css({
								'animation-delay': Delay,
								'-webkit-animation-delay': Delay,
								'-webkit-animation-duration': animationDuration,
								'animation-duration': animationDuration,
							});;
                            //remove all animated class to make it works better with isotope plugin
                            setTimeout(function() {
								self.css('opacity','1')
                                self.removeClass('animated').removeClass(Animated);
								
                            }, 3000);
                        } else {
                            self.removeClass('animated')
                        }
                    });
                }, {
                    offset: '95%',
                    triggerOnce: true
                });
            });
            //script for width animation
            $('.ani-width').each(function() {
                var self = $(this);
                $(this).waypoint(function(direction) {
                    self.each(function(i) {
                        var Delay = $(this).data('delay');
						var animationDuration = $(this).data('duration');
                        //change the class based on data-animated value
                        $(this).queued('addClass', "full-ani-width").find('.img-mask')
						.css({
								'transition-delay': Delay,
								'-webkit-transition-delay': Delay,
								'-webkit-transition-duration': animationDuration,
								'transition-duration': animationDuration,
							});
						$(this).find('.port-img')
						.css({
								'transition-delay': Delay,
								'-webkit-transition-delay': Delay,
								'-webkit-transition-duration': animationDuration,
								'transition-duration': animationDuration,
							});
                        //remove all animated class to make it works better with isotope plugin
                        setTimeout(function() {
                            self.removeClass('ani-width');
                        }, 3000);
                    });
                }, {
                    offset: '95%',
                    triggerOnce: true
                });
            });
        });
    }
})(jQuery);