<?php
function homepage_func(){

            $object_json_link = file_get_contents(get_template_directory() .'/array-page/home/object-mob.json');
            $object_json = json_decode($object_json_link, true);
            $new_arr = [];


            $new_arr["slider_1"] = $object_json[0]["slider_1"];
            $new_arr["slider_3"] = $object_json[1]["slider_3"];
            $new_arr["best-deals"] = $object_json[2]["best_deals"];
            $new_arr["cat_with_posts"] = $object_json[3]["cat_with_posts"];
            $obj =  (object)$new_arr;





//        echo 'connect';
    return $obj ;
}
    add_action( 'rest_api_init', function(){

        register_rest_route( 'theme/v1', '/homepage', [
            'methods'  => 'GET',
            'callback' => 'homepage_func',
            'permission_callback' => '__return_true',
        ] );

    } );

