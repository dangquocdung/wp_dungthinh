AArpr_Option_Type_Multiselect_l2r = (function ($) {
    "use strict";

    // public
    var debug_level = 0,
        maincontainer = null;
    
	// init function, autoload
	(function init() {
		// load the triggers
		$(document).ready(function(){
		    multiselect_left2right();
		    form_submit();
		});
	})();
	
    function multiselect_left2right( autselect ) {
        var $allListBtn = $('.AArpr-multiselect-l2r-btn');
        var autselect = autselect || false;
 
        if ( $allListBtn.length > 0 ) {
            $allListBtn.each(function(i, el) {
 
                var $this = $(el),
                    $multisel_available = $this
                        .prevAll('.AArpr-multiselect-available')
                        .find('select.multisel_l2r_available'),
                    $multisel_selected = $this
                        .prevAll('.AArpr-multiselect-selected')
                        .find('select.multisel_l2r_selected');
 
                if ( autselect ) {

                    $multisel_selected.find('option').each(function() {
                        $(this).prop('selected', true);
                    });
                    $multisel_available.find('option').each(function() {
                        $(this).prop('selected', false);
                    });
                } else {

                    $this.on('click', '.moveright', function(e) {
                        e.preventDefault();
                        $multisel_available.find('option:selected').appendTo($multisel_selected);
                    });
                    $this.on('click', '.moverightall', function(e) {
                        e.preventDefault();
                        $multisel_available.find('option').appendTo($multisel_selected);
                    });
                    $this.on('click', '.moveleft', function(e) {
                        e.preventDefault();
                        $multisel_selected.find('option:selected').appendTo($multisel_available);
                    });
                    $this.on('click', '.moveleftall', function(e) {
                        e.preventDefault();
                        $multisel_selected.find('option').appendTo($multisel_available);
                    });
                }
            });
        }
    }
    
    function form_submit() {
        var $form = $('.AArpr-item-multiselect-l2r').parents('form');
        
        $form.on('submit', function(e) {
            multiselect_left2right( true );
        });
    }

})(jQuery);