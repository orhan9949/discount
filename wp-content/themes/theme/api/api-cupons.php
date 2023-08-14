<?php
function products_func_search( WP_REST_Request $request1 ){
    $args = array(  'post_type'=> 'products',
        'posts_per_page' => 100,
//        'orderby'=> 'data' ,
        'orderby' => 'views_click',
        'order' => 'DESC',
        'post_status' => 'publish',
//        's' => mb_eregi_replace("[^a-zA-Z0-9]['%20',' ']+", ' ',  $request1['searchText']));
        's' => $request1['searchText']);
    $posts_arr = [];
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
        global $wpdb;
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

        $posts_arr[$i]->shop_link = get_field('link', $post->ID);
        $term = get_term_by( 'slug', get_field('source', $post->ID), 'categories-shops' );
        $image = get_field('icon', 'categories-shops_'.$term->term_id);
        $posts_arr[$i]->shop_name = $image['title'];
        $posts_arr[$i]->shop_image_url = $image['url'];
        $posts_arr[$i]->expiration_date = get_field('expiration_date', $post->ID);
        $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
                                                        FROM wp_term_relationships
                                                        JOIN wp_term_taxonomy
                                                          ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                                                        JOIN wp_terms
                                                          ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
                                                        WHERE object_id= "'.$post->ID.'"
                                                        AND wp_term_taxonomy.taxonomy LIKE "categories"
                                                        ');
        $posts_arr[$i]->category_id = $taxsonomy[0]->term_taxonomy_id;
    }





    return $posts_arr;
}

function products_func_id( WP_REST_Request $request2 ){


    $post = get_post($request2['id']);
        $posts_arr = [];
        $posts_arr = $post;
        $posts_arr->id = $post->ID;
        $old_price = get_post_meta( $post->ID, 'old_price', '' );
        foreach($old_price as $old_pr){
            $posts_arr->old_price = $old_pr;
        }
        $price = get_post_meta( $post->ID, 'price', '' );
        foreach($price as $old_pr){
            $posts_arr->price = $old_pr;
        }
        $sale_size = get_post_meta( $post->ID, 'sale', '' );
        foreach($sale_size as $old_pr){
            $posts_arr->sale = $old_pr;
        }
        $sale_size = get_post_meta( $post->ID, 'sale_size', '' );
        foreach($sale_size as $old_pr){
            $posts_arr->sale_size = $old_pr;
        }
        $source = get_post_meta( $post->ID, 'source', '' );
        foreach($source as $old_pr){
            $posts_arr->source = $old_pr;
        }
        $rating = get_post_meta( $post->ID, 'rating', '' );
        foreach($rating as $old_pr){
            $posts_arr->rating = $old_pr;
        }
        $promocode = get_post_meta( $post->ID, 'promocode', '' );
        foreach($promocode as $old_pr){
            $posts_arr->promocode = $old_pr;
        }
        $expiration_date = get_post_meta( $post->ID, 'expiration_date', '' );
        foreach($expiration_date as $old_pr){
            $posts_arr->expiration_date = $old_pr;
        }
        global $wpdb;
        $posts_arr->image_url = get_field('image_url', $post->ID);
        if (!$posts_arr->image_url):
                $posts_arr->image_url = get_the_post_thumbnail_url($post->ID, 'meduim');
        endif;
        $posts_arr->images_url = [];
        $gallery = get_field('gallery', $post->ID);
        if($gallery):
            foreach($gallery as $g){
                array_push($posts_arr->images_url, $g["url"]);
            }
        endif;


        $posts_arr->shop_link = get_field('link', $post->ID);
        $term = get_term_by( 'name', get_field('source', $post->ID), 'categories-shops' );
        $image = get_field('icon', 'categories-shops_'.$term->term_id);
        $posts_arr->shop_name = $image['title'];
        $posts_arr->shop_image_url = $image['url'];
        $posts_arr->expiration_date = get_field('expiration_date', $post->ID);
        $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
                                                        FROM wp_term_relationships
                                                        JOIN wp_term_taxonomy
                                                          ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                                                        JOIN wp_terms
                                                          ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
                                                        WHERE object_id= "'.$post->ID.'"
                                                        AND wp_term_taxonomy.taxonomy LIKE "categories"
                                                        ');
        $posts_arr->category_id = $taxsonomy[0]->term_taxonomy_id;



        $similar = new WP_Query(array(
            'post_type' 		=> 'products',
            'post_status' 		=> 'publish',
            'meta_query'        => 'meta_value',
            'orderby'           => 'meta_value_num',
            'meta_key'          => 'price',
            'order'             =>  'ASC',
            "s"                 =>  $posts_arr->post_title,
            'post__not_in' 		=> [ $post->ID ],
            'posts_per_page' 	=> 5
        ));

        $similar_total = $similar->get_posts();
        $similar_arr = [];
        if( $similar_total ) {
            foreach($similar_total as $sim_i => $sim){
                $similar_arr[$sim_i] = $sim;
                $similar_arr[$sim_i]->old_price = get_post_meta( $sim->ID, 'old_price', true );
                $similar_arr[$sim_i]->price = get_post_meta( $sim->ID, 'price', true );
                $similar_arr[$sim_i]->sale_size = get_post_meta( $sim->ID, 'sale_size', true );
            }
        }
        $posts_arr->similar = $similar_arr;



        $term = get_term_by('name', get_field('source',$post->ID), 'categories-shops');
        $other_deals = new WP_Query( [
            'post_type' => 'products',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                ),
            ),
            'orderby' => 'price',
            'order' => 'DESC',
            'posts_per_page' => 5
        ] );

        $other_deals_total = $other_deals->get_posts();
        $other_deals_arr = [];
        if( $other_deals_total ) {

            foreach($other_deals_total as $other_i => $other_d){
                $other_deals_arr[$other_i] = $other_d;
                $other_deals_arr[$other_i]->old_price = get_post_meta( $other_d->ID, 'old_price', true );
                $other_deals_arr[$other_i]->price = get_post_meta( $other_d->ID, 'price', true );
                $other_deals_arr[$other_i]->sale_size = get_post_meta( $other_d->ID, 'sale_size', true );
            }

        }
        $posts_arr->other_deals = $other_deals_arr;

    return $posts_arr;
}




function products_func( WP_REST_Request $data ){
    $args = array(
        'post_type'=> 'products',
//        'posts_per_page' => 20,
        'posts_per_page' =>  $data['limit'],
        'paged' => get_query_var('paged') ?:  $data['page'],
        'post_status' => 'publish',
        'meta_query' => 'meta_value',
        'meta_key' => 'sale_size',
        'orderby' => array( 'views_click' => 'DESC', 'meta_value_num' => 'DESC' ),
//        'orderby'=> 'data'
        );
    $posts_arr = [];
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
        global $wpdb;
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

        $posts_arr[$i]->shop_link = get_field('link', $post->ID);
        $term = get_term_by( 'name', get_field('source', $post->ID), 'categories-shops' );
        $image = get_field('icon', 'categories-shops_'.$term->term_id);
        $posts_arr[$i]->shop_name = $image['title'];
        $posts_arr[$i]->shop_image_url = $image['url'];
        $posts_arr[$i]->expiration_date = get_field('expiration_date', $post->ID);
        $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
                                                FROM wp_term_relationships
                                                JOIN wp_term_taxonomy
                                                  ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                                                JOIN wp_terms
                                                  ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
                                                WHERE object_id= "'.$post->ID.'"
                                                AND wp_term_taxonomy.taxonomy LIKE "categories"
                                                        ');
        $posts_arr[$i]->category_id = $taxsonomy[0]->term_taxonomy_id;
    }





    return $posts_arr;

}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/products', [
        'methods'  => 'GET',
        'callback' => 'products_func',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/products/page=(?P<page>.+)&limit=(?P<limit>.+)', [
        'methods'  => 'GET',
        'callback' => 'products_func',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/products/id/(?P<id>.+)', [
        'methods'  => 'GET',
        'callback' => 'products_func_id',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/products/search/(?P<searchText>.+)', [
        'methods'  => 'GET',
        'callback' => 'products_func_search',
        'permission_callback' => '__return_true',
    ] );

} );


