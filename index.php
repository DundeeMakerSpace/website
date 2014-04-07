<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
if ( !is_singular() ) {
    $context['is_archive'] = true;
    $context['pagination'] = Timber::get_pagination();
}
Timber::render( 'index.twig', $context );