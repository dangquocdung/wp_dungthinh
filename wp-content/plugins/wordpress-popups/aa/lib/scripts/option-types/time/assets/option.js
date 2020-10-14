AArpr_Option_Type_Time = (function ($) {
    "use strict";

    // public
    var debug_level = 0,
        maincontainer = null;
    
    // init function, autoload
    (function init() {
        // load the triggers
        $(document).ready(function(){

            $('.AArpr-item-time').each(function(i) {
                var $this       = $(this),
                    input       = $this.find('input[type="text"]'),
                    settings    = $this.find('.AArpr-time-settings'),
                    time_format = settings.data('time_format'),
                    hourminsec  = settings.data('hourminsec'),
                    hour_range  = settings.data('hour_range'),
                    min_range   = settings.data('min_range'),
                    sec_range   = settings.data('sec_range');

                if ( '' != hourminsec ) {
                    input.val( hourminsec );
                }

                // datepicker
                var atts = {};

                atts.timeOnly       = true;
                atts.timeFormat     = time_format;

                if ( '' != hourminsec ) {
                    atts.defaultValue   = hourminsec;
                    
                    var __   = hourminsec.split(':');
                    switch ( __.length ) {
                        case 3:
                            atts.hour           = __[0];
                            atts.minute         = __[1];
                            atts.second         = __[2];
                            break;
                            
                        case 2:
                            atts.hour           = __[0];
                            atts.minute         = __[1];
                            break;
                            
                        case 1:
                            atts.hour           = __[0];
                            break;

                        default:
                            break;
                    }
                }
 
                if ( '' != hour_range ) {
                    atts.hourMin        = parseInt( hour_range.split(':')[0] );
                    atts.hourMax        = parseInt( hour_range.split(':')[1] );
                }
                if ( '' != min_range ) {
                    atts.minuteMin      = parseInt( min_range.split(':')[0] );
                    atts.minuteMax      = parseInt( min_range.split(':')[1] );
                }
                if ( '' != sec_range ) {
                    atts.secondMin      = parseInt( sec_range.split(':')[0] );
                    atts.secondMax      = parseInt( sec_range.split(':')[1] );
                }
 
                input.timepicker( atts );
            });
        });
    })();
    
})(jQuery);