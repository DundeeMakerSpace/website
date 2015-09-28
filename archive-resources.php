<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();

// Get resource types
$context['resource_types'] = Timber::get_terms( 'resource-types', array(
    'orderby' => 'count',
    'hide_empty' => true
) );

Timber::render( 'resources.twig', $context );