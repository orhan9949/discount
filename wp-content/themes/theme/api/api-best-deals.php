<?php
function best_deals_func(){
    $object_json_link = file_get_contents(get_template_directory() .'/array-page/best-deals/object.json');
    $object_json = json_decode($object_json_link, true);
    $new_arr = [];
    $new_arr["categories"] = $object_json[0]["categories"];
    $new_arr["categories_shops"] = $object_json[1]["categories_shops"];
    $new_arr["posts"] = $object_json[2]["posts"];
    $obj =  (object)$new_arr;
//echo 'connect';
return $obj;

}
add_action( 'rest_api_init', function(){

register_rest_route( 'theme/v1', '/best_deals', [
'methods'  => 'GET',
'callback' => 'best_deals_func',
'permission_callback' => '__return_true',
] );

} );