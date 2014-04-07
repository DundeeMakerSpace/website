<?php
// Template name: Members List

if (!class_exists('Timber')){
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
}
$context = Timber::get_context();
$context['post'] = Timber::get_post();
if ( !is_singular() ) {
    $context['is_archive'] = true;
    $context['pagination'] = Timber::get_pagination();
}

// $members = get_users();
// shuffle( $members );
// $context['members'] = $members;


$sqlQuery = "SELECT SQL_CALC_FOUND_ROWS u.ID, u.user_login, u.user_email, UNIX_TIMESTAMP(u.user_registered) as joindate, mu.membership_id, mu.initial_payment, mu.billing_amount, mu.cycle_period, mu.cycle_number, mu.billing_limit, mu.trial_amount, mu.trial_limit, UNIX_TIMESTAMP(mu.startdate) as startdate, UNIX_TIMESTAMP(mu.enddate) as enddate, m.name as membership FROM $wpdb->users u LEFT JOIN $wpdb->pmpro_memberships_users mu ON u.ID = mu.user_id LEFT JOIN $wpdb->pmpro_membership_levels m ON mu.membership_id = m.id";
$sqlQuery .= " WHERE mu.membership_id > 0  ";
$sqlQuery .= " AND mu.status = 'active' ";
$sqlQuery .= "GROUP BY u.ID ";
$sqlQuery .= "ORDER BY u.user_registered DESC ";
$members = $wpdb->get_results( $sqlQuery, 'ARRAY_A' );

foreach( $members as $key => $member ) {
    $members[$key]['userdata'] = get_userdata( $member['ID'] );
    $members[$key]['meta'] = get_user_meta( $member['ID'] );
    $members[$key]['avatar'] = get_avatar( $member['ID'], 300 );
    $members[$key]['posts'] = Timber::get_posts( array(
        'author' => $member['ID'],
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => array( 'blog' )
            ),
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array( 'post-format-standard' )
            )
        )
    ) );
    $members[$key]['projects'] = Timber::get_posts( array(
        'post_type' => 'projects',
        'connected_type' => 'project_contributors',
        'connected_items' => $member['ID'],
        'suppress_filters' => false,
        'nopaging' => true
    ) );
}

shuffle( $members );
$context['members'] = $members;


Timber::render( 'members.twig', $context );