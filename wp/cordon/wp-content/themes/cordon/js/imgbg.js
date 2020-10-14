(function($) {
    "use strict";
    //replace the data-background into background image
    $(".img-bg").each(function() {
        var imG = $(this).data('background');
        $(this).css('background-image', "url('" + imG + "') "

        );
    });
})(jQuery);