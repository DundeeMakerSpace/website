<?php
/**
 * Simple map functionality with leaflet js
 */
class TerminallyPixelatedMap {

    function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
    }

    public function scripts() {
        wp_register_script( 'leaflet', 'http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js', false, false, true );
        wp_register_script( 'leaflet-init', TPHelpers::get_theme_resource_uri( 'js/leaflet-init.js' ), array( 'leaflet' ), false, true );
    }

    public static function init( $id, $lat, $lng, $zoom = 14, $popup = false ) {
        add_action( 'wp_enqueue_scripts', function() use ($id, $lat, $lng, $zoom, $popup ) {
            wp_localize_script( 'leaflet-init', 'leaflet_config', array(
                'id' => $id,
                'lat' => $lat,
                'lng' => $lng,
                'zoom' => $zoom,
                'popup' => $popup
            ) );
            wp_enqueue_script( 'leaflet-init' );
            wp_enqueue_style( 'leaflet', 'http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css' );
        }, 15 );
    }

    public static function get_directions_link( $address ) {
        return 'https://www.google.co.uk/maps/dir/my+location/' . str_replace( ' ', '+', $address ) . '/';
    }

}