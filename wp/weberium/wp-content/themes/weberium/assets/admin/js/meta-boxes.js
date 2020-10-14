;(function($) {
	"use strict";

	// Show/hide post format meta boxes
	var togglePostFormatMetaBoxes = function() {
		var $input = $('input[name=post_format]'),
			$metaBoxes = $('[id^="opt-meta-box-post-format-"]').hide();

		$input.on( 'change', function() {
			$metaBoxes.hide();
			$('#opt-meta-box-post-format-' + $( this ).val() ).show();
		} );
		$input.filter(':checked').trigger('change');
	}

    // Dom Ready
    $(function() {
        togglePostFormatMetaBoxes();
    });

})(jQuery);