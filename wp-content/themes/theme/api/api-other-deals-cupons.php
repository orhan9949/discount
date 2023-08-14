<?php
/**
 *
 *
 * **  Апи для Other Deals который находится в детальной карточке товара
 *
 *
 */

function other_deals_func( WP_REST_Request $request ){
    $object_json_link = file_get_contents(get_template_directory() .'/array-page/single-page/other-deals.json');
    $object_json = json_decode($object_json_link, true);
    foreach ($object_json as $object):
        if($object["slug"] == $request['shop']):
            return $object;
        endif;
    endforeach;

}
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/other_deals', [
        'methods'  => 'GET',
        'callback' => 'other_deals_func',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/other_deals?shop=(?P<shop>.+)', [
        'methods'  => 'GET',
        'callback' => 'other_deals_func',
        'permission_callback' => '__return_true',
    ] );

} );