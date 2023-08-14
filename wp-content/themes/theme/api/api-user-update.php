<?php
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        '/user_upload',
        [
            'methods'  => 'POST',
            'callback' => 'theme_user_upload',
            'permission_callback' => '__return_true',
        ]
    );

} );
add_action( 'rest_api_init', function(){
    register_rest_route(
        'theme/v1',
        '/user_upload?id=(?P<id>.+)&city=(?P<city>.+)&my_birthday=(?P<my_birthday>.+)&nickname=(?P<nickname>.+)&login=(<login>)',
        [
            'methods' => 'POST',
            'callback' => 'theme_user_upload',
            'permission_callback' => '__return_true',
        ]
    );
});
function theme_user_upload(WP_REST_Request $request)
{
    $user_id = $request['id'];
    if(get_userdata($user_id) == true ){
        if(!empty($request['nickname'])){
            update_user_meta($user_id, 'nickname', sanitize_text_field($request['nickname']));
        }
        if(!empty($request['city'])){
            update_user_meta($user_id, 'city', sanitize_text_field($request['city']));
        }
        if(!empty($request['my_birthday'])){
            update_user_meta($user_id, 'my_birthday', sanitize_text_field($request['my_birthday']));
        }
        if(!empty($request['login'])){
            global $wpdb;
            $wpdb->update(
                $wpdb->users,
                ['user_login' => sanitize_text_field($request['login'])],
                ['ID' => $user_id]
            );
        }
        $file = $_FILES['file'];
        $file_file =  $_SERVER['DOCUMENT_ROOT'].'/wp-content/users-photo/' . $user_id . '-' . date('Y-m-d-H-i-s') . mb_strtolower(mb_substr(mb_strrchr($file['name'], '.'), 0));
        $filename_old = get_user_meta($user_id, 'author_img',true);
        $url_for_db = '/wp-content/users-photo/' . $user_id . '-' . date('Y-m-d-H-i-s') . mb_strtolower(mb_substr(mb_strrchr($file['name'], '.'), 0));
        if(!empty($file)) {
            unlink($filename_old);
            if (move_uploaded_file($file['tmp_name'], $file_file)) {
                update_user_meta($user_id, 'author_img' ,$url_for_db);
//                echo 'загрузка файла прошла';
            }
        }
    }else{
        echo "User not found";
    }

}