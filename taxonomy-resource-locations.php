<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}

global $wp_query;
$query = $wp_query->query;
$query['posts_per_page'] = -1;

$context = Timber::get_context();
$context['resources'] = Timber::get_posts( $query );
$context['term_description'] = term_description();

Timber::render( 'resource-type.twig', $context );
