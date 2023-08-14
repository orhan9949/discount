<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
/**
 * Это для фильтра на страницу All Deals
 * Фильтр принимает два аргумента
 * 1 Фильтр по просмотру
 * 2 По скидке
 */


Class Filter_Blog {
    public function __construct
    (
        $slug,
        $page
    )
    {
        $this->slug            = $slug;
        $this->page            = $page;
        $this->result          = $this->filter_ajax();
    }

    public function filter_ajax()
    {
        $args = array(

            'post_type'        => 'post',
            'post_status'      => 'publish',
            'posts_per_page'   => 100,
            'paged'            => $this->page,
            'orderby' => 'data',
            'order' => 'DESC',

            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        if(!empty($this->slug)){
            $args = array_merge($args , array(
                'tax_query' => array(
                    array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $this->slug,
                        )
                    ),
                ),
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

//            if(strlen($pos->post_content) > 100){
//                $posts_arr[$i]["content"] = mb_substr( $pos->post_content, 0, 100 ). '...';
//            }else{
//                $posts_arr[$i]["content"] = mb_substr( $pos->post_content, 0, 100 );
//            }
            $posts_arr[$i]["post_date"] = $pos->post_date;
            $posts_arr[$i]["views_click"] = $pos->views_click;
            $posts_arr[$i]["img_url"] = get_the_post_thumbnail_url($pos->ID, 'meduim');
            $posts_arr[$i]["published_date"] = 'Published ' .get_the_date('Y-m-d', $pos->ID);
            $posts_arr[$i]["link"] = get_permalink($pos->ID);
//            $posts_arr[$i]["term_slug"] = $term->slug;
//            $posts_arr[$i]["term_name"] = $term->name;
            $cat = get_the_tags( $pos->ID );

            foreach($cat as $ii => $c):
                if($c && $ii < 3):
                $posts_arr[$i]["cat"][$ii]['slug'] = $c->slug;
                $posts_arr[$i]["cat"][$ii]['name'] = $c->name;
                endif;
            endforeach;
        }
        return json_encode($posts_arr);
    }
}

$obj = new Filter_Blog
    (
        $_POST['slug'],
        $_POST['page'],
    );
echo $obj->result;

