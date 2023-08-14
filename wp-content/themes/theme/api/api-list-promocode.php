<?php
function promocodes_func( WP_REST_Request $data ){

    $posts_arr = [];
$args = array(
    'post_type'=> 'products',
    'posts_per_page' => $data['limit'],
    'post_status' => 'publish',
    'orderby'=> 'DESC',
    'paged' => get_query_var('paged') ?: $data['page'],
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    'tax_query' => array(
        array(
            'taxonomy' => 'promocodes',
            'field' => 'slug',
            'terms' => 'promo'
        )
    )
);

$sposts = get_posts($args);
foreach($sposts as $i => $post) {


    $posts_arr[$i] = $post;
    $posts_arr[$i]->id = $post->ID;
    $old_price = get_post_meta( $post->ID, 'old_price', '' );
    foreach($old_price as $old_pr){
        $posts_arr[$i]->old_price = $old_pr;
    }
    $price = get_post_meta( $post->ID, 'price', '' );
    foreach($price as $old_pr){
        $posts_arr[$i]->price = $old_pr;
    }
    $sale_size = get_post_meta( $post->ID, 'sale', '' );
    foreach($sale_size as $old_pr){
        $posts_arr[$i]->sale = $old_pr;
    }
    $sale_size = get_post_meta( $post->ID, 'sale_size', '' );
    foreach($sale_size as $old_pr){
        $posts_arr[$i]->sale_size = $old_pr;
    }
    $source = get_post_meta( $post->ID, 'source', '' );
    foreach($source as $old_pr){
        $posts_arr[$i]->source = $old_pr;
    }
    $rating = get_post_meta( $post->ID, 'rating', '' );
    foreach($rating as $old_pr){
        $posts_arr[$i]->rating = $old_pr;
    }
    $promocode = get_post_meta( $post->ID, 'promocode', '' );
    foreach($promocode as $old_pr){
        $posts_arr[$i]->promocode = $old_pr;
    }
    $expiration_date = get_post_meta( $post->ID, 'expiration_date', '' );
    foreach($expiration_date as $old_pr){
        $posts_arr[$i]->expiration_date = $old_pr;
    }
//    global $wpdb;
//    $img_url = $wpdb->get_results('SELECT wp_posts.guid FROM wp_postmeta JOIN wp_posts ON wp_postmeta.meta_value = wp_posts.ID WHERE post_id= '.$post->ID.' AND wp_postmeta.meta_key LIKE "_thumbnail_id"');
//    foreach($img_url as $old_pr) {
//        $posts_arr[$i]->image_url = $old_pr->guid;
//
//    }
    $posts_arr[$i]->image_url = get_field('image_url', $post->ID);
    if (!$posts_arr[$i]->image_url):
        $posts_arr[$i]->image_url = get_the_post_thumbnail_url($post->ID, 'meduim');
    endif;
    $term = get_term_by( 'name', get_field('source', $post->ID), 'categories-shops' );
    $image = get_field('icon', 'categories-shops_'.$term->term_id);
    $posts_arr[$i]->shop_link = get_field('link', $post->ID);
    $posts_arr[$i]->shop_name = $image['title'];
    $posts_arr[$i]->shop_image_url = $image['url'];
    $posts_arr[$i]->expiration_date = get_field('expiration_date', $post->ID);
    $posts_arr[$i]->category_id = $term->term_id;
}



//    echo $page, $limit;
    return $posts_arr;
}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/promocodes', [
        'methods'  => 'GET',
        'callback' => 'promocodes_func',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/promocodes/page=(?P<page>.+)&limit=(?P<limit>.+)', [
        'methods'  => 'GET',
        'callback' => 'promocodes_func',
        'permission_callback' => '__return_true',
    ] );

} );