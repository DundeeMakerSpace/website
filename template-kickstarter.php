<?php
// Template Name: Kickstarter
define( 'DONOTCACHEPAGE', true );
$context = Timber::get_context();
$context['post'] = Timber::get_post();

$context['style'] = TPHelpers::get_theme_resource_uri( 'kickstarter.css' );

Timber::render( 'kickstarter.twig', $context );
