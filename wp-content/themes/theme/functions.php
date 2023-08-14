<?php
/**
 * Theme Discount.One
 *
 * @package WordPress
 */
define('TEMPLATE_DIR_URI', get_template_directory_uri());

add_action( 'admin_init', 'true_plugin_off' );
function true_plugin_off() {
    deactivate_plugins( 'google-site-kit/google-site-kit.php',$silent = true );
}


add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

add_action( 'after_setup_theme', 'thm_after' );
function thm_after() {
	register_nav_menus(
		array(
			'main' => 'Основное меню',
			'footer_1' => 'Меню в подвале 1',
			'footer_2' => 'Меню в подвале 2',
			'footer_3' => 'Меню в подвале 3',
		)
	);

	if ( !is_admin() ) {
		show_admin_bar( false );
	}
}

add_filter('wp_handle_upload_prefilter', 'custom_user_agent');
function custom_user_agent($file) {
    $user_agent = 'Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFTT Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36';
    $file['headers']['User-Agent'] = $user_agent;
    return $file;
}


/**
 * *********Подключение скриптов и стилей***************
 */
require get_template_directory() .'/functions-files/include-script-style.php';
/**
 * *********Конец Подключение скриптов и стилей***************
 */

function thm_init() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'start_post_rel_link',10,0);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action('wp_head', 'wp_resource_hints', 2);

	register_taxonomy( 'categories', [ 'products' ], [
		'label'                 => 'Категории',
		'labels'                => [
			'name'              => 'Категории',
			'singular_name'     => 'Категория',
			'search_items'      => 'Поиск',
			'all_items'         => 'Все',
			'view_item'         => 'Просмотр',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Изменить',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новое имя категории',
			'menu_name'         => 'Категории',
			'back_to_items'     => 'Назад',
		],
		'public'                => true,
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => false,
	] );
	
	register_taxonomy( 'categories_shops', [ 'products' ], [
		'label'                 => 'Магазины2',
		'labels'                => [
			'name'              => 'Магазины2',
			'singular_name'     => 'Магазин2',
			'search_items'      => 'Поиск',
			'all_items'         => 'Все',
			'view_item'         => 'Просмотр',
			'parent_item'       => 'Родительский магазин2',
			'parent_item_colon' => 'Родительский магазин2:',
			'edit_item'         => 'Изменить',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новое имя магазина2',
			'menu_name'         => 'Магазины2',
			'back_to_items'     => 'Назад',
		],
		'public'                => false,
		'hierarchical'          => false,
		'rewrite' 				=> true,
		'show_admin_column'     => false

	] );
	
	
	register_taxonomy( 'categories-shops', [ 'products' ], [
		'label'                 => 'Магазины',
		'labels'                => [
			'name'              => 'Магазины',
			'singular_name'     => 'Магазин',
			'search_items'      => 'Поиск',
			'all_items'         => 'Все',
			'view_item'         => 'Просмотр',
			'parent_item'       => 'Родительский магазин',
			'parent_item_colon' => 'Родительский магазин:',
			'edit_item'         => 'Изменить',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новое имя магазина',
			'menu_name'         => 'Магазины',
			'back_to_items'     => 'Назад',
		],
		'public'                => true,
		'hierarchical'          => false,
		'rewrite' 				=> true,
		'show_admin_column'     => false

	] );
	

	
		register_taxonomy( 'promocodes', [ 'products' ], [
		'label'                 => 'Промокоды',
		'labels'                => [
			'name'              => 'Промокоды',
			'singular_name'     => 'Промокод',
			'search_items'      => 'Поиск',
			'all_items'         => 'Все',
			'view_item'         => 'Просмотр',
			'parent_item'       => 'Родительский промокод',
			'parent_item_colon' => 'Родительский промокод:',
			'edit_item'         => 'Изменить',
			'update_item'       => 'Обновить',
			'add_new_item'      => 'Добавить',
			'new_item_name'     => 'Новое имя промокода',
			'menu_name'         => 'Промокоды',
			'back_to_items'     => 'Назад',
		],
		'public'                => true,
		'hierarchical'          => false,
		'rewrite'               => true,
		'show_admin_column'     => false
	] );



	register_post_type( 'products', [
		'label'  => null,
		'labels' => [
			'name'               => 'Купоны',
			'singular_name'      => 'Купон',
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавление купона', 
			'edit_item'          => 'Редактирование купона',
			'new_item'           => 'Новый купон', 
			'view_item'          => 'Смотреть купон', 
			'search_items'       => 'Поиск', 
			'menu_name'          => 'Купоны',
		],
		'public'                    => true,
		'show_in_menu'              => true,
		'menu_position'             => 4,
		'hierarchical'              => false,
		'supports'                  => [ 'title', 'editor', 'thumbnail', 'comments' ],
		'taxonomies'                => [ 'categories', 'categories_shops', 'promocodes','categories-shops'],
		'has_archive' 		        => true,
		'rewrite' 			        => true,
		'query_var' 		        => true,
        'show_in_rest'              => true,
        'rest_base'                 => 'products',
        'rest_controller_class'     => 'WP_REST_Posts_Controller',
	] );

	register_post_type( 'notifications', [
		'label'  => null,
		'labels' => [
			'name'               => 'Уведомления',
			'singular_name'      => 'Уведомления',
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавление', 
			'edit_item'          => 'Редактирование',
			'new_item'           => 'Новый', 
			'view_item'          => 'Смотреть', 
			'search_items'       => 'Поиск', 
			'menu_name'          => 'Уведомления',
		],
		'public'			  => false,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ],
	] );

	register_post_type( 'activity', [
		'label'  => null,
		'labels' => [
			'name'               => 'Действия',
			'singular_name'      => 'Действия',
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавление', 
			'edit_item'          => 'Редактирование',
			'new_item'           => 'Новый', 
			'view_item'          => 'Смотреть', 
			'search_items'       => 'Поиск', 
			'menu_name'          => 'Действия',
		],
		'public'			  => false,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ],
	] );
	
	register_post_type( 'support', [
		'label'  => null,
		'labels' => [
			'name'               => 'Действия',
			'singular_name'      => 'Действия',
			'add_new'            => 'Добавить',
			'add_new_item'       => 'Добавление', 
			'edit_item'          => 'Редактирование',
			'new_item'           => 'Новый', 
			'view_item'          => 'Смотреть', 
			'search_items'       => 'Поиск', 
			'menu_name'          => 'Поддержка',
		],
		'public'			  => false,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ],
	] );
}
add_action( 'init', 'thm_init' );

/**
 * Register columns for our taxonomy
 */
function gwp_register_category_columns( $columns ) {
    $columns['queue'] = __( 'Queue', 'generatewp' );
    return $columns;
}
add_filter( 'manage_edit-categories_columns', 'gwp_register_category_columns' );


/**
 * Retrieve value for our custom column
 *
 * @param int $number      Blank number.
 * @param string $column_name Name of the column.
 * @param int    $term_id     Term ID.
 */
function gwp_category_column_display( $number, $column_name, $term_id ) {
    return esc_html( get_term_meta( $term_id, $column_name, true ) ); // XSS ok.
}
add_filter( 'manage_categories_custom_column', 'gwp_category_column_display', 10, 3 );

/**
 * Display markup or template for custom field
 */
function gwp_quick_edit_category_field( $column_name, $screen ) {
    // If we're not iterating over our custom column, then skip
    if ( $screen != 'categories' && $column_name != 'queue' ) {
        return false;
    }
    ?>
    <fieldset>
        <div id="gwp-queue" class="inline-edit-col">
            <label>
                <span class="title"><?php _e( 'Queue', 'generatewp' ); ?></span>
                <span class="input-text-wrap"><input type="text" name="<?php echo esc_attr( $column_name ); ?>" class="ptitle" value=""></span>
            </label>
        </div>
    </fieldset>
    <?php
}
add_action( 'quick_edit_custom_box', 'gwp_quick_edit_category_field', 10, 2 );

/**
 * Callback runs when category is updated
 * Will save user-provided input into the wp_termmeta DB table
 */
function gwp_quick_edit_save_category_field( $term_id ) {
    if ( isset( $_POST['queue'] ) ) {
        // security tip: kses
        update_term_meta( $term_id, 'queue', $_POST['queue'] );
    }
}
add_action( 'edited_categories', 'gwp_quick_edit_save_category_field' );

/**
 * Front-end stuff for pulling in user-input values dynamically
 * into our input field.
 */
function gwp_quickedit_category_javascript() {
    $current_screen = get_current_screen();

    if ( $current_screen->id != 'edit-categories' || $current_screen->taxonomy != 'categories' ) {
        return;
    }

    // Ensure jQuery library is loaded
    wp_enqueue_script( 'jquery' );
    ?>
    <script type="text/javascript">
        /*global jQuery*/
        jQuery(function($) {
            $('#the-list').on( 'click', 'a.editinline', function( e ) {
                e.preventDefault();
                var $tr = $(this).closest('tr');
                var val = $tr.find('td.queue').text();
                // Update field
                $('tr.inline-edit-row :input[name="queue"]').val(val ? val : '');
            });
        });
    </script>
    <?php
}
add_action( 'admin_print_footer_scripts-edit-tags.php', 'gwp_quickedit_category_javascript' );



//        отключает Гуренберг для Купонов
add_filter( 'use_block_editor_for_post_type', 'my_disable_gutenberg', 10, 2 );
function my_disable_gutenberg( $current_status, $post_type ) {
    $disabled_post_types = [ 'products' ];
    return ! in_array( $post_type, $disabled_post_types, true );
}
//       Конец отключает Гуренберг для Купонов

//api для купонов
require get_template_directory() .'/api/api-cupons.php';

//Api для получение данных с главной страницы
require get_template_directory() .'/api/api-homepage.php';

//Api для получение всех категорий
require get_template_directory() .'/api/api-categories.php';

//Api для получение всех магазинов
require get_template_directory() .'/api/api-shop.php';

//Api для получения списка всех id купонов вместе с id категории
require get_template_directory() .'/api/api-list-cat-with-cupons.php';

//Api для получения списка всех промокодов
require get_template_directory() .'/api/api-list-promocode.php';

//Api для получения списка всех категорий
require get_template_directory() .'/api/api-list-categories.php';

//Api для регистрации пользователя
require get_template_directory() .'/api/api-user-register.php';

//Api для авторизации пользователя
require get_template_directory() .'/api/api-user-auth.php';

//Api для обновление данных пользователя
require get_template_directory() .'/api/api-user-update.php';

//Api для кликов по посту
require get_template_directory() .'/api/api-views-click.php';

//Api для страницы Best Deals
require get_template_directory() .'/api/api-best-deals.php';

//Api для страницы Top Deals
require get_template_directory() .'/api/api-top-deals-cupons.php';

//Api для страницы Other Deals
require get_template_directory() .'/api/api-other-deals-cupons.php';

//Api для страницы магазинов и категорий (Это фильтры)
require get_template_directory() .'/api/api-cat-filter.php';


add_filter('user_trailingslashit', 'no_page_slash', 70, 2);
function no_page_slash( $string, $type ){
   global $wp_rewrite;

	if( $type == 'page' && $wp_rewrite->using_permalinks() && $wp_rewrite->use_trailing_slashes )
		$string = untrailingslashit($string);


   return $string;
}

add_filter( 'wpseo_opengraph_url', 'my_opengraph_url' );
function my_opengraph_url( $url ) {
	return substr_replace($url, '', strlen($url)-1, 1);
}

add_action('customize_register', function($customizer) {
    $customizer->add_section(
        'general_main',
        array('title' => 'Основные данные', 'priority' => 11)
    );

	$customizer->add_setting('phone');
	$customizer->add_control('phone', array( 'label' => 'Номер телефона', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('email');
	$customizer->add_control('email', array( 'label' => 'Эл.почта', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('timework');
	$customizer->add_control('timework', array( 'label' => 'Время работы', 'section' => 'general_main', 'type' => 'text' ));
    $customizer->add_setting('copyright');
	$customizer->add_control('copyright', array( 'label' => 'Копирайт', 'section' => 'general_main', 'type' => 'text' ));
    $customizer->add_setting('moj');
	$customizer->add_control('moj', array( 'label' => 'Moj', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('telegram');
	$customizer->add_control('telegram', array( 'label' => 'Telegram', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('Josh');
	$customizer->add_control('Josh', array( 'label' => 'Josh', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('hipi');
	$customizer->add_control('hipi', array( 'label' => 'Hipi', 'section' => 'general_main', 'type' => 'text' ));
	$customizer->add_setting('sharechat');
	$customizer->add_control('sharechat', array( 'label' => 'ShareChat', 'section' => 'general_main', 'type' => 'text' ));
});

//if( function_exists('acf_add_options_page') ) {
//	acf_add_options_page(array(
//		'page_title' 	=> 'Настройки сайта',
//		'menu_title'	=> 'Настройки сайта',
//		'menu_slug'		=> 'site-settings',
//		'position'		=> 4,
//	));
//}

add_filter('navigation_markup_template', 'dc_navigation_template', 10, 2 );
function dc_navigation_template( $template, $class ) {
	return '
	<div class="paginations" role="navigation">
		<ul>%3$s</li></ul>
	</div>
	';
}

add_filter( 'paginate_links_output', 'dc_paginate_links' );
function dc_paginate_links( $html ) {
	$html = str_replace("<a", "<li><a", $html);
	$html = str_replace("<span", "<li><span", $html);
	$html = str_replace("/a>", "/a></li>", $html);
	$html = str_replace("/span>", "/span></li>", $html);
	return $html;
}

add_action( 'wp_footer', 'artabr_lm_footer_scripts' );
function artabr_lm_footer_scripts() {

	wp_enqueue_script( 'artabr_lm_ajax', get_template_directory_uri() . '/assets/js/ajax.js', true );
	wp_enqueue_script( 'historyjs', get_template_directory_uri() . '/assets/js/history.js', true );

	// Add parameters for the JS
	global $wp_query;
	$max   = $wp_query->max_num_pages;
	$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	wp_localize_script(
		'artabr_lm_ajax',
		'mts_ajax_loadposts',
		array(
			'startPage'     => $paged,
			'maxPages'      => $max,
			'nextLink'      => next_posts( $max, false ),
			'i18n_loadmore' => __( ' Load More...', 'mythemeshop' ),
			'i18n_nomore'   => __( ' No More', 'mythemeshop' ),
			'i18n_loading'  => __( ' Loading...', 'mythemeshop' ),
		)
	);

}


// когда пользователь сам редактирует свой профиль
add_action( 'show_user_profile', 'true_show_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile', 'true_show_profile_fields' );
 
function true_show_profile_fields( $user ) {
 
	// выводим заголовок для наших полей
 	echo '<h3>Дополнительная информация</h3>';
 
	// поля в профиле находятся в рамметке таблиц <table>
 	echo '<table class="form-table">';
 
 	// добавляем поле город
	$user_city = get_the_author_meta( 'city', $user->ID );
 	echo '<tr><th><label for="city">Location</label></th>
 	<td><input type="text" name="city" id="city" value="' . esc_attr( $user_city ) . '" class="regular-text" /></td>
	</tr>';

    // добавляем поле дата рождения
    $user_birthday = get_the_author_meta( 'my_birthday', $user->ID );
    echo '<tr><th><label for="my_birthday">Birthday</label></th>
 	<td><input type="date" name="my_birthday" id="my_birthday" value="'.esc_attr( $user_birthday ).'" class="regular-text" /></td>
	</tr>';

    // добавляем поле дата рождения
    $author_img = get_the_author_meta( 'author_img', $user->ID );
    echo '<tr><th><label for="my-birthday">Author_img</label></th>
 	<td><img style="width: 300px;height: auto;" src="'.esc_attr( $author_img ).'"></td>
	</tr>';

	// добавляем поле пол
	// также можно и установить значение по умолчанию
	$gender = ( $gender = get_the_author_meta( 'gender', $user->ID ) ) ? $gender : 'male';
 	echo '<tr><th><label for="gender">Пол</label></th>
 		<td><ul>
 			<li><label><input value="male" name="gender"' . checked( $gender, 'male', false ) . ' type="radio" /> мужской</label></li>
 			<li><label><input value="female" name="gender"' . checked( $gender, 'female', false ) . ' type="radio" /> женский</label></li>
			<li><label><input value="other" name="gender"' . checked( $gender, 'other', false ) . ' type="radio" /> другое</label></li>
 		</ul></td>
 	</tr>';
 
 	echo '</table>';
 
}

// когда пользователь сам редактирует свой профиль
//add_action( 'personal_options_update', 'true_save_profile_fields' );
// когда чей-то профиль редактируется админом например
add_action( 'edit_user_profile_update', 'true_save_profile_fields' );
 
function true_save_profile_fields( $user_id ) {

    update_user_meta( $user_id, 'author_img', sanitize_text_field( $_POST[ 'author_img' ] ) );
	update_user_meta( $user_id, 'city', sanitize_text_field( $_POST[ 'city' ] ) );
    update_user_meta( $user_id, 'my_birthday', sanitize_text_field( $_POST[ 'my_birthday' ] ) );
	update_user_meta( $user_id, 'gender', sanitize_text_field( $_POST[ 'gender' ] ) );
	
}


// СУПЕР Ф_ЦИЯ

/* Copyright 2018 Amazon.com, Inc. or its affiliates. All Rights Reserved. */
/* Licensed under the Apache License, Version 2.0. */

// Put your Secret Key in place of **********


class AwsV4 {

    private $accessKey = null;
    private $secretKey = null;
    private $path = null;
    private $regionName = null;
    private $serviceName = null;
    private $httpMethodName = null;
    private $queryParametes = array ();
    private $awsHeaders = array ();
    private $payload = "";

    private $HMACAlgorithm = "AWS4-HMAC-SHA256";
    private $aws4Request = "aws4_request";
    private $strSignedHeader = null;
    private $xAmzDate = null;
    private $currentDate = null;

    public function __construct($accessKey, $secretKey) {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->xAmzDate = $this->getTimeStamp ();
        $this->currentDate = $this->getDate ();
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setServiceName($serviceName) {
        $this->serviceName = $serviceName;
    }

    function setRegionName($regionName) {
        $this->regionName = $regionName;
    }

    function setPayload($payload) {
        $this->payload = $payload;
    }

    function setRequestMethod($method) {
        $this->httpMethodName = $method;
    }

    function addHeader($headerName, $headerValue) {
        $this->awsHeaders [$headerName] = $headerValue;
    }

    private function prepareCanonicalRequest() {
        $canonicalURL = "";
        $canonicalURL .= $this->httpMethodName . "\n";
        $canonicalURL .= $this->path . "\n" . "\n";
        $signedHeaders = '';
        foreach ( $this->awsHeaders as $key => $value ) {
            $signedHeaders .= $key . ";";
            $canonicalURL .= $key . ":" . $value . "\n";
        }
        $canonicalURL .= "\n";
        $this->strSignedHeader = substr ( $signedHeaders, 0, - 1 );
        $canonicalURL .= $this->strSignedHeader . "\n";
        $canonicalURL .= $this->generateHex ( $this->payload );
        return $canonicalURL;
    }

    private function prepareStringToSign($canonicalURL) {
        $stringToSign = '';
        $stringToSign .= $this->HMACAlgorithm . "\n";
        $stringToSign .= $this->xAmzDate . "\n";
        $stringToSign .= $this->currentDate . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "\n";
        $stringToSign .= $this->generateHex ( $canonicalURL );
        return $stringToSign;
    }

    private function calculateSignature($stringToSign) {
        $signatureKey = $this->getSignatureKey ( $this->secretKey, $this->currentDate, $this->regionName, $this->serviceName );
        $signature = hash_hmac ( "sha256", $stringToSign, $signatureKey, true );
        $strHexSignature = strtolower ( bin2hex ( $signature ) );
        return $strHexSignature;
    }

    public function getHeaders() {
        $this->awsHeaders ['x-amz-date'] = $this->xAmzDate;
        ksort ( $this->awsHeaders );

        // Step 1: CREATE A CANONICAL REQUEST
        $canonicalURL = $this->prepareCanonicalRequest ();

        // Step 2: CREATE THE STRING TO SIGN
        $stringToSign = $this->prepareStringToSign ( $canonicalURL );

        // Step 3: CALCULATE THE SIGNATURE
        $signature = $this->calculateSignature ( $stringToSign );

        // Step 4: CALCULATE AUTHORIZATION HEADER
        if ($signature) {
            $this->awsHeaders ['Authorization'] = $this->buildAuthorizationString ( $signature );
            return $this->awsHeaders;
        }
    }

    private function buildAuthorizationString($strSignature) {
        return $this->HMACAlgorithm . " " . "Credential=" . $this->accessKey . "/" . $this->getDate () . "/" . $this->regionName . "/" . $this->serviceName . "/" . $this->aws4Request . "," . "SignedHeaders=" . $this->strSignedHeader . "," . "Signature=" . $strSignature;
    }

    private function generateHex($data) {
        return strtolower ( bin2hex ( hash ( "sha256", $data, true ) ) );
    }

    private function getSignatureKey($key, $date, $regionName, $serviceName) {
        $kSecret = "AWS4" . $key;
        $kDate = hash_hmac ( "sha256", $date, $kSecret, true );
        $kRegion = hash_hmac ( "sha256", $regionName, $kDate, true );
        $kService = hash_hmac ( "sha256", $serviceName, $kRegion, true );
        $kSigning = hash_hmac ( "sha256", $this->aws4Request, $kService, true );

        return $kSigning;
    }

    private function getTimeStamp() {
        return gmdate ( "Ymd\THis\Z" );
    }

    private function getDate() {
        return gmdate ( "Ymd" );
    }
}

function amazon_request ($disc_asin) {
$serviceName="ProductAdvertisingAPI";
$region="eu-west-1";
$accessKey="AKIAJDEPHMGVXCVWES4Q";
$secretKey="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";
$payload="{"
        ." \"Resources\": ["
        ."  \"ItemInfo.Features\","
        ."  \"ItemInfo.Title\","
        ."  \"Offers.Listings.Price\","
        ."  \"ParentASIN\","
        ."  \"RentalOffers.Listings.BasePrice\""
        ." ],"
        ." \"Keywords\": \"$disc_asin\","
        ." \"PartnerTag\": \"discountone06-21\","
        ." \"PartnerType\": \"Associates\","
        ." \"Marketplace\": \"www.amazon.in\""
        ."}";
$host="webservices.amazon.in";
$uriPath="/paapi5/searchitems";
$awsv4 = new AwsV4 ($accessKey, $secretKey);
$awsv4->setRegionName($region);
$awsv4->setServiceName($serviceName);
$awsv4->setPath ($uriPath);
$awsv4->setPayload ($payload);
$awsv4->setRequestMethod ("POST");
$awsv4->addHeader ('content-encoding', 'amz-1.0');
$awsv4->addHeader ('content-type', 'application/json; charset=utf-8');
$awsv4->addHeader ('host', $host);
$awsv4->addHeader ('x-amz-target', 'com.amazon.paapi5.v1.ProductAdvertisingAPIv1.SearchItems');
$headers = $awsv4->getHeaders ();
$headerString = "";
foreach ( $headers as $key => $value ) {
    $headerString .= $key . ': ' . $value . "\r\n";
}
$params = array (
        'http' => array (
            'header' 	=> $headerString,
            'method' 	=> 'POST',
            'content' 	=> $payload
        )
    );
$stream = stream_context_create ( $params );

$fp = @fopen ( 'https://'.$host.$uriPath, 'rb', false, $stream );

$response = @stream_get_contents ( $fp );
return $response;
}

function test_sleep () { 
	for ($i=1; $i < 10; $i++){
		sleep(2);
		echo $i;
	}
}



function update_values () {
	
	$query = new WP_Query( [
		'post_type' 		=> 'products',
		'post_status' 		=> 'publish',
		'categories-shops' 	=> 'amazon',
		'posts_per_page'	=> 1,
		'orderby' 			=> 'date'
	] ); 

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			
			//Проверка есть ли ASIN у купона
			if ($amazon_asin = get_field('asin_code')) {
			$amazon_info = amazon_request($amazon_asin);
			$amazon_info = json_decode($amazon_info);
				
			// Создаем массив данных
			/* $new_post_values = [
				'ID' => $post->ID,
				'post_title' => $amazon_info->SearchResult->Items[0]->ItemInfo->Title->DisplayValue,			
			]; */
				
			// Обновляем данные в БД
			/*if (!$amazon_info->Errors) {
				update_field( 'price', $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Amount, $post->ID );
				update_field( 'old_price', $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Savings->Amount + $amazon_info->SearchResult->Items[0]->Offers->Listings[0]->Price->Amount, $post->ID );
				} 
			sleep(3);*/
			//wp_update_post( wp_slash( $new_post_values ) );
			}
		}
 	}
	wp_reset_postdata();	
	return $amazon_info;
};



function admitad_authorization () {
	$url = "https://api.admitad.com/token/";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Authorization: Basic b64XXX",
	   "Content-Type: application/x-www-form-urlencoded",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$data = <<<DATA
	grant_type=client_credentials&client_id=8XcHSOLattLDg6cIayjztpsuq64gVs&client_secret=XJGkUtVkz0U625UeyUzK24Nt8TtP57&base64_header=OFhjSFNPTGF0dExEZzZjSWF5anp0cHN1cTY0Z1ZzOlhKR2tVdFZrejBVNjI1VWV5VXpLMjROdDhUdFA1Nw==
	&scope=public_data websites manage_websites advcampaigns advcampaigns_for_website manage_advcampaigns banners landings banners_for_website announcements referrals coupons coupons_for_website private_data private_data_email private_data_phone private_data_balance validate_links deeplink_generator statistics opt_codes manage_opt_codes webmaster_retag manage_webmaster_retag broken_links manage_broken_links lost_orders manage_lost_orders broker_application manage_broker_application short_link
	DATA;

	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	var_dump($resp);
    return $resp;
		
}

function admitad_make_short_link ($long_link, $access_token) {
	$url = "https://api.admitad.com/shortlink/modify/";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Authorization: Bearer $access_token",
	   "Content-Type: application/x-www-form-urlencoded",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$data = "link=$long_link";

	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	$resp = json_decode($resp)->short_link;
	return $resp;
}

function admitad_get_deeplink ($access_token, $id, $product_url, $website_id) {
	//$access_token ='JlkybDkyshOMfyHVOxhVVVQBVujyf0';
	////$id = 15591;
	//$websit_id = 2411072;2032822
	$good_url = substr($product_url, 8);
	$url = "https://api.admitad.com/deeplink/$website_id/advcampaign/$id/?ulp=https%3A%2F%2F$good_url";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Authorization: Bearer $access_token"
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	$resp = json_decode($resp);
	return $resp;

}

function api_signed_request () {
	$url = "https://discount.one/?signed_request=e7f80a9161ed0f310fd691f89162c6a280265e0e4709ab96f57921e0dbb70793.eyJ1c2VybmFtZSI6ICJkaXNjb3VudG9uZSIsICJmaXJzdF9uYW1lIjogIkxldm9uIiwgImxhc3RfbmFtZSI6ICJPZ2FuZXN5YW4iLCAibGFuZ3VhZ2UiOiAicnUiLCAiYWxnb3JpdGhtIjogIkhNQUMtU0hBMjU2IiwgImFjY2Vzc190b2tlbiI6ICJMNU92SnNZc1JjVm1jS09RSUs0QVVnVmtPZGNCcXkiLCAiZXhwaXJlc19pbiI6IDYwNDgwMCwgImlkIjogMjAzMjgyMiwgInJlZnJlc2hfdG9rZW4iOiAiOTJJRUY5V2RBOUR2ejQxeWdwd0diZTFQMXhNUEwyIn0==&retloc=https%3A//apps.admitad.com/ru/discountone/";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Accept: application/json",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	var_dump($resp);
}

function parser_request ($page, $source) {
	$url = "https://parser.discount.one/?apiKey=gn3uv6ldg9i8xtc4osesnt&isImageUploadedToServer=1";
	$args = array(
	    'timeout' => 30, // Время в секундах на получение данных.
	);
    $take = "&take=50";

    $url = $url."&page=".$page."&take=100&sourceId=".$source;

//    $params = array(
//        'sourceId' => $source,
//        'page' => $page,
//        'take' => $take
//    );
    //$url = add_query_arg( $params, $url );

	
	$response = wp_remote_get( $url, $args );
	$body = wp_remote_retrieve_body( $response );
	$body = json_decode($body);
	return $body;
}

function parser_request_update ($date) {
    $url = "https://parser.discount.one/?apiKey=gn3uv6ldg9i8xtc4osesnt";
    $args = array(
        'timeout' => 10, // Время в секундах на получение данных.
    );
    $take = "&take=50";

    $url = $url."&take=700&updatedAtUnixFrom=".$date;

//    $params = array(
//        'sourceId' => $source,
//        'page' => $page,
//        'take' => $take
//    );
    //$url = add_query_arg( $params, $url );


    $response = wp_remote_get( $url, $args);
    $body = wp_remote_retrieve_body( $response );
    $body = json_decode($body);
    return $body;
}

function parser_request_ids ($ids) {
    $url = "https://parser.discount.one/?apiKey=gn3uv6ldg9i8xtc4osesnt&take=1000";
    $args = array(
        'timeout' => 20, // Время в секундах на получение данных.
    );
    // Добавляем поиск по id
    $url = $url."&id=".$ids;

    $response = wp_remote_get( $url, $args );
    $body = wp_remote_retrieve_body( $response );
    $body = json_decode($body);
    return $body;
}

function is_good_post ($id) {
    if (get_field('image', $id) && (get_field('link', $id))){
        return True;
    }
    else {
        return False;
    }
}


function image_loader ($post_id, $url) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

    $file_content = file_get_contents($url, false, stream_context_create([
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: Mozilla/5.0 (Linux; U; Android 4.0.3; en-us; KFTT Build/IML74K) AppleWebKit/537.36 (KHTML, like Gecko) Silk/3.68 like Chrome/39.0.2171.93 Safari/537.36\r\n"
        ]
    ]));
    $upload = wp_upload_bits(floor(microtime(true) * 1000) . '.jpg', null, $file_content);

    $id_media = media_sideload_image($upload['url'], $post_id, null, 'id');
    if ($id_media) {
        set_post_thumbnail($post_id, $id_media);
    }
}


// Обновление цен
function update_post_pars ($new_post) {
    global $wpdb;
    $cur_post_id = $wpdb->get_results('SELECT ID 
                                                 FROM wp_posts 
                                                 WHERE pars_id ='.$new_post->id);
    if ($cur_post_id) {
        update_field('price', $new_post->currentPrice, $cur_post_id[0]->ID); // цена
        update_field('old_price', $new_post->oldPrice, $cur_post_id[0]->ID); // старая цена
        save_products_procent_meta_parse($cur_post_id[0]->ID, (int)$new_post->currentPrice, (int)$new_post->oldPrice); // Размер скидки
        $cat_id_main = $new_post->categories[0]->category->slug;
        $cat_id_sub = $new_post->categories[1]->category->slug;
        $arr_cats = array($cat_id_main, $cat_id_sub);
        wp_set_object_terms( $cur_post_id[0]->ID, $arr_cats, 'categories');
        // Проверка на размер скидки
        $sale = get_field('sale_size', $cur_post_id[0]->ID);
        if ((int)$sale < 10) {
            wp_delete_post($cur_post_id[0]->ID);
        }
    }
}

// Загрузка нового постав в БД
function add_post_pars ($new_post, $access_token, $id_pp, $cat_name, $tax_id, $cat_id, $website_id) {
    if($new_post) {
        $cur_post_id = null;
        global $wpdb;
        $cur_post_id = $wpdb->get_results('SELECT ID 
                                                 FROM wp_posts 
                                                 WHERE pars_id ='.$new_post->id);
    }
    else {
        return;
    }
    if ($cur_post_id) {
        $j = null;

    }
	else {
		$post_data = array(
			'post_title'    	=> $new_post->title,
			'post_content'  	=> $new_post->description,
			'post_status'   	=> 'publish',
			'post_author'   	=> 1,
			'post_type'      	=> 'products',
			'tax_input'      	=> array('categories-shops' => $cat_name),
		);

		$id = wp_insert_post(wp_slash($post_data));
		wp_set_object_terms( $id, $tax_id, 'categories-shops'); // добавление магазина
		wp_set_object_terms( $id, $cat_id, 'categories'); // добавление категории
		update_field( 'price', $new_post->currentPrice, $id ); // цена
		update_field( 'old_price', $new_post->oldPrice, $id ); // старая цена
        save_products_procent_meta_parse($id, (int)$new_post->currentPrice, (int)$new_post->oldPrice); // Размер скидки
		update_field( 'source', ucfirst($new_post->sourceId), $id ); // магазин
		if ($new_post->couponCode){
			update_field( 'promocode', $new_post->couponCode, $id ); // промокод
			wp_set_object_terms( $id, 42, 'promocodes'); // добавление к отображению в промокодах
		}
        update_field( 'pars_id', $new_post->id, $id ); // ID для обновлений цен
        $pp_url = admitad_get_deeplink($access_token, $id_pp, $new_post->url, $website_id)[0]; // создание партнерской ссылки
        $pp_url = admitad_make_short_link($pp_url, $access_token); // создание короткой ссылки из партнерской
        update_field( 'link', $pp_url, $id );
        update_field('image_url',$new_post->image, $id);// добавление изображения
        try {
            $wpdb->get_results("UPDATE `wp_posts` SET pars_id={$new_post->id} WHERE ID={$id}");
        } catch (Exception $e) {
            wp_delete_post($id);
        }


        // проверка целостный ли пост
//        if (is_good_post($id)){
//            return;
//        }
//        else{
//            wp_delete_post($id);
//        };
	}
}

// id => 497819
function test_update_fields($id) {
    return 0;
}


function add_post_pars_amazon ($new_post, $cat_name, $tax_id, $cat_id) {
    if($new_post) {
        $cur_post_id = null;
        global $wpdb;
        $cur_post_id = $wpdb->get_results('SELECT ID 
                                                 FROM wp_posts 
                                                 WHERE pars_id ='.$new_post->id);
    }
    else {
        return;
    }
    if ($cur_post_id) {
        $j = null;
        //update_post_pars($cur_post_id[0]->post_id, $new_post);
    }
    else {
		$post_data = array(
			'post_title'    	=> $new_post->title,
			'post_status'   	=> 'publish',
			'post_author'   	=> 1,
			'post_type'      	=> 'products',
			'tax_input'      	=> array('categories-shops' => $cat_name), 
		);
		$id = wp_insert_post(wp_slash($post_data));
        wp_set_object_terms( $id, $tax_id, 'categories-shops'); // добавление магазина
        wp_set_object_terms( $id, $cat_id, 'categories'); // добавление категории
        update_field( 'price', $new_post->currentPrice, $id );
        update_field( 'old_price', $new_post->oldPrice, $id );
        save_products_procent_meta_parse($id, (int)$new_post->currentPrice, (int)$new_post->oldPrice); // Размер скидки
        update_field( 'source', ucfirst($new_post->sourceId), $id );
        update_field( 'link', $new_post->url."&tag=discountone06-21", $id );
        update_field('image_url',$new_post->image, $id);// добавление изображения
        update_field( 'pars_id', $new_post->id, $id );
        try {
            $wpdb->get_results("UPDATE `wp_posts` SET pars_id={$new_post->id} WHERE ID={$id}");
        } catch (Exception $e) {
            wp_delete_post($id);
        }

	}
}

function add_post_pars_inrdeals ($new_post, $cat_name, $tax_id, $cat_id) {
    if($new_post) {
        $cur_post_id = null;
        global $wpdb;
        $cur_post_id = $wpdb->get_results('SELECT ID 
                                                 FROM wp_posts 
                                                 WHERE pars_id ='.$new_post->id);
    }
    else {
        return;
    }
    if ($cur_post_id) {
        $j = null;
        //update_post_pars($cur_post_id[0]->post_id, $new_post);
    }
    else {
        $post_data = array(
            'post_title'    	=> $new_post->title,
            'post_status'   	=> 'publish',
            'post_author'   	=> 1,
            'post_type'      	=> 'products',
            'tax_input'      	=> array('categories-shops' => $cat_name),
        );
        $id = wp_insert_post(wp_slash($post_data));
        wp_set_object_terms( $id, $tax_id, 'categories-shops'); // добавление магазина
        wp_set_object_terms( $id, $cat_id, 'categories'); // добавление категории
        update_field( 'price', $new_post->currentPrice, $id );
        update_field( 'old_price', $new_post->oldPrice, $id );
        save_products_procent_meta_parse($id, (int)$new_post->currentPrice, (int)$new_post->oldPrice); // Размер скидки
        update_field( 'source', ucfirst($new_post->sourceId), $id );
        update_field( 'link', "https://inrdeals.com/com651024731/".$new_post->url, $id );
        update_field('image_url',$new_post->image, $id);// добавление изображения
        update_field( 'pars_id', $new_post->id, $id );
        try {
            $wpdb->get_results("UPDATE `wp_posts` SET pars_id={$new_post->id} WHERE ID={$id}");
        } catch (Exception $e) {
            wp_delete_post($id);
        }

    }
}

function add_post_pars_cuelinks ($new_post, $cat_name, $tax_id, $cat_id) {
    if($new_post) {
        $cur_post_id = null;
        global $wpdb;
        $cur_post_id = $wpdb->get_results('SELECT ID 
                                                 FROM wp_posts 
                                                 WHERE pars_id ='.$new_post->id);
    }
    else {
        return;
    }
    if ($cur_post_id) {
        $j = null;
        //update_post_pars($cur_post_id[0]->post_id, $new_post);
    }
    else {
        $post_data = array(
            'post_title'    	=> $new_post->title,
            'post_status'   	=> 'publish',
            'post_author'   	=> 1,
            'post_type'      	=> 'products',
            'tax_input'      	=> array('categories-shops' => $cat_name),
        );
        $id = wp_insert_post(wp_slash($post_data));
        wp_set_object_terms( $id, $tax_id, 'categories-shops'); // добавление магазина
        wp_set_object_terms( $id, $cat_id, 'categories'); // добавление категории
        update_field( 'price', $new_post->currentPrice, $id );
        update_field( 'old_price', $new_post->oldPrice, $id );
        save_products_procent_meta_parse($id, (int)$new_post->currentPrice, (int)$new_post->oldPrice); // Размер скидки
        update_field( 'source', ucfirst($new_post->sourceId), $id );
        update_field( 'link', "https://linksredirect.com/?cid=194262&source=linkkit&url=".$new_post->url, $id );
        update_field('image_url',$new_post->image, $id);// добавление изображения
        update_field( 'pars_id', $new_post->id, $id );
        try {
            $wpdb->get_results("UPDATE `wp_posts` SET pars_id={$new_post->id} WHERE ID={$id}");
        } catch (Exception $e) {
            wp_delete_post($id);
        }

    }
}

//$new_post, $access_token, $id_pp, $cat_name, $tax_id, $cat_id
function page_post_parse ($access_token, $id_pp, $shop, $shop_id, $website_id, $page_number = 1) {
    $body = parser_request($page_number, $shop);
    $items = $body->items;
    $length_page = count($items);
    for ($i = 0; $i < $length_page; $i++) {
        $cat_id_main = $items[$i]->categories[0]->category->slug;
        $cat_id_sub = $items[$i]->categories[1]->category->slug;
        $arr_cats = array($cat_id_main, $cat_id_sub);

        if ($shop == "amazon"){
            add_post_pars_amazon($items[$i], $shop, $shop_id, $arr_cats);
        }
        elseif (($shop == "flipkart") || ($shop == "nilkamalfurniture") || ($shop == "nykaafashion") || ($shop == "levis") || ($shop == "nykaa") || ($shop == "tatacliq") || ($shop == "biba") || ($shop == "kindlife") || ($shop == "nestasia") || ($shop == "hyugalife") || ($shop == "1mg") || ($shop == "ajio") || ($shop == "myntra") || ($shop == "forever21") || ($shop == "zouk") || ($shop == "spykar") || ($shop == "muscleblaze") || ($shop == "aldoshoes") || ($shop == "snapdeal") || ($shop == "zigly") || ($shop == "accessorizelondon") || ($shop == "basicslife") || ($shop == "shyaway") || ($shop == "dailyobjects")){
            add_post_pars_cuelinks($items[$i], $shop, $shop_id, $arr_cats);
        }
        elseif (($shop == "peterengland") || ($shop == "at-home") || ($shop == "vastrado")){
            add_post_pars_inrdeals($items[$i], $shop, $shop_id, $arr_cats);
        }
        elseif (($shop == "amalaearth")){
            if ($arr_cats[1] != "sports-nutrition") {
                add_post_pars_inrdeals($items[$i], $shop, $shop_id, $arr_cats);
            }
        }
        else {
            add_post_pars($items[$i], $access_token, $id_pp, $shop, $shop_id, $arr_cats, $website_id);
        }

    }
    return $body->totalPage;
}

function page_post_update ($date) {
    $items = parser_request_update($date)->items;
    $lenght = count($items);
    $update_at = $date;

    for ($i = 0; $i < $lenght; $i++) {
        update_post_pars($items[$i]);
        $update_at = $items[$i]->updatedAtUnix;
    }
    return $update_at;
}


//function parse_inf_staff_shops () {
//    // Четение
//    $object_json_link = file_get_contents(get_template_directory() .'/parse_inf.json');
//    $object_json = json_decode($object_json_link, true);
//    // конечный массив
//    $parse_info_array = [];
//
//    $admitad_info["shops"] = $object_json[0]["shops"];
//    $current_shop = $object_json[1];
//    $shops = $object_json[2];
//    $access_token = $object_json[3];
//    $check_cur_shop  = $object_json[4];
//    if ($check_cur_shop["check_shop"] != $current_shop["current_shop"]) {
//        $check_cur_shop["check_shop"] = $current_shop["current_shop"];
//        //$check_cur_shop["check_shop"] = 10;
//    $total = page_post_parse(
//        $access_token["access_token"],
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["id_admitad"],
//        $shops[$current_shop["current_shop"]],
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["id"],
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["id_website"],
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["current_page"]
//    );
//
//
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["totalPage"] = $total;
//        $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["current_page"]++;
//        if ($admitad_info["shops"][$shops[$current_shop["current_shop"]]]["current_page"] > $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["totalPage"]) {
//            $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["current_page"] = $admitad_info["shops"][$shops[$current_shop["current_shop"]]]["totalPage"];
//        }
//
//        $current_shop["current_shop"]++;
//        if ($current_shop["current_shop"] >= count($shops)) {
//            $current_shop["current_shop"] = 0;
//        }
//
//
//        $filename = get_template_directory() . '/parse_inf.json';
//        array_push($parse_info_array, $admitad_info, $current_shop, $shops, $access_token, $check_cur_shop);
//
//        // Запись.
//        $data = json_encode($parse_info_array);  // JSON формат сохраняемого значения.
//        file_put_contents($filename, $data);
//    }
//
//}
//
//function parse_update_shops () {
//    //2023-07-04T19:57:10.513Z
//    //parser_request_update($date_pars);
//
//    // Четение
//    $object_json_link = file_get_contents(get_template_directory() .'/update_inf.json');
//    $object_json = json_decode($object_json_link, true);
//    // конечный массив
//    $parse_info_array = [];
//    //$date_pars_tmp["date"] = $object_json[0]["date"];
//    $date_pars["date"] = page_post_update($object_json[0]["date"]);
//
//
//    $filename = get_template_directory() . '/update_inf.json';
//    array_push($parse_info_array, $date_pars);
//
//    // Запись.
//    $data = json_encode($parse_info_array);  // JSON формат сохраняемого значения.
//    file_put_contents($filename, $data);
//
//}
//
//function twenty_deleter ($limit = 0, $percents = 0) {
//    global $wpdb;
//    $array_posts_id = $wpdb->get_results('
//                    SELECT wp_posts.ID
//                    FROM wp_posts
//                    JOIN wp_postmeta
//                        ON wp_posts.ID = wp_postmeta.post_id
//                    JOIN wp_term_relationships
//                    	ON wp_postmeta.post_id = wp_term_relationships.object_id
//                    WHERE wp_posts.post_status = "publish"
//                    AND wp_posts.post_type = "products"
//                    AND wp_postmeta.meta_value = "Ajio"
//                    AND wp_term_relationships.term_taxonomy_id = 520
//                    GROUP BY wp_posts.ID
//                    ORDER BY wp_posts.ID ASC
//                    LIMIT 500;');
//
//    $lenght = count($array_posts_id);
//    for ($i = 0; $i < $lenght; $i++) {
//        wp_delete_post($array_posts_id[$i]->ID);
//    }
//}
//
//function pars_id_adder () {
//    global $wpdb;
//    $array_posts_id = $wpdb->get_results('
//                    SELECT wp_posts.ID
//                    FROM wp_posts
//                    JOIN wp_postmeta
//                        ON wp_posts.ID = wp_postmeta.post_id
//                    WHERE wp_posts.post_status = "publish"
//                    AND wp_posts.post_type = "products"
//                    AND wp_postmeta.meta_key = "source"
//                    AND wp_postmeta.meta_value = "Peterengland"
//                    GROUP BY wp_posts.ID
//                    ORDER BY `wp_posts`.`ID` DESC
//                    LIMIT 4000, 1000;
//                    ');
//
//    $lenght = count($array_posts_id);
//    for ($i = 0; $i < $lenght; $i++) {
//        $link_shop = get_field('link', $array_posts_id[$i]->ID);
//        $clean_url = substr($link_shop, 57);
//        $good_url = "https://inrdeals.com/com651024731/".$clean_url;
//        update_field('link',$good_url,$array_posts_id[$i]->ID);
//    }
//
//}
//
//function pars_cat_adder () {
//    global $wpdb;
//    $array_posts_id = $wpdb->get_results('
//                    SELECT wp_posts.ID, wp_posts.pars_id
//                    FROM wp_posts
//                    JOIN wp_postmeta
//                        ON wp_posts.ID = wp_postmeta.post_id
//                    WHERE wp_posts.post_status = "publish"
//                    AND wp_posts.post_type = "products"
//                    AND wp_postmeta.meta_key = "source"
//                    AND wp_postmeta.meta_value = "forever21"
//                    GROUP BY wp_posts.ID
//                    ORDER BY `wp_posts`.`ID` ASC
//                    LIMIT 0, 1000;
//                    ');
//
//    $ids = $array_posts_id[0]->pars_id;
//    $lenght = count($array_posts_id);
//    for ($i = 0; $i < $lenght; $i++) {
//        $ids = $ids.",".$array_posts_id[$i]->pars_id;
//    }
//
//    $items = parser_request_ids($ids)->items;
//    $lenght = count($items);
//    print_r($lenght);
//    for ($i = 0; $i < $lenght; $i++) {
//        $cur_post_id = $wpdb->get_results('SELECT ID
//                                                 FROM wp_posts
//                                                 WHERE pars_id ='.$items[$i]->id);
//        if ($cur_post_id){
//            $cat_id_main = $items[$i]->categories[0]->category->slug;
//            $cat_id_sub = $items[$i]->categories[1]->category->slug;
//            $arr_cats = array($cat_id_main, $cat_id_sub);
//            wp_set_object_terms( $cur_post_id[0]->ID, $arr_cats, 'categories');
//        }
//    }
//
//}

//При нажатии на кнопку в записях products будет автоматически определяться размер скидки
add_action( 'save_post', 'save_products_procent_meta' );
function save_products_procent_meta( $post_id ) {
    $price = get_field('price', $post_id);
    $old_price = get_field('old_price', $post_id);
    if(!empty($price) && !empty($old_price)){ $procent = round(100 - (($price/$old_price) * 100)); }else{ $procent = 0; }
    // слаг лучше указать единожды и использовать во всех кодах
    // связанных с типом записи, как это принято в классах
    $slug = 'products';
    global $post_type;
    // Проверяем тип записи, если не boo то выходим.
    if ( $slug == $post_type ){
        // Обновляем метаданные записи.
        update_post_meta( $post_id, 'sale_size',  $procent );
    }

}

function save_products_procent_meta_parse( $post_id, $price, $old_price ) {
    if(!empty($price) && !empty($old_price)){
        $procent = round(100 - (($price/$old_price) * 100));
    }
    else {
        $procent = 0;
    }
    update_post_meta( $post_id, 'sale_size',  $procent );
}
//КОНЕЦ При нажатии на кнопку в записях products будет автоматически определяться размер скидки


global $post;
//wp_unique_post_slug(  'blog', $post->ID, 'publish', 'post','' );


require get_template_directory() .'/inc/dc.php';
require get_template_directory() .'/inc/breadcrumbs.php';
require get_template_directory(). '/array-page/home/home_cron.php';
require get_template_directory(). '/array-page/home/home-mob_cron.php';
require get_template_directory(). '/array-page/best-deals/best-deals_cron.php';
require get_template_directory(). '/array-page/single-page/single_cron.php';
require get_template_directory(). '/array-page/categories/categories_cron.php';
require get_template_directory(). '/array-page/categories/page-categories_cron.php';
require get_template_directory(). '/array-page/categories-shops/categories-shops_cron.php';
require get_template_directory(). '/setting-pages/hidden-shops/hidden-shops-cron.php';