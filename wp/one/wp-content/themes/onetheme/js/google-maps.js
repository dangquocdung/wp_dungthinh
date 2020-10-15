var map;
function initMap() {
    var elem = document.getElementById('tt-google-map');
    var _lat = elem.getAttribute('data-lat');
    var _lng = elem.getAttribute('data-lng');
    var _color = elem.getAttribute('data-color');
    var _sat = elem.getAttribute('data-saturation');
    var _zoom = parseInt(elem.getAttribute('data-zoom'), 10);
    var _marker = elem.getAttribute('data-marker');
    var _contentAddress = elem.innerHTML;
    elem.innerHTML = '';
    var styles =[{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels.text.fill","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.landcover","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural.terrain","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#050404"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#f5e8e8"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"off"},{"color":"#090909"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"visibility":"off"},{"color":"#ecd7d7"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"visibility":"on"}]}];
    
    var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
    var curLatlng = new google.maps.LatLng(_lat, _lng);

    var mapOptions = {
        zoom: _zoom,
        center: curLatlng,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        },
        scrollwheel: false,
        disableDefaultUI :true,
        streetViewControl: false
    };
    var map = new google.maps.Map(elem, mapOptions);


    var marker = new google.maps.Marker({
        position: curLatlng,
        title: "Themeton: Google Map",
        map: map,
        icon: _marker
    });
    marker.setMap(map);


    var infowindow = new google.maps.InfoWindow({
        content: _contentAddress,
        maxWidth: 400
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');

}