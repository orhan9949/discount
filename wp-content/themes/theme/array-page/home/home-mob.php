<?php
function home_mob_array()
{
    global $wpdb;
    $page6_slider_1 = get_field('slider_1', 6);
    $page6_slider_3 = get_field('slider_3', 6);
    $slider_1 = [];
    $slider_3 = [];
    foreach ($page6_slider_1 as $i => $page) {
        $item = get_post($page['post_id']);
        $term = get_term_by('slug', strtolower(get_field('source', $item->ID)), 'categories-shops');
        if($term->term_id){
            $image = get_field('icon', 'categories-shops_' . $term->term_id);
            $slider_1['slider_1'][$i]["shop_image_url"] = $image['url'];
            $slider_1['slider_1'][$i]["shop_name"] = $term->name;
        }
        $slider_1['slider_1'][$i]["shop_slug"] = $term->slug;
        $slider_1['slider_1'][$i]["shop_link"] = get_field('link', $item->ID);
        if($term->slug){
            $slider_1['slider_1'][$i]["shop_slug"] = $term->slug;
        }
        $slider_1['slider_1'][$i]["id"] = $item->ID;
        $slider_1['slider_1'][$i]["promocode"] = get_field('promocode', $item->ID);
        $slider_1['slider_1'][$i]["views_click"] = $item->views_click;
        $slider_1['slider_1'][$i]["image_url"] = get_field('image_url', $item->ID);
        if (!$slider_1['slider_1'][$i]["image_url"]):
            $slider_1['slider_1'][$i]["image_url"] = get_the_post_thumbnail_url($item->ID, 'meduim');
        endif;



        $slider_1['slider_1'][$i]["images_url"] = [];
        $gallery = get_field('gallery', $item->ID);
        if($gallery):
            foreach($gallery as $g){
                array_push($slider_1['slider_1'][$i]["images_url"], $g["url"]);
            }
        endif;




        $slider_1['slider_1'][$i]["permalink"] = get_permalink($item->ID);
        $slider_1['slider_1'][$i]["price"] = get_field("price", $item->ID);
        $slider_1['slider_1'][$i]["old_price"] = get_field("old_price", $item->ID);
        $slider_1['slider_1'][$i]["sale_size"] = get_field("sale_size", $item->ID);
        $slider_1['slider_1'][$i]["expiration_date"] = get_field('expiration_date', $item->ID);
        $slider_1['slider_1'][$i]["post_title"] = $item->post_title;
        $slider_1['slider_1'][$i]["post_date"] = $item->post_date;
        $slider_1['slider_1'][$i]["post_content"] = $item->post_content;
        $slider_1['slider_1'][$i]["rating"] = get_field("rating", $item->ID);
        $slider_1['slider_1'][$i]["sale"] = get_field("sale", $item->ID);
        $slider_1['slider_1'][$i]["image_link"] = $page['image']['sizes']['large'];
        $slider_1['slider_1'][$i]["link"] = $page['link'];
        $slider_1['slider_1'][$i]["post_id"] = $page['post_id'];
        if($slider_1['slider_1'][$i]["post_id"] == ''){
            $slider_1['slider_1'][$i]["post_id"] = 0;
        }
        $shop_id = $page['shop_id'];
        $slider_1['slider_1'][$i]["shop_id"] = $shop_id;
        if(empty($shop_id)):
            $slider_1['slider_1'][$i]["shop_id"] = false;
        endif;
        $cat_id = $wpdb->get_results('SELECT term_taxonomy_id FROM wp_term_relationships WHERE object_id = ' . url_to_postid($page['link']) . ' LIMIT 1');
        foreach ($cat_id as $ci) {
            if ($cat_id != null) {
                $slider_1['slider_1'][$i]["category_id"] = $ci->term_taxonomy_id;
            } else {
                $slider_1['slider_1'][$i]["category_id"] = [];
            }
        }


    }


    foreach ($page6_slider_3 as $i => $page) {

        $slider_3['slider_3'][$i]["image_link"] = $page['image']['sizes']['large'];
        $slider_3['slider_3'][$i]["link"] = $page['link'];
        $slider_3['slider_3'][$i]["post_id"] = $page['post_id'];
        if($slider_3['slider_3'][$i]["post_id"] == ''){
            $slider_3['slider_3'][$i]["post_id"] = 0;
        }
        $cat_id = $wpdb->get_results('SELECT term_taxonomy_id FROM wp_term_relationships WHERE object_id = ' . url_to_postid($page['link']) . ' LIMIT 1');
        foreach ($cat_id as $ci) {
            if ($cat_id != null) {
                $slider_3['slider_3'][$i]["category_id"] = $ci->term_taxonomy_id;
            } else {
                $slider_3['slider_3'][$i]["category_id"] = [];
            }
        }
    }



    $save_wpq = new WP_Query(array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'meta_query' => 'meta_value',
        'meta_key' => 'sale_size',
        'orderby' => array( 'views_click' => 'DESC', 'meta_value_num' => 'DESC' ),
        'posts_per_page' => 6,
    ));
    $best_arr = [];
    $save_wpq = $save_wpq->get_posts();
    for($i = 0; $i < 1; $i++) {
        $best_arr["best_deals"][$i]["category_id"] = 51;
        $best_arr["best_deals"][$i]["url_more"] = get_the_permalink(51);
        $best_arr["best_deals"][$i]["category_name"] = 'Best Deals';
        foreach ($save_wpq as $ii => $item) {
            $term = get_term_by('slug', strtolower(get_field('source', $item->ID)), 'categories-shops');
            if($term->term_id){
                $image = get_field('icon', 'categories-shops_' . $term->term_id);
                $best_arr["best_deals"][$i]["post"][$ii]["shop_image_url"] = $image['url'];
                $best_arr["best_deals"][$i]["post"][$ii]["shop_name"] = $term->name;
            }
            $best_arr["best_deals"][$i]["post"][$ii]["shop_slug"] = $term->slug;
            $best_arr["best_deals"][$i]["post"][$ii]["shop_link"] = get_field('link', $item->ID);
            if($term->slug){
                $best_arr["best_deals"][$i]["post"][$ii]["shop_slug"] = $term->slug;
            }
            $best_arr["best_deals"][$i]["post"][$ii]["id"] = $item->ID;
            if(get_field('promocode', $item->ID) == null):
                $best_arr["best_deals"][$i]["post"][$ii]["promocode"] = "";
            else: $best_arr["best_deals"][$i]["post"][$ii]["promocode"] = get_field('promocode', $item->ID);
            endif;
            $best_arr["best_deals"][$i]["post"][$ii]["views_click"] = $item->views_click;
            $best_arr["best_deals"][$i]["post"][$ii]["image_url"] = get_field('image_url', $item->ID);
            if (!$best_arr["best_deals"][$i]["post"][$ii]["image_url"]):
                $best_arr["best_deals"][$i]["post"][$ii]["image_url"] = get_the_post_thumbnail_url($item->ID, 'meduim');
            endif;


            $best_arr["best_deals"][$i]["post"][$ii]["images_url"] = [];
            $gallery = get_field('gallery', $item->ID);
            if($gallery):
                foreach($gallery as $g){
                    array_push($best_arr["best_deals"][$i]["post"][$ii]["images_url"], $g["url"]);
                }
            endif;


            $best_arr["best_deals"][$i]["post"][$ii]["permalink"] = get_permalink($item->ID);
            $best_arr["best_deals"][$i]["post"][$ii]["price"] = get_field("price", $item->ID);
            $best_arr["best_deals"][$i]["post"][$ii]["old_price"] = get_field("old_price", $item->ID);
            $best_arr["best_deals"][$i]["post"][$ii]["sale_size"] = get_field("sale_size", $item->ID);
            if(get_field('expiration_date', $item->ID) == null):
                $best_arr["best_deals"][$i]["post"][$ii]["expiration_date"] = "";
            else: $best_arr["best_deals"][$i]["post"][$ii]["expiration_date"] = get_field('expiration_date', $item->ID);
            endif;
            $best_arr["best_deals"][$i]["post"][$ii]["post_title"] = $item->post_title;
            $best_arr["best_deals"][$i]["post"][$ii]["post_date"] = $item->post_date;
            $best_arr["best_deals"][$i]["post"][$ii]["post_content"] = $item->post_content;
            if(get_field("rating", $item->ID) == null):
                $best_arr["best_deals"][$i]["post"][$ii]["rating"] = 0;
            else:
                $best_arr["best_deals"][$i]["post"][$ii]["rating"] = get_field("rating", $item->ID);
            endif;
            if(get_field("sale", $item->ID) == null):
                $best_arr["best_deals"][$i]["post"][$ii]["sale"] = 0;
            else: $best_arr["best_deals"][$i]["post"][$ii]["sale"] = get_field("sale", $item->ID);
            endif;
        }
    }


    $posts_arr = [];
    $posts_arr["cat_with_posts"] = [];
    $countsubcateg = 0;
//    $another_deals = get_field('another_deals', 6);
//    if ($another_deals) {
    $get_cat = get_categories([
            'taxonomy'     => 'categories',
            'meta_query' => 'meta_value',
            'meta_key' => 'queue',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'hierarchical' => true,
        ]
    );
    $another_deals = get_field("another_deals", 6);
    foreach ($get_cat as $term_one) {
        foreach ($another_deals as $another_d){
//            echo $another_d. " == " .$term_one->term_id. "<br>";
            if( $another_d == $term_one->term_id && $term_one->parent == false):
                $subcateg = [];
                $subcateg["category_name"] = str_replace('&amp;', '&', $term_one->name);
                $subcateg["category_id"] = $term_one->term_id;
                $subcateg['subcategories'] = [];
                $subcat = [];
                foreach ($get_cat as $term) {
                    foreach ($another_deals as $another_d2) {

                        $term_name = get_term($term->term_id)->name;
                        if (

                            $another_d2 == $term->term_id &&
                            $term_one->term_id == get_term($term->term_id)->parent &&
                            get_term($term->term_id)->count >= 6 &&
                            $term->name != 'Others'
                        ) {
                            $countsubcateg++;
                            $subcat["category_id"] = $term->term_id;
                            $subcat["url_more"] = get_term_link($term->term_id);
                            $subcat["category_name"] = str_replace('&amp;', '&', $term_name);
                            $subcat["post"] = [];
                            $items = new WP_Query(array(
                                'post_type' => 'products',
                                'post_status' => 'publish',
                                'meta_query' => 'meta_value',
                                'meta_key' => 'sale_size',
                                'orderby' => array('views_click' => 'DESC', 'meta_value_num' => 'DESC'),
                                'posts_per_page' => 6,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'categories',
                                        'field' => 'id',
                                        'terms' => $term->term_id
                                    )
                                )
                            ));
                            $items = $items->get_posts();

                            foreach ($items as $ii => $item) {
                                $posts_obj = [];
                                $term = get_term_by('slug', strtolower(get_field('source', $item->ID)), 'categories-shops');
                                if ($term->term_id) {
                                    $image = get_field('icon', 'categories-shops_' . $term->term_id);
                                    $posts_obj["shop_image_url"] = $image['url'];
                                    $posts_obj["shop_name"] = $term->name;
                                }
                                $posts_obj["id"] = $item->ID;

                                if (get_field('promocode', $item->ID) == null):
                                    $posts_obj["promocode"] = "";
                                else: $posts_obj["promocode"] = get_field('promocode', $item->ID);
                                endif;

                                if ($term->slug) {
                                    $posts_obj["shop_slug"] = $term->slug;
                                }
                                $posts_obj["shop_link"] = get_field('link', $item->ID);
                                $posts_obj["views_click"] = $item->views_click;
                                $posts_obj["image_url"] = get_field('image_url', $item->ID);
                                if (!$posts_obj["image_url"]):
                                    $posts_obj["image_url"] = get_the_post_thumbnail_url($item->ID, 'meduim');
                                endif;
                                $posts_obj["images_url"] = [];
                                $gallery = get_field('gallery', $item->ID);
                                if ($gallery):
                                    foreach ($gallery as $g) {
                                        array_push($posts_obj["images_url"], $g["url"]);
                                    }
                                endif;


                                $posts_obj["permalink"] = get_permalink($item->ID);
                                $posts_obj["price"] = get_field("price", $item->ID);
                                $posts_obj["old_price"] = get_field("old_price", $item->ID);
                                $posts_obj["sale_size"] = get_field("sale_size", $item->ID);

                                if (get_field('expiration_date', $item->ID) == null):
                                    $posts_obj["expiration_date"] = "";
                                else: $posts_obj["expiration_date"] = get_field('expiration_date', $item->ID);
                                endif;

                                $posts_obj["post_title"] = $item->post_title;
                                $posts_obj["post_date"] = $item->post_date;
                                $posts_obj["post_content"] = $item->post_content;

                                if (get_field("rating", $item->ID) == null):
                                    $posts_obj["rating"] = 0;
                                else: $posts_obj["rating"] = get_field("rating", $item->ID);
                                endif;
                                if (get_field("sale", $item->ID) == null):
                                    $posts_obj["sale"] = 0;
                                else: $posts_obj["sale"] = get_field("sale", $item->ID);
                                endif;
                                array_push($subcat["post"], $posts_obj);
                            }
                            array_push($subcateg['subcategories'], $subcat);
                        }

                    }
                }
                array_push($posts_arr["cat_with_posts"],$subcateg);
            endif;
        }
    }
    $posts_arr2 = [];
    $posts_arr2["cat_with_posts"] = [];
    foreach ($posts_arr["cat_with_posts"] as $i => $c_post):
        if($c_post["subcategories"] != false):
            array_push($posts_arr2["cat_with_posts"],$c_post);
        endif;

    endforeach;




    $categories_shops = [];
    $cat_id = get_terms(
        array(
            'taxonomy'   => [ 'categories-shops' ],
            'hide_empty' => true,
            'pad_counts'  => true,
            'orderby'  => 'count',
            'order'    => 'DESC'
        )
    );
    foreach ($cat_id as $i => $page) {
        if($page->count != 0){
            $image = get_field('icon', 'categories-shops_'.$page->term_id);
            $categories_shops["shops"][$i]['image_url'] = $image['url'];
            $categories_shops["shops"][$i]['count'] = $page->count;
            $categories_shops["shops"][$i]['url'] = '/categories-shops/'.$page->slug;
        }
    }





    $bookshelf = [];

//    array_push($bookshelf , $slider_1  );
    array_push($bookshelf , $slider_1, $slider_3, $best_arr, $posts_arr2, $categories_shops);

    $new_arr = [];
    foreach($bookshelf as $bk):
        array_push($new_arr , $bk);
    endforeach;

    $filename = get_template_directory() . '/array-page/home/object-mob.json';

// Запись.
    $data = json_encode($new_arr);  // JSON формат сохраняемого значения.
    file_put_contents($filename, $data);
}

home_mob_array();

