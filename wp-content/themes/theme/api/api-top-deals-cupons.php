<?php
/**
 *
 *
 * **  Апи для Top Deals который находится в детальной карточке товара
 *
 *
 */

function top_deals_func( WP_REST_Request $request ){
    $object_json_link = file_get_contents(get_template_directory() .'/array-page/single-page/top-deals.json');
    $object_json = json_decode($object_json_link, true);
    foreach ($object_json as $object):
        if($object["term_slug"] == $request['cat']):
            return $object;
        endif;
    endforeach;

}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/top_deals', [
        'methods'  => 'GET',
        'callback' => 'top_deals_func',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/top_deals?cat=(?P<cat>.+)', [
        'methods'  => 'GET',
        'callback' => 'top_deals_func',
        'permission_callback' => '__return_true',
    ] );

} );