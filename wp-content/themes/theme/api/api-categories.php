<?php
function categories_func(){
//    global $wpdb;


    $posts_arr = [];


    //$cat_id = $wpdb->get_results( 'SELECT wp_terms.term_id, wp_terms.name, wp_terms.slug, wp_term_taxonomy.count, wp_termmeta.* FROM wp_terms JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id JOIN wp_termmeta ON wp_termmeta.term_id = wp_term_taxonomy.term_id WHERE wp_term_taxonomy.taxonomy = "categories" AND wp_termmeta.meta_key = "popular" AND wp_termmeta.meta_value = 1 ORDER BY wp_terms.name ASC');
//    $cat_id = get_terms( 'categories', [
//        'hide_empty' => true,
//        'meta_key' => 'popular',
//        'meta_value' => '1',
//        'meta_query' => [
//            'queue_qu' => [
//                'key'     => 'queue',
//                'value'   => 0,
//                'compare' => '>'
//            ],
//        ],
//        'orderby' => 'queue_qu',
//        'order' => 'ASC'
//    ] );

//    foreach ($cat_id as $i => $page) {
//
//        $posts_arr[$i] = $page;
//        $image = get_field('icon', 'categories-shops_'.$page->term_id);
//        $posts_arr[$i]->image_url = $image['url'];
//        $posts_arr[$i]->name = str_replace('&amp;', '&', $page->name);
//    }
    $object_json_link = file_get_contents(get_template_directory() .'/array-page/categories/page-categories.json');
    $object_json = json_decode($object_json_link, true);
    return $object_json;
}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/categories', [
        'methods'  => 'GET',
        'callback' => 'categories_func',
        'permission_callback' => '__return_true',
    ] );

} );


