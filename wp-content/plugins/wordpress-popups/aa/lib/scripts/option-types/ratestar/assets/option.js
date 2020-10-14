AArpr_Option_Type_Ratestar = (function ($) {
    "use strict";

    // public
    var debug_level = 0,
        maincontainer = null;
    
    // init function, autoload
    (function init() {
        // load the triggers
        $(document).ready(function(){

            $('.AArpr-item-ratestar').each(function(i) {
                var $this       = $(this),
                    rateit      = $this.find('.AArpr-rateit'),
                    output      = $this.find('output'),
                    nbstars     = rateit.data('nbstars'),
                    step        = rateit.data('step'),
                    input       = rateit.data('input'),
                    readonly    = rateit.data('readonly'),
                    resetable   = rateit.data('resetable'),
                    starwidth   = rateit.data('starwidth'),
                    starheight  = rateit.data('starheight');

                rateit.rateit({
                    max         : nbstars,
                    step        : step,
                    backingfld  : input,
                    readonly    : readonly,
                    resetable   : resetable,
                    starwidth   : starwidth,
                    starheight  : starheight
                });
                
                rateit.bind('rated', function (event, value) {
                    output.text( value );
                });
                
                rateit.bind('reset', function (event) {
                    output.text( 0 );
                });
    
                //rateit.bind('over', function (event, value) {
                //    output.text( value );
                //});
            });
        });
    })();

})(jQuery);