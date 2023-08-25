<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
/**
 *
 *@Filter_Shop_Cat  - этот класс для фильтра на страницу Категорий и магазинов
 *
 */


Class Filter_Shop_Cat {
    public function __construct
    (
        $page,
        $cat,
        $tax_slug,
        $sortBy,
        $sort,
        $priceFrom,
        $priceTo,
//        $discountFrom,
//        $discountTo
        $cat_or_shop
    )
    {
        $this->page            = $page;
        $this->cat             = $cat;
        $this->tax_slug        = $tax_slug;
        $this->sortBy          = $sortBy;
        $this->sort            = $sort;
        $this->priceFrom       = $priceFrom;
        $this->priceTo         = $priceTo;
//        $this->discountFrom    = $discountFrom;
//        $this->discountTo      = $discountTo;
        $this->cat_or_shop     = $cat_or_shop;
        $this->result          = $this->filter_ajax();
    }

    public function filter_ajax()
    {
        $args = array(
            'post_type'        => 'products',
            'post_status'      => 'publish',
            'posts_per_page'   => 100,
            'paged'            => $this->page,
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        if($this->sortBy == 'date' || $this->sortBy == 'views_click'){
            $args = array_merge($args , array(
                'orderby' => $this->sortBy,
                'order' => $this->sort,

            ));
        }
        if($this->sortBy == 'sale_size' || $this->sortBy == 'price'){
            $args = array_merge($args , array(
                'orderby' => 'meta_value_num',
                'meta_key' => $this->sortBy,
                'order' => $this->sort,

            ));
        }
        $cat_or_shop_Tax = 'categories';
        if($this->cat == 'categories'):
            $cat_or_shop_Tax = 'categories-shops';
        endif;
        if($this->cat && $this->cat_or_shop){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => $this->cat,
                            'field' => 'slug',
                            'terms' => $this->tax_slug,
                        ),
                        array(
                            'taxonomy' => $cat_or_shop_Tax,
                            'field' => 'slug',
                            'terms' => $this->cat_or_shop,
                        ),
                    ),
                ),
            ));

        }

        if($this->cat && $this->cat_or_shop == ''){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        array(
                            'taxonomy' => $this->cat,
                            'field' => 'slug',
                            'terms' => $this->tax_slug,
                        ),
                    ),
                ),
            ));
        }

//        if($this->priceFrom && $this->priceTo && $this->discountFrom && $this->discountTo){
        if($this->priceFrom && $this->priceTo){
            $args = array_merge($args , array(
                'meta_query' => array(
//                    'relation' => 'AND',
                    array(
                        'key' => 'price',
                        'value' => array($this->priceFrom, $this->priceTo),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN',
                    ),
//                    array(
//                        'key' => 'sale_size',
//                        'value' => array($this->discountFrom, $this->discountTo),
//                        'type' => 'numeric',
//                        'compare' => 'BETWEEN',
//                    ),
                ),
            ));

        }



        $my_posts = new WP_Query($args);
        foreach ($my_posts->posts as $i => $pos) {

            $array[] = $pos->post_id;

            $posts_arr[$i]["id"] = $pos->ID;
            if(strlen($pos->post_title) > 30){
                $posts_arr[$i]["title"] = mb_substr( $pos->post_title, 0, 30 ). '...';
            }else{
                $posts_arr[$i]["title"] = mb_substr( $pos->post_title, 0, 30 );
            }

            if(strlen($pos->post_content) > 100){
                $posts_arr[$i]["content"] = mb_substr( $pos->post_content, 0, 100 ). '...';
            }else{
                $posts_arr[$i]["content"] = mb_substr( $pos->post_content, 0, 100 );
            }
            $posts_arr[$i]["post_date"] = $pos->post_date;
            $posts_arr[$i]["views_click"] = $pos->views_click;
            $posts_arr[$i]["img_url"] = get_field('image_url', $pos->ID);
            if (!$posts_arr[$i]["img_url"]):
                $posts_arr[$i]["img_url"] = get_the_post_thumbnail_url($pos->ID, 'meduim');
            endif;
            $posts_arr[$i]["expiration_date"] = get_post_meta($pos->ID, 'expiration_date')[0];
            $posts_arr[$i]["published_date"] = dc_passed(get_the_date("Y-m-d H:i:s" , $pos->ID));
            $posts_arr[$i]["link"] = get_permalink($pos->ID);
            $posts_arr[$i]["price"] = dc_price($pos->ID);
            $term = get_term_by('slug', strtolower(get_post_meta($pos->ID, 'source')[0]), 'categories-shops');
            $image = get_field('icon', 'categories-shops_' . $term->term_id);
            $posts_arr[$i]["term_slug"] = $term->slug;
            $posts_arr[$i]["term_name"] = $term->name;
            $posts_arr[$i]["icon"] = $image["url"];
            $posts_arr[$i]["link_2"] = get_field('link', $pos->ID);
            $posts_arr[$i]["promocode"] = get_field('promocode', $pos->ID);

        }
        return json_encode($posts_arr);
    }
}

$obj = new Filter_Shop_Cat
(
    $_POST['page'],
    $_POST['cat'],
    $_POST['tax_slug'],
    $_POST['sortBy'],
    $_POST['sort'],
    $_POST['priceFrom'],
    $_POST['priceTo'],
//    $_POST['discountFrom'],
//    $_POST['discountTo']
    $_POST['cat_or_shop']

);
echo $obj->result;
