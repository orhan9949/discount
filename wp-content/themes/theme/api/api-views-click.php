<?php
add_action( 'rest_api_init', function(){
    register_rest_route('theme/v1', 'views', [
            'methods' => 'GET',
            'callback' => 'api_views_click',
            'permission_callback' => '__return_true',
        ]
    );
});
add_action( 'rest_api_init', function(){
    register_rest_route('theme/v1', 'views?id=(?P<id>.+)', [
            'methods' => 'GET',
            'callback' => 'api_views_click',
            'permission_callback' => '__return_true',
        ]
    );
});

function api_views_click(WP_REST_Request $request) {
    $post_ID = $request['id'];
    $metakey = 'views_click';
    $get = get_post($post_ID, ARRAY_A);
    $total_views_click = $get[$metakey];
    $count = ($total_views_click + 1);

    global $wpdb;
    $wpdb->update(  'wp_posts',
        [ $metakey => $count],
        [ 'ID' => $post_ID]
    );
    return $count;
}
