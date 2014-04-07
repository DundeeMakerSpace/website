<?php
// Template name: Page Builder

if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['post'] = Timber::get_post();
if ( !is_singular() ) {
    $context['is_archive'] = true;
    $context['pagination'] = Timber::get_pagination();
}

if ( get_field( 'hide_title' ) ) {
    $context['title'] = false;
}

Timber::render( 'builder.twig', $context );