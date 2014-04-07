<?php
/**
 * Flexible Posts Widget: Default widget template
 */

$context = Timber::get_context();
$context['before_widget'] = $before_widget . $before_title . $title . $after_title;
$context['after_widget'] = $after_widget;
$post_ids = array();
foreach ( $flexible_posts->posts as $post ) {
	$post_ids[] = $post->ID;
}
$context['flexible_posts'] = Timber::get_posts( $post_ids );

Timber::render( 'partials/flexible-widget.twig', $context );
