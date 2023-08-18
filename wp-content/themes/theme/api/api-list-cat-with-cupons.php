<?php
function api_list_cat_with_cupons_func(){
    global $wpdb;


    $posts_arr = [];


    $cat_id = $wpdb->get_results( 'SELECT * FROM wp_term_relationships GROUP BY wp_term_relationships.object_id DESC');


    foreach ($cat_id as $i => $page) {
//        $posts_arr[$i]['object_id'] = $page->object_id;
        $posts_arr[$i]['object_id'] = $page->object_id;
        $posts_arr[$i]['term_taxonomy_id'] = $page->term_taxonomy_id;

    }
    return $posts_arr;
}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/api_list_cat_with_cupons', [
        'methods'  => 'GET',
        'callback' => 'api_list_cat_with_cupons_func',
        'permission_callback' => '__return_true',
    ] );

} );
