<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();

$context['trainers'] = get_users( array(
    'connected_type' => 'resource_training',
    'connected_items' => $post
) );

Timber::render( 'index.twig', $context );