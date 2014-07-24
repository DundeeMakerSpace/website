<?php
if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$projects = get_posts( array (
    'post_type' => 'projects',
    'posts_per_page' => -1,
    'orderby' => 'modified'
) );

foreach ( $projects as $project ) {
    $status = false;
    $maker = false;
    if ( $statuses = get_the_terms( $project, 'project-status' ) ) {
        $status = array_values( $statuses );
        $status = $status[0];
    }
    if ( $makers = get_users( array(
        'connected_type' => 'project_contributors',
        'connected_items' => $project
    ) ) ) {
        $maker = $makers[0];
    } else {
        $maker_id = $project->post_author;
        $maker = get_userdata( $maker_id );
    }
    $project->maker = $maker;
    $project->project_status = $status;
}

$context['projects'] = Timber::get_posts( $projects );

// if ( !is_singular() ) {
    // $context['is_archive'] = true;
    // $context['pagination'] = Timber::get_pagination();
// }
Timber::render( 'projects.twig', $context );