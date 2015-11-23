<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['post'] = Timber::get_post();
$context['is_archive'] = false;
$context['title'] = false;

if ( function_exists( 'tribe_get_events' ) ) {
    $events = tribe_get_events( array(
        'eventDisplay'   => 'list',
        'posts_per_page' => 2,
        'tribe_render_context' => 'widget',
    ) );
    $context['next_events'] = Timber::get_posts( $events );
}

$context['widgets'] = Timber::get_widgets( 'home_widgets' );

Timber::render( 'home.twig', $context );
