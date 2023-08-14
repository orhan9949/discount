<?php
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        '/users/auth', [
            'methods' => 'POST',
            'callback' => 'theme_user_auth',
            'permission_callback' => '__return_true',
        ]
    );
});
add_action( 'rest_api_init', function(){
    register_rest_route('theme/v1', '/users/auth?email=(?P<email>.+)&password=(?P<password>.+)', [
            'methods' => 'POST',
            'callback' => 'theme_user_auth',
            'permission_callback' => '__return_true',
        ]
    );
});
function theme_user_auth(WP_REST_Request $request) {

    $login = sanitize_text_field($request['email']);
    $password = $request['password'];
//    $auth = wp_authenticate( $login, $password );
//
//    if( !is_wp_error( $auth ) ) {
//        $user_arr = [];
//        $user = get_user_by('email', $login);
//        $user_id = $user->ID;
//        $user_current = get_user_meta( $user_id );
//            $user_arr['user_data'] = $user;
//            $user_arr['user_data']->avatar_url = get_avatar_url($user_id);
//            $user_arr['user_metadata'] = $user_current;
//        return $user_arr;
//    }else{
//        echo $auth->get_error_message();
//    }


    $auth = array();
    $auth['user_login'] = $login;
    $auth['user_password'] = $password;
    $auth['remember'] = true;

    $user = wp_signon( $auth );

    if( !is_wp_error($user) ) {
        $user_arr = [];
        $user = get_user_by('email', $login);
        $user_id = $user->ID;
        $user_current = get_user_meta( $user_id );
        $user_arr['user_data'] = $user;
        $user_arr['user_data']->data->id = $user_id;
        unset($user_arr['user_data']->data->ID);
//      $user_arr['user_data']->avatar_url = get_avatar_url($user_id);
        $user_arr['user_metadata']["city"] = $user_current["city"][0];
        $user_arr['user_metadata']["my_birthday"] = $user_current["my_birthday"][0];
        return $user_arr;
    }else{
        echo $user->get_error_message();
    }
}