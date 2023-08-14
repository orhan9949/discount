<?php
function shop_func(){
    global $wpdb;


    $posts_arr = [];


        $cat_id = $wpdb->get_results( 'SELECT wp_terms.term_id, wp_terms.name, wp_terms.slug, wp_term_taxonomy.count, wp_termmeta.* FROM wp_terms JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id JOIN wp_termmeta ON wp_termmeta.term_id = wp_term_taxonomy.term_id WHERE wp_term_taxonomy.taxonomy = "categories-shops" AND wp_termmeta.meta_key = "popular" ORDER BY wp_terms.name ASC');

    foreach ($cat_id as $i => $page) {

        $posts_arr[$i] = $page;
        $image = get_field('icon', 'categories-shops_'.$page->term_id);
        $posts_arr[$i]->image_url = $image['url'];
        $posts_arr[$i]->name = str_replace('&amp;', '&', $page->name);
    }
    return $posts_arr;
}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/shop', [
        'methods'  => 'GET',
        'callback' => 'shop_func',
        'permission_callback' => '__return_true',
    ] );

} );


