<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}

$context = Timber::get_context();
$context['resources'] = Timber::get_posts();
$context['term_description'] = term_description();

Timber::render( 'resource-type.twig', $context );
