<?php
/**
 * Add any extra minor functions in here
 */
class TerminallyPixelatedCustom {

    function __construct() {
        // add_action( 'wp_footer', array( $this, 'typekit' ) );
        add_filter( 'timber_context', array( $this, 'donate_page' ) );
        add_action( 'after_setup_theme', array( $this, 'format_support' ) );
        add_action( 'admin_init', array( $this, 'editor_gravity_forms_access' ) );
    }

    public static function typekit() { ?>
        <script type="text/javascript" src="//use.typekit.net/afn3kvy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php }

    public static function donate_page( $context ) {
        $context['donate_page'] = get_field( 'site_donate_page', 'options' );
        return $context;
    }

    public static function format_support() {
        add_theme_support( 'post-formats', array( 'status' ) );
    }

    public static function editor_gravity_forms_access() {
        $role = get_role( 'editor' );
        $role->add_cap( 'gform_full_access' );
    }

}