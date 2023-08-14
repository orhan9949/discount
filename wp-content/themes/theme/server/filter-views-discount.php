<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
/**
 * Это для фильтра на страницу All Deals
 * Фильтр принимает два аргумента
 * 1 Фильтр по просмотру
 * 2 По скидке
 */


Class Filter_All_Deals {
    public function __construct
    (
        $filterName,
        $page,
        $cat,
        $tax_slug,
        $cat_shop,
        $tax_slug_shop,
        $searchName
    )
    {
        $this->orderBy         = $filterName;
        $this->page            = $page;
        $this->cat             = $cat;
        $this->tax_slug        = $tax_slug;
        $this->cat_shop        = $cat_shop;
        $this->tax_slug_shop   = $tax_slug_shop;
        $this->searchName      = $searchName;
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
        if($this->searchName){
            $args = array_merge($args , array(
                'orderby' => 'views_click',
                'order' => 'DESC',
                "s" =>  $this->searchName,

            ));
        }
        if($this->orderBy == 'views_click'){
            $args = array_merge($args , array(
                'meta_query' => 'meta_value',
                'meta_key' => 'sale_size',
//                'orderby' => array( 'views_click' => 'DESC', 'meta_value_num' => 'DESC' ),
                'orderby' => array( $this->orderBy => 'DESC', 'meta_value_num' => 'DESC' ),

            ));
        }
        if($this->cat_shop == "categories-shops" && $this->cat == "categories"){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => $this->cat_shop,
                            'field' => 'slug',
                            'terms' => $this->tax_slug_shop,
                        ),
                         array(
                             'taxonomy' => $this->cat,
                             'field' => 'slug',
                             'terms' => $this->tax_slug,
                         ),

                    ),
                ),
            ));
        }
        if($this->cat_shop == "categories-shops" && $this->cat == ""){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        array(
                            'taxonomy' => $this->cat_shop,
                            'field' => 'slug',
                            'terms' => $this->tax_slug_shop,
                        )
                    ),
                ),
            ));
        }
        if($this->cat_shop == "" && $this->cat == "categories"){
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
        if($this->orderBy == 'sale_size'){
            $args = array_merge($args ,  array(
                'orderby' => 'meta_value_num',
                'meta_key' => $this->orderBy,
                'order' => 'DESC',

            ));
        }

        $my_posts = new WP_Query($args);
//            return json_encode($my_posts->posts);
//        $posts_arr = [];
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
            $posts_arr[$i]["published_date"] = dc_passed(get_the_date("Y-m-d H:i:s"));
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

$obj = new Filter_All_Deals
    (
        $_POST['filterName'],
        $_POST['page'],
        $_POST['cat'],
        $_POST['tax_slug'],
        $_POST['cat_shop'],
        $_POST['tax_slug_shop'],
        $_POST['searchName']
    );
echo $obj->result;

