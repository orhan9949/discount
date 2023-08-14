<?php
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        'users/register', [
            'methods' => 'POST',
            'callback' => 'theme_user_register',
            'permission_callback' => '__return_true',
        ]
    );
});
add_action( 'rest_api_init', function(){
    register_rest_route('theme/v1', 'users/register?login=(?P<login>.+)&email=(?P<email>.+)&password=(?P<password>.+)', [
            'methods' => 'POST',
            'callback' => 'theme_user_register',
            'permission_callback' => '__return_true',
        ]
    );
});
function theme_user_register(WP_REST_Request $request) {

    $response = array();
    $username = sanitize_text_field($request['login']);
    $email = sanitize_text_field($request['email']);
    $password = sanitize_text_field($request['password']);
//    echo ' 1) ' .$username;
//    echo ' 2) ' .$email;
//    echo ' 3) ' .$password;
    $error = new WP_Error();
    if (empty($username)) {
        $error->add(400, __('Username field '.$username.' is required.'), array('status' => 400));
        return $error;
    }
    if (empty($email)) {
        $error->add(401, __('Email field '.$email.' is required.'), array('status' => 400));
        return $error;
    }
    if (empty($password)) {
        $error->add(404, __('Password field '.$password.' is required.'), array('status' => 400));
        return $error;
    }

    $user_id = username_exists($username);
    if (!$user_id && email_exists($email) == false) {
        $user_id = wp_create_user($username, $password, $email);
        if (!is_wp_error($user_id)) {
            // Ger User Meta Data (Sensitive, Password included. DO NOT pass to front end.)
            $user = get_user_by('id', $user_id);
            // $user-set_role($role);
            $user->set_role('subscriber');
            // Ger User Data (Non-Sensitive, Pass to front end.)
            $response['code'] = 200;
            $response['message'] = __('User ' .$username. ' Registration was Successful.' );
        } else {
            return $user_id;
        }
    } else {
        $error->add(406, __('Email already exists, please try Reset Password'), array('status' => 400));
        return $error;
    }

    $auth = array();
    $auth['user_login'] = $username;
    $auth['user_password'] = $password;
    $auth['remember'] = true;

    $user = wp_signon( $auth );

    if( !is_wp_error($user) ) {
        $user_arr = [];
        $user_arr['user_data']->data->id = $user_id;
        return $user_arr;
    }else{
        echo $user->get_error_message();
    }
//    return new WP_REST_Response($response, 123);
}