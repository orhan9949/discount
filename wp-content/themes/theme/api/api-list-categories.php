<?php
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        '/list_categories',
        [
            'methods'  => 'GET',
            'callback' => 'list_categories_func',
            'permission_callback' => '__return_true',
        ]
    );

} );
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        '/list_categories?categories=(?P<categories>.+)&id=(?P<id>.+)&page=(?P<page>.+)&limit=(?P<limit>.+)',
        [
            'methods'  => 'GET',
            'callback' => 'list_categories_func',
            'permission_callback' => '__return_true',
        ]
    );

} );

function list_categories_func( WP_REST_Request $request ){
    $posts_arr = [];
    $args = array(
        'post_type'=> 'products',
        'posts_per_page' => $request['limit'],
        'paged' => get_query_var('paged') ?: $request['page'],

        'tax_query' => array(
            array(
                'taxonomy' => $request['categories'],
                'field' => 'id',
                'terms' => $request['id']
            )

        ),
        'post_status' => 'publish',
        'orderby'=> 'DESC',

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
        $sale_size = get_post_meta( $post->ID, 'sale_size', '' );
        foreach($sale_size as $old_pr){
            $posts_arr[$i]->sale_size = $old_pr;
        }
        $posts_arr[$i]->sale = get_field(  'sale', $post->ID );
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
        global $wpdb;
//        $image_url = $wpdb->get_results('SELECT wp_posts.guid FROM wp_postmeta JOIN wp_posts ON wp_postmeta.meta_value = wp_posts.ID WHERE post_id= '.$post->ID.' AND wp_postmeta.meta_key LIKE "_thumbnail_id"');
//        foreach($image_url as $old_pr){
//            $posts_arr[$i]->image_url = $old_pr->guid;
//        };
        $posts_arr[$i]->image_url = get_field('image_url', $post->ID);
        if (!$posts_arr[$i]->image_url):
            $posts_arr[$i]->image_url = get_the_post_thumbnail_url($post->ID, 'meduim');
        endif;
        $posts_arr[$i]->images_url = [];
        $gallery = get_field('gallery', $post->ID);
        if($gallery):
            foreach($gallery as $g){
                array_push($posts_arr[$i]->images_url, $g["url"]);
            }
        endif;


        $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
        FROM wp_term_relationships
        JOIN wp_term_taxonomy
          ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
        JOIN wp_terms
          ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
        WHERE object_id= "'.$post->ID.'"
        AND wp_term_taxonomy.taxonomy LIKE "categories"
');

        $request_cat = $request['categories'];
//        $term = get_terms( array( 'taxonomy' => $request_cat, 'include' => $request['id'] ) );
        $term = get_term_by( 'slug', strtolower(get_field('source', $post->ID)), 'categories-shops' );
        $posts_arr[$i]->category_id = $taxsonomy[0]->term_taxonomy_id;
        $image = get_field('icon', 'categories-shops'.'_'.$term->term_id);
        $posts_arr[$i]->shop_link = get_field('link', $post->ID);
        $posts_arr[$i]->shop_name = $term->name;
        $posts_arr[$i]->shop_image_url = $image['url'];
//        $posts_arr[$i]->tiimeeeeee = $taxsonomy;
//        $posts_arr[$i]->tasdsadiimeeeeee =  get_the_terms($post->ID , $request_cat)[0]->taxonomy;
//        $term2 = wp_get_post_categories($post->ID);
//        $posts_arr[$i]->tasdsaeee = $taxsonomy[0]->term_taxonomy_id;

    }

    return $posts_arr;
}