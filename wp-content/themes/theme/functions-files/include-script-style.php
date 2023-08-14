<?php
function thm_css()
{
    wp_enqueue_style('header', TEMPLATE_DIR_URI.'/assets/css/header.css');
    wp_enqueue_style('footer', TEMPLATE_DIR_URI.'/assets/css/footer.css');
    wp_enqueue_style('thm-grid', TEMPLATE_DIR_URI.'/assets/css/grid.css');
    wp_enqueue_style('thm-main', TEMPLATE_DIR_URI.'/assets/css/main.css');
    //    wp_enqueue_style('thm-main-old', TEMPLATE_DIR_URI.'/assets/css/main-old.css');
    //	wp_enqueue_style('media-old', TEMPLATE_DIR_URI.'/assets/css/media-old.css');
    wp_enqueue_style('thm-media', TEMPLATE_DIR_URI.'/assets/css/media.css');
    wp_enqueue_style('thm-landing', TEMPLATE_DIR_URI.'/assets/css/landing.css');
    wp_enqueue_style('thm-landing-media', TEMPLATE_DIR_URI.'/assets/css/landing-media.css');


    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', TEMPLATE_DIR_URI.'/assets/js/jquery.js');
    wp_enqueue_script('slick', TEMPLATE_DIR_URI.'/assets/js/slick.js');
    wp_register_script('thm-main' , TEMPLATE_DIR_URI.'/assets/js/main.js', ['jquery'], '1.0', true );
    wp_localize_script( 'thm-main', 'dcajax',
        array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('dcajax-nonce')
        )
    );


    if ( is_search() ) {
        wp_enqueue_style('slick', TEMPLATE_DIR_URI.'/assets/css/slick.css');
//        wp_enqueue_style('product-page', TEMPLATE_DIR_URI.'/assets/css/product-page.css');
        wp_enqueue_style('search', TEMPLATE_DIR_URI.'/assets/css/search.css');
        wp_enqueue_script('filter-for-adeals', TEMPLATE_DIR_URI.'/assets/js/filter-for-alldeals.js');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
        wp_enqueue_script('searchjs', TEMPLATE_DIR_URI.'/assets/js/search.js');
    }


    if ( is_single() ) {
        wp_enqueue_style('slick', TEMPLATE_DIR_URI.'/assets/css/slick.css');
        wp_enqueue_style('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.css');
        wp_enqueue_style('single', TEMPLATE_DIR_URI.'/assets/css/single.css');
        wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.min.js');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
        wp_enqueue_script('detail-product', TEMPLATE_DIR_URI.'/assets/js/detail-product.js');
    }


    //    Этот Страница ID 6 (главная страница)
    if(is_front_page()){
        wp_enqueue_style('slick', TEMPLATE_DIR_URI.'/assets/css/slick.css');
        wp_enqueue_style('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.css');
        wp_enqueue_style('home', TEMPLATE_DIR_URI.'/assets/css/home.css');
        wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.min.js');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
        wp_enqueue_script('home', TEMPLATE_DIR_URI.'/assets/js/home.js');
    }
    //  Конец Страница ID 6 (главная страница)



    //    Страница  ID 11 (registration)
    if(is_page(11)){
        wp_enqueue_style('search', TEMPLATE_DIR_URI.'/assets/css/registration.css');
        wp_enqueue_script('ilter-for-adeals', TEMPLATE_DIR_URI.'/assets/js/registration.js');
    }
    //  Конец Страница  ID 11 (registration)



    //    Страница  ID 51 (best-deals)
    if(is_page(51)){
        wp_enqueue_style('search', TEMPLATE_DIR_URI.'/assets/css/best-deals.css');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
        wp_enqueue_script('ilter-for-adeals', TEMPLATE_DIR_URI.'/assets/js/filter-for-alldeals.js');
    }
    //  Конец Страница ID 51 (best-deals)


    //   Страница categories
    if(is_page(68)){
        wp_enqueue_style('categories', TEMPLATE_DIR_URI.'/assets/css/categories.css');
        wp_enqueue_script('gsap', TEMPLATE_DIR_URI.'/assets/js/gsap.js');
        wp_enqueue_script('categories', TEMPLATE_DIR_URI.'/assets/js/categories.js');
    }
    //  Конец Страница categories


    //    Страница arhive
//    if(is_archive()){
//        wp_enqueue_style('arhive', TEMPLATE_DIR_URI.'/assets/css/archive.css');
//
//    }
    //  Конец Страница arhive

    //    Страница магазинов archive-categories shops
    if (is_tax( 'categories-shops' )){
        wp_dequeue_script( 'artabr_lm_ajax');
        wp_dequeue_script( 'historyjs');
        wp_enqueue_style('slick', TEMPLATE_DIR_URI.'/assets/css/slick.css');
        wp_enqueue_style('search', TEMPLATE_DIR_URI.'/assets/css/best-deals.css');
        wp_enqueue_style('archive-categories-shops', TEMPLATE_DIR_URI.'/assets/css/archive-categories-shops.css');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
//        wp_enqueue_script('ilter-for-adeals', TEMPLATE_DIR_URI.'/assets/js/filter-for-alldeals.js');
        wp_enqueue_script('detail-product', TEMPLATE_DIR_URI.'/assets/js/detail-product.js');
        wp_enqueue_script('categories-filter', TEMPLATE_DIR_URI.'/assets/js/categories-filter.js');

    }

    //    Страница магазинов archive-categories
    if (is_tax( 'categories' )){
        wp_enqueue_style('slick', TEMPLATE_DIR_URI.'/assets/css/slick.css');
        wp_enqueue_style('search', TEMPLATE_DIR_URI.'/assets/css/best-deals.css');
        wp_enqueue_style('archive-categories-shops', TEMPLATE_DIR_URI.'/assets/css/archive-categories-shops.css');
        wp_enqueue_script('ajax-for-views', TEMPLATE_DIR_URI.'/assets/js/ajax-for-views.js');
//        wp_enqueue_script('ilter-for-adeals', TEMPLATE_DIR_URI.'/assets/js/filter-for-alldeals.js');
        wp_enqueue_script('detail-product', TEMPLATE_DIR_URI.'/assets/js/detail-product.js');
        wp_enqueue_script('categories-filter', TEMPLATE_DIR_URI.'/assets/js/categories-filter.js');
    }
    //  Конец Страница archive-categories

    //    Страница магазинов archive-promocodes
    if (is_tax( 'promocodes' )){
        wp_enqueue_style('arhive', TEMPLATE_DIR_URI.'/assets/css/archive.css');
    }
    //  Конец Страница promocodes


    //    Страница categories-shops
    if(is_page(899)){
    //        wp_dequeue_style( 'thm-main' );
    //        wp_dequeue_style( 'thm-media' );
        wp_enqueue_style('categories-shops', TEMPLATE_DIR_URI.'/assets/css/categories-shops.css');

    }
    //  Конец Страница categories-shops


    //    Страница coupons
    if(is_tax('promocodes',42)){
        wp_enqueue_style('product-page', TEMPLATE_DIR_URI.'/assets/css/product-page.css');
    }
    //  Конец Страница coupons

    //  Личный кабинет
        if(is_page(102) || is_page(94) || is_page(3485)){
            wp_enqueue_style('product-page', TEMPLATE_DIR_URI.'/assets/css/product-page.css');
            wp_enqueue_style('thm-main-old', TEMPLATE_DIR_URI.'/assets/css/lk.css');
        }
    //  Конец Личный кабинет




    //    Страница блога
    if(is_page(594547)){
        wp_enqueue_style('blog', TEMPLATE_DIR_URI.'/assets/css/blog.css');
        wp_enqueue_script('blog', TEMPLATE_DIR_URI.'/assets/js/blog.js');
    }
    //  Конец Страница блога



    //    Страница поста
    if(is_singular( 'post' )){
        wp_dequeue_style( 'single' );
        wp_dequeue_script( 'detail-product' );
        wp_enqueue_style('post', TEMPLATE_DIR_URI.'/assets/css/post.css');
        wp_enqueue_script('post', TEMPLATE_DIR_URI.'/assets/js/post.js');
    }
    //  Конец Страница поста



    wp_enqueue_script('thm-main');
}

add_action('wp_enqueue_scripts', 'thm_css');