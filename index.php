<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
if ( !is_singular() ) {
    $context['is_archive'] = true;
    $context['pagination'] = Timber::get_pagination();
    if ( !$context['posts'] ) {
        // Uh oh!
        status_header( 404 );
        nocache_headers();
        include( get_query_template( '404' ) );
        die();
    }
} elseif ( is_page() ) {
    $context['hide_postmeta'] = true;
    $context['title'] = false;
}

Timber::render( 'index.twig', $context );
