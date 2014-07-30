(function($){

    var leaflet_init = function() {
        // Create map
        var map = L.map(leaflet_config.id, {
            scrollWheelZoom: false,
            touchZoom: false,
            dragging: false,
            zoomControl: false,
            attributionControl: false
        }).setView([leaflet_config.lat, leaflet_config.lng], leaflet_config.zoom);

        // Create layer styles
        // More available from http://leaflet-extras.github.io/leaflet-providers/preview/
        var map_tiles = L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            subdomains: 'abcd',
            minZoom: 0,
            maxZoom: 20
        });
        map_tiles.addTo(map);

        // Add marker
        var hiddenMakerIcon = L.divIcon({className: 'hidden-marker-icon'});
        var marker = L.marker([leaflet_config.lat, leaflet_config.lng], {icon: hiddenMakerIcon, clickable: false}).addTo(map);

        // Add optional popup
        if ('undefined' !== typeof leaflet_config.popup && leaflet_config.popup ) {
            // var popup = L.popup();
            // popup.setContent(leaflet_config.popup);
            // marker.bindPopup(popup);
            var popup = L.popup({
                keepInView: true,
                minWidth: 250,
                maxWidth: 250,
                closeOnClick: false,
                closeButton: false
            });
            popup.setContent(leaflet_config.popup);

            marker.bindPopup(popup, {'offset': new L.Point(0, -25)}).openPopup();
        }

        // Require a click to activae map stuff
        var enableMapInteraction = function () {
            map.scrollWheelZoom.enable();
            map.touchZoom.enable();
            map.dragging.enable();
        }

        $('#' + leaflet_config.id).on('click touch', enableMapInteraction);
    }

    leaflet_init();

})(jQuery);