AArpr_Input_Type_Range = (function ($) {
    "use strict";

    // public
    var debug_level = 0,
        maincontainer = null;
    
	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
			$(".AArpr-item-input-type-range").each(function(){
				var that = $(this),
					input = that.find('input'),
					output = that.find("output");
 
				output.text( input.val() );

				input.on('change', function(){
					output.text( input.val() );
				});
			});
		});
	})();
})(jQuery);