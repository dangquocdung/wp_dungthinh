(function($) {
    "use strict";

    //google map load
    $('#map_canvas').gmap({
        'center': '-6.94010,107.62575',
        'zoom': 15,
        scrollwheel: false,
        'disableDefaultUI': false,
        'styles': [{
            stylers: [{
                lightness: 7
            }, {
                saturation: -100
            }]
        }],
        'callback': function() {
            var self = this;
			
            self.addMarker({
                    'position': this.get('map').getCenter(),
                    icon: 'images/office-building.png',
                })     
        }
    });


})(jQuery);