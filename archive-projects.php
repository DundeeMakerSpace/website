<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['projects'] = Timber::get_posts( array (
    'post_type' => 'projects',
    'posts_per_page' => -1
) );
if ( !is_singular() ) {
    $context['is_archive'] = true;
    $context['pagination'] = Timber::get_pagination();
}
Timber::render( 'projects.twig', $context );