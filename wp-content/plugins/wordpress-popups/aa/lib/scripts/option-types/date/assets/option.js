AArpr_Option_Type_Date = (function ($) {
    "use strict";

    // public
    var debug_level = 0,
        maincontainer = null;
    
    // init function, autoload
    (function init() {
        // load the triggers
        $(document).ready(function(){

            $('.AArpr-item-date').each(function(i) {
                var $this       = $(this),
                    input       = $this.find('input[type="text"]'),
                    input_alt   = $this.find('input[type="hidden"]'),
                    settings    = $this.find('.AArpr-date-settings'),
                    dateFormat  = settings.data('date_format'),
                    yearRange   = settings.data('year_range'),
                    defaultDate = settings.data('default_date'),
                    altFormat   = settings.data('alt_format');

                // datepicker
                var atts = {
                    changeMonth : true,
                    changeYear  : true,
                    onClose     : function() {
                        input.trigger('change');
                    }
                };
                
                atts.dateFormat = dateFormat;
                atts.defaultDate= defaultDate;
                atts.altField   = '#' + input_alt.prop('id');
                atts.altFormat  = altFormat;
                
                if ( '' != yearRange ) {
                    atts.yearRange  = yearRange;
                }
 
                input.datepicker( atts );
            });
        });
    })();
    
})(jQuery);