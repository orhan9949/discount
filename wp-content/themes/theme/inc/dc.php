<?php
function dc_cat_info($cat) {
    global $wpdb;

    $cache_key = 'dc_count_' . $cat;
    $count = wp_cache_get( $cache_key, 'dc' );
	if ( false !== $count ) {
        return $count;
    } else {
        $query = "SELECT COUNT(*) as total FROM `wp_term_relationships` WHERE `term_taxonomy_id` = %d";
        $result = $wpdb->get_var( $wpdb->prepare( $query, $cat ) );

        $result = $result . ' Deals';
        wp_cache_set( $cache_key, $result, 'dc', 3600 );
        return $result;
    }
}

function dc_passed(
    $date,
    $time_format = 'H:i',
    $month_format = 'H:i d/m',
    $year_format = 'H:i d/m/Y'
) {
    $date = new DateTime($date);
    $today = new \DateTime('now', $date->getTimezone());
    $yesterday = new \DateTime('-1 day', $date->getTimezone());
    $tomorrow = new \DateTime('+1 day', $date->getTimezone());
    $minutes_ago = round(($today->format('U') - $date->format('U')) / 60);
    $minutes_in = round(($date->format('U') - $today->format('U')) / 60);



    if ($minutes_ago > 0 && $minutes_ago < 60) {

        return sprintf('%s minutes ago', $minutes_ago);



    } elseif ($minutes_in > 0 && $minutes_in < 60) {

        return sprintf('in %s minutes', $minutes_in);



    } elseif ($today->format('ymd') == $date->format('ymd')) {

        return sprintf('today at %s', $date->format($time_format));



    } elseif ($yesterday->format('ymd') == $date->format('ymd')) {

        return sprintf('yesterday at %s', $date->format($time_format));



    } elseif ($tomorrow->format('ymd') == $date->format('ymd')) {

        return sprintf('tomorrow at %s', $date->format($time_format));



    } elseif ($today->format('Y') == $date->format('Y')) {

        return $date->format($month_format);



    } else {

        return $date->format($year_format);

    }

}

function dc_price($product_id) {
    $price = get_field('price', $product_id);
    $sale = get_field('sale', $product_id);

    if( $price ) {
        $old_price = get_field('old_price', $product_id);
        if( $old_price ) {
            $procent = round(100 - (($price/$old_price) * 100));
            $old_price = '<span style="text-decoration-line: line-through; margin-right: 10px">₹ '.$old_price.'</span>';
        }
		
        return '<div class="product__price">
			'.$old_price.'
            ₹ '.$price.'
			('.$procent.'%)
			
        </div>';
    } elseif( $sale ) {
        return '<div class="product__price">' . $sale . '%</div>';
    } else {
        return '';
    }
}


function dc_sale($price, $old_price) {

    if( empty($old_price) ) {

        return '';

    }

    

    $procent = round(100 - (($price/$old_price) * 100));



    return '<span>₹ '.$old_price.' (-'.$procent.'%)</span>';

}



function dc_comment( $comment, $args, $depth ) {

    $class = '';



    if( $depth > 1 ) {

        $class .= ' comment__item_reply';

    }



    $likes = get_comment_meta( get_comment_ID(), 'likes', true );

	?>

	<div class="comment__item<?=$class ?>" id="comment-<?php comment_ID() ?>">

        <div class="comment__author">

            <div class="comment__pic">

                <?php

                if ( $args['avatar_size'] != 0 ) {

                    echo get_avatar( $comment, $args['avatar_size'] );

                }

                ?>

            </div>

            <div class="comment__info">

                <?php echo get_comment_author(); ?>

                <span>

                    <?php

                    printf(

                        __( '%1$s at %2$s' ),

                        get_comment_date(),

                        get_comment_time()

                    ); ?>

                    

                    <!-- <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?> -->

                </span>

            </div>

        </div>

        <div class="comment__text">

            <?php if ( $comment->comment_approved == '0' ) { ?>

                <em class="comment-awaiting-moderation">

                    <?php _e( 'Your comment is awaiting moderation.' ); ?>

                </em><br/>

            <?php } ?>

            <?php comment_text(); ?>

        </div>

        <div class="comment__bottom">

            <div class="comment__actions">

                <a href="#" class="action_like" data-id="<?php comment_ID() ?>" data-type="comment"><svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 9C22 8.46957 21.7893 7.96086 21.4142 7.58579C21.0391 7.21071 20.5304 7 20 7H13.68L14.64 2.43C14.66 2.33 14.67 2.22 14.67 2.11C14.67 1.7 14.5 1.32 14.23 1.05L13.17 0L6.59 6.58C6.22 6.95 6 7.45 6 8V18C6 18.5304 6.21071 19.0391 6.58579 19.4142C6.96086 19.7893 7.46957 20 8 20H17C17.83 20 18.54 19.5 18.84 18.78L21.86 11.73C21.95 11.5 22 11.26 22 11V9ZM0 20H4V8H0V20Z" fill="#A3A3A3"/></svg> Like</a>

                <?php

                comment_reply_link(

                    array_merge(

                        $args,

                        array(

                            'depth'     => $depth,

                            'max_depth' => $args['max_depth'],

                            'reply_text' => '<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.55556 4.8V0L0 8.4L8.55556 16.8V11.88C14.6667 11.88 18.9444 13.8 22 18C20.7778 12 17.1111 6 8.55556 4.8Z" fill="#A3A3A3"/></svg> Reply'

                        )

                    )

                ); ?>

            </div>

            <div class="comment__like">

                <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 9C22 8.46957 21.7893 7.96086 21.4142 7.58579C21.0391 7.21071 20.5304 7 20 7H13.68L14.64 2.43C14.66 2.33 14.67 2.22 14.67 2.11C14.67 1.7 14.5 1.32 14.23 1.05L13.17 0L6.59 6.58C6.22 6.95 6 7.45 6 8V18C6 18.5304 6.21071 19.0391 6.58579 19.4142C6.96086 19.7893 7.46957 20 8 20H17C17.83 20 18.54 19.5 18.84 18.78L21.86 11.73C21.95 11.5 22 11.26 22 11V9ZM0 20H4V8H0V20Z" fill="#04BFCE"/></svg> <span><?php echo empty($likes) ? 0 : $likes; ?></span>

            </div>

        </div>

    </div>

    <?php 

}



add_action( 'wp_ajax_nopriv_dc_search', 'dc_search' );

add_action( 'wp_ajax_dc_search', 'dc_search' );

function dc_search() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $search = sanitize_text_field($_POST['s']);

    if( !empty($search) ) {

        $query = new WP_Query(array(

            's' => $search,

            'post_type' => 'products',

            'post_status' => 'publish',

            'orderby' => 'date',

            'posts_per_page' => 10

        ));

        

        if ( $query->have_posts() ) {

            $result['success'] = true;



            while ( $query->have_posts() ) {

                $query->the_post();



                $result['posts'][] = [

                    'title' => get_the_title(),

                    'image' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),

                    'link' => get_permalink(),

                ];

            }

        }

        

        wp_reset_postdata();

    }



	echo json_encode($result);

	wp_die();

}



add_action( 'wp_ajax_nopriv_dc_like', 'dc_like' );

add_action( 'wp_ajax_dc_like', 'dc_like' );

function dc_like() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $comment_id = sanitize_text_field($_POST['id']);

    if( !empty($comment_id) ) {

        if( is_user_logged_in() ) {

            $user_id = get_current_user_id();



            $likes = get_comment_meta( $comment_id, 'likes', true );

            $likes_data = get_comment_meta( $comment_id, 'likes_data', true );



            if( empty($likes_data) || !isset($likes_data[$user_id]) ) {

                $likes = intval($likes);

                $likes += 1;

                $likes_data[$user_id] = $likes;



                update_comment_meta( $comment_id, 'likes', $likes );

                update_comment_meta( $comment_id, 'likes_data', $likes_data );



                $result['success'] = true;

                $result['value'] = $likes;

            } else {

                $result['message'] = 'You have already liked.';

            }

        } else {

            $result['message'] = 'Authorization required.';

        }

    }



	echo json_encode($result);

	wp_die();

}



add_action( 'wp_ajax_nopriv_dc_fav', 'dc_fav' );

add_action( 'wp_ajax_dc_fav', 'dc_fav' );

function dc_fav() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $product_id = sanitize_text_field($_POST['id']);

    if( !empty($product_id) ) {

        if( is_user_logged_in() ) {

            $saved = get_user_meta( get_current_user_id(), 'saved', true );



            if( empty($saved) ) $saved = [];



            if( empty($saved) || !isset($saved[$product_id]) ) {

                $saved[$product_id] = time();



                $result['message'] = 'Deal Added.';

            } else {

                unset($saved[$product_id]);

                

                $result['message'] = 'Deal Removed.';

            }



            update_user_meta( get_current_user_id(), 'saved', $saved );

        } else {

            $result['message'] = 'Authorization required.';

        }

    }



	echo json_encode($result);

	wp_die();

}



 add_action( 'wp_ajax_nopriv_dc_reg', 'dc_reg' );

function dc_reg() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $login = $_POST['login'];

    $password = $_POST['password'];

    $email = $_POST['email'];



    if( $login != '' && $password != '' && $email != '' ) {

        $user_id = wp_create_user( $login, $password, $email );

        

        if ( is_wp_error( $user_id ) ) {

            $result['message'] = $user_id->get_error_message();

        } else {

            $creds = array();

            $creds['user_login'] = $login;

            $creds['user_password'] = $password;

            $creds['remember'] = true;



            $user = wp_signon( $creds, false );



            if ( is_wp_error($user) ) {

                $result['message'] = $user->get_error_message();

            } else {

                $result['success'] = true;

                $result['message'] = 'You have successfully registered. Now you will be transferred to your personal account.';

            }

        }

    } else {

        $result['message'] = 'All fields are required.';

    }



	echo json_encode($result);

	wp_die();

} 


/* add_action( 'wp_ajax_nopriv_dc_reg', 'dc_reg' );

function dc_reg() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $login = $_POST['login'];
	
	$email = $_POST['email'];

    $password = $_POST['password'];

    



    if( $login != '' && $email != '' && $password != '') {

        $user_id = wp_create_user( $login, $email, $password);

        

        if ( is_wp_error( $user_id ) ) {

            $result['message'] = $user_id->get_error_message();

        } else {

            $creds = array();

            $creds['user_login'] = $login;
			$creds['user_email'] = $email;
            $creds['user_password'] = $password;
            $creds['remember'] = true;



            $user = wp_signon( $creds, false );



            if ( is_wp_error($user) ) {

                $result['message'] = $user->get_error_message();

            } else {

                $result['success'] = true;

                $result['message'] = 'You have successfully registered. Now you will be transferred to your personal account.';

            }

        }

    } else {

        $result['message'] = 'All fields are required.';

    }



	echo json_encode($result);

	wp_die();

} */



 add_action( 'wp_ajax_nopriv_dc_login', 'dc_login' );

function dc_login() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $login = $_POST['login'];

    $password = $_POST['password'];



    if( $login != '' && $password != '' ) {

        $creds = array();

        $creds['user_login'] = $login;

        $creds['user_password'] = $password;

        $creds['remember'] = true;



        $user = wp_signon( $creds, false );



        if ( is_wp_error($user) ) {

            #$result['message'] = $user->get_error_message();

            $result['message'] = 'Wrong login or password.';
        } else {

            $result['success'] = true;

        }

    } else {

        $result['message'] = 'All fields are required.';

    }



	echo json_encode($result);

	wp_die();

} 


/*
add_action( 'wp_ajax_nopriv_dc_email', 'dc_email' );

function dc_email() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $email = $_POST['email'];

    $password = $_POST['password'];



    if( $email != '' && $password != '' ) {

        $creds = array();

        $creds['user_email'] = $email;

        $creds['user_password'] = $password;

        $creds['remember'] = true;



        $user = wp_signon( $creds, false );



        if ( is_wp_error($user) ) {

            #$result['message'] = $user->get_error_message();

            $result['message'] = 'Wrong email or password.';

        } else {

            $result['success'] = true;

        }

    } else {

        $result['message'] = 'All fields are required.';

    }



	echo json_encode($result);

	wp_die();

} */



add_action( 'wp_ajax_dc_personal', 'dc_personal' );
function dc_personal() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $user_id = wp_update_user( [

        'ID'           => get_current_user_id(),

        'display_name' => sanitize_text_field($_POST['display_name']),
		'city' 		   =>  sanitize_text_field($_POST['city']),
		'gender' 	   =>  sanitize_text_field($_POST['gender']),
		
    ] );



    if ( is_wp_error( $user_id ) ) {

        $result['message'] = 'An unknown error has occurred, please try again later.';

    } else {

        update_user_meta( get_current_user_id(), 'description', sanitize_text_field($_POST['description']) );

        $result['success'] = true;

    }



	echo json_encode($result);

	wp_die();

}



add_action( 'wp_ajax_nopriv_dc_rating', 'dc_rating' );

add_action( 'wp_ajax_dc_rating', 'dc_rating' );

function dc_rating() {

	check_ajax_referer( 'dcajax-nonce', 'nonce_code' );



    $result = [];

    $result['success'] = false;



    $product_id = sanitize_text_field($_POST['id']);

    $type = sanitize_text_field($_POST['type']);

    if( !empty($product_id) && in_array($type, ['plus', 'minus']) ) {

        if( is_user_logged_in() ) {

            $user_id = get_current_user_id();



            $rating = get_post_meta($product_id, 'rating', true);

            $rating_data = get_post_meta($product_id, 'rating_data', true);



            if( empty($rating_data) || !isset($rating_data[$user_id]) ) {

                if( empty($rating) ) $rating = 0;

                if( empty($rating_data) ) $rating_data = [];

    

                $rating = intval($rating);

    

                if( $type == 'plus' ) {

                    $rating += 1;

                } else {

                    $rating = $rating-1;

                }



                $rating_data[$user_id] = $rating;



                update_post_meta( $product_id, 'rating', $rating );

                update_post_meta( $product_id, 'rating_data', $rating_data );



                $result['success'] = true;

                $result['value'] = $rating;

            } else {

                $result['message'] = 'You have already rated.';

            }

        } else {

            $result['message'] = 'Authorization required.';

        }

    }



	echo json_encode($result);

	wp_die();

}