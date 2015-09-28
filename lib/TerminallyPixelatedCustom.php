<?php
/**
 * Add any extra minor functions in here
 */
class TerminallyPixelatedCustom {

    function __construct() {
        // add_action( 'wp_footer', array( $this, 'typekit' ) );
        add_filter( 'timber_context', array( $this, 'theme_variables' ) );
        add_action( 'after_setup_theme', array( $this, 'format_support' ) );
        add_action( 'admin_init', array( $this, 'editor_gravity_forms_access' ) );
        // add_action( 'wp_enqueue_scripts', array( $this, 'open_notification' ) );
        add_filter( 'author_link', array( $this, 'member_link' ), 10, 3);
        add_filter( 'login_url', array( $this, 'member_login_url' ), 10, 2 );
        // add_action( 'init', array( $this, 'map' ) );
    }

    public static function typekit() { ?>
        <script type="text/javascript" src="//use.typekit.net/afn3kvy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php }

    public static function theme_variables( $context ) {
        $context['donate_page'] = get_field( 'site_donate_page', 'options' );



        return $context;
    }

    function map() {
        TerminallyPixelatedMap::init(
            'makerspace-map',
            56.456189,
            -2.978143,
            14,
            '<address>Unit 5, <br/>Vision Building, <br />20 Greenmarket, <br />DD1 4QB</address>
            <a target="_blank" href="' . TerminallyPixelatedMap::get_directions_link( 'Unit 5, 20 Greenmarket, DD1 4QB' ) . '">Get Directions</a>'
        );
    }

    public static function format_support() {
        add_theme_support( 'post-formats', array( 'status' ) );
    }

    public static function editor_gravity_forms_access() {
        $role = get_role( 'editor' );
        $role->add_cap( 'gform_full_access' );
    }

    public static function open_notification() {
        wp_enqueue_script( 'open-notification', TPHelpers::get_theme_resource_uri( 'js/makerspace-open.js' ), array( 'jquery' ), false, true );
    }

    public static function member_link( $link, $author_id, $author_nicename ) {
        $members_pages = get_pages( array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-members.php',
            'number' => 1
        ) );
        if ( $members_pages ) {
            $members_link = get_permalink( $members_pages[0]->ID );
            $link = $members_link . '#' . $author_nicename;
        }
        return $link;
    }

    public static function member_login_url( $login_url, $redirect ) {
        $login_pages = get_pages( array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'template-login.php',
            'number' => 1
        ) );
        if ( $login_pages ) {
            $login_url = get_permalink( $login_pages[0]->ID );
            if ( $redirect ) {
                $login_url .= '?redirect_to=' . $redirect;
            }
        }
        return $login_url;
    }

}
