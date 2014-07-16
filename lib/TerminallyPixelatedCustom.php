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
        add_filter( 'author_link', array( $this, 'member_link' ), 10, 3);
        add_filter( 'login_url', array( $this, 'member_login_url' ), 10, 2 );
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