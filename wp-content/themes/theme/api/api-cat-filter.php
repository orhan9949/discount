<?php
function Filter_cat_func (WP_REST_Request $request)
    {
        $page            = $request['page'];
        $cat             = $request['cat'];
        $tax_slug        = $request['tax_slug'];
        $sortBy          = $request['sortBy'];
        $sort            = $request['sort'];
        $priceFrom       = $request['priceFrom'];
        $priceTo         = $request['priceTo'];
        $discountFrom    = $request['discountFrom'];
        $discountTo      = $request['discountTo'];
        $args = array(
            'post_type'        => 'products',
            'post_status'      => 'publish',
            'posts_per_page'   => 100,
            'paged'            => $page,
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        if($sortBy == 'date' || $sortBy == 'views_click'){
            $args = array_merge($args , array(
                'orderby' => $sortBy,
                'order' => $sort,

            ));
        }
        if($sortBy == 'sale_size' || $sortBy == 'price'){
            $args = array_merge($args , array(
                'orderby' => 'meta_value_num',
                'meta_key' => $sortBy,
                'order' => $sort,

            ));
        }
        if($cat){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        array(
                            'taxonomy' => $cat,
                            'field' => 'slug',
                            'terms' => $tax_slug,
                        ),
                    ),
                ),
            ));

        }
        if($priceFrom && $priceTo && $discountFrom && $discountTo){
            $args = array_merge($args , array(
                'meta_query' => array(
                    'relation' => 'AND', // OR/AND в зависимости от логики
                    array(
                        'key' => 'price', // сумма с НДС по которой ищем
                        'value' => array($priceFrom, $priceTo), // значение в промежутке от-до
                        'type' => 'numeric',
                        'compare' => 'BETWEEN',
                    ),
                    array(
                        'key' => 'sale_size',
                        'value' => array($discountFrom, $discountTo),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN',
                    ),
                ),
            ));

        }



        $my_posts = new WP_Query($args);
        foreach ($my_posts->posts as $i => $pos) {
            $posts_arr[$i] = $pos;
            $posts_arr[$i]->id = $pos->ID;
            $posts_arr[$i]->old_price = get_field("old_price", $pos->ID);
            $posts_arr[$i]->price = get_field("price", $pos->ID);
            $posts_arr[$i]->sale = get_field("sale", $pos->ID);
            $posts_arr[$i]->sale_size = get_field("sale_size", $pos->ID);
            $posts_arr[$i]->source = get_field("source", $pos->ID);
            $posts_arr[$i]->rating = get_field("rating", $pos->ID);
            $posts_arr[$i]->promocode = get_field("promocode", $pos->ID);
            $posts_arr[$i]->expiration_date = get_field("expiration_date", $pos->ID);
            global $wpdb;
            $posts_arr[$i]->image_url = get_field('image_url', $pos->ID);
            if (!$posts_arr[$i]->image_url):
                $posts_arr[$i]->image_url = get_the_post_thumbnail_url($pos->ID, 'meduim');
            endif;
            $posts_arr[$i]->images_url = [];
            $gallery = get_field('gallery', $pos->ID);
            if($gallery):
                foreach($gallery as $g){
                    array_push($posts_arr[$i]->images_url, $g["url"]);
                }
            endif;


            $posts_arr[$i]->shop_link = get_field('link', $pos->ID);
            $term = get_term_by( 'slug', strtolower(get_field('source', $pos->ID)), 'categories-shops' );
            $image = get_field('icon', 'categories-shops_'.$term->term_id);
            $posts_arr[$i]->shop_name = $term->name;
            $posts_arr[$i]->shop_slug = $term->slug;
            $posts_arr[$i]->shop_image_url = $image['url'];
//            $posts_arr['posts'][$i]->expiration_date = get_field('expiration_date', $post->ID);
            $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
                                                FROM wp_term_relationships
                                                JOIN wp_term_taxonomy
                                                  ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                                                JOIN wp_terms
                                                  ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
                                                WHERE object_id= "'.$pos->ID.'"
                                                AND wp_term_taxonomy.taxonomy LIKE "categories"
                                                        ');
            if(!empty($taxsonomy[0]->term_taxonomy_id)){
                $posts_arr[$i]->category_id = $taxsonomy[0]->term_taxonomy_id;
            }

        }
        return $posts_arr;
};
//$obj = new Filter_cat_func();
//echo $obj->result;




add_action('rest_api_init', function () {

    register_rest_route('theme/v1', '/filter_cat', [
        'methods' => 'GET',
        'callback' => 'Filter_cat_func',
        'permission_callback' => '__return_true',
    ]);

});
add_action('rest_api_init', function () {

    register_rest_route('theme/v1', '/filter_cat?page=(?P<page>.+)&cat=(?P<cat>.+)&tax_slug=(?P<tax_slug>.+)&sort=(?P<sort>.+)&sortby=(?P<sortby>.+)&priceFrom=(?P<priceFrom>.+)&priceTo=(?P<priceTo>.+)&discountFrom=(?P<discountFrom>.+)&discountTo=(?P<discountTo>.+)', [
        'methods' => 'GET',
        'callback' => 'Filter_cat_func',
        'permission_callback' => '__return_true',
    ]);

});