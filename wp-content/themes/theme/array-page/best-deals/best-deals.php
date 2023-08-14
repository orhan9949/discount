<?php

Class Best_Deals_Json{
    public function __construct(){
        $this->categories = [];
        $this->categories_shops = [];
        $this->cupons = [];
        $this->all_array = [];
        $this->categories2 = [];
    }

    public function getCategories(): array
    {
        self::setCategories();

        return $this->categories;
    }
    public function getCategoriesShops(): array
    {
        self::setCategoriesShops();

        return $this->categories_shops;
    }
    public function setCategories(): void
    {
        $categories = [];
        $categories['categories'] = [];
        $cat_id = get_terms(
            array(
                'taxonomy'   => [ 'categories' ],
                'hide_empty' => true,
                'pad_counts'  => true,
                'meta_query' => 'meta_value',
                'meta_key' => 'queue',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'hierarchical'           => true,
                //'child_of'               => 0,
            )
        );


        foreach ($cat_id as $page) {
            if ($page->count != 0) {
                if ($page->parent == false) {
                    $cater = [];
                    $cater['term_id'] = $page->term_id;
                    $cater['name'] =  str_replace('&amp;', '&', $page->name);
                    $cater['slug'] = $page->slug;
                    $cater['taxonomy'] = $page->taxonomy;
                    $cater['child'] = [];
                    array_push($categories['categories'], $cater);
                }
            }

        }
        foreach ($categories['categories'] as $i => $page) {
            foreach ($cat_id as $page2) {
                if ($page2->count != 0 && $page['term_id'] == $page2->parent) {
                    $cater = [];
                    $cater['term_id'] = $page2->term_id;
                    $cater['name'] = str_replace('&amp;', '&', $page2->name);
                    $cater['slug'] = $page2->slug;
                    $cater['taxonomy'] = $page2->taxonomy;
                    array_push($categories['categories'][$i]['child'], $cater);
                }
            }
        }

        $categories2 = [];
        $categories2['categories'] = [];
        foreach ($categories['categories'] as $cater){
            if($cater["child"] != false){
                array_push($categories2['categories'], $cater);
            }
        }
        $this->categories = $categories2;
    }
    public function setCategoriesShops(): void
    {
        $categories_shops = [];
        $cat_id = get_terms(
            array(
                'taxonomy'   => [ 'categories-shops' ],
                'hide_empty' => true,
                'pad_counts'  => true,
                'meta_key' => 'popular',
                'meta_value' => '1',
                'orderby' => 'name',
                'order' => 'ASC',
            )
        );
        foreach ($cat_id as $i => $page) {
            if($page->count != 0){
                $categories_shops["categories_shops"][$i]['term_id'] = $page->term_id;
//                $categories_shops["categories_shops"][$i]['name'] = $page->name;
                $categories_shops["categories_shops"][$i]['name'] = str_replace('&amp;', '&', $page->name);
                $categories_shops["categories_shops"][$i]['slug'] = $page->slug;
                $categories_shops["categories_shops"][$i]['taxonomy'] = $page->taxonomy;
            }
        }
        $this->categories_shops = $categories_shops;
    }
    public function getCupons(): array
    {
        self::setCupons();
        return $this->cupons;
    }
    public function setCupons($posts_per_page = 100,$paged = 1): void
    {
        $args = array(
            'post_type'=> 'products',
            'posts_per_page' => $posts_per_page,
            'paged' => get_query_var('paged') ?:  $paged,
            'post_status' => 'publish',
            'meta_query' => 'meta_value',
            'meta_key' => 'sale_size',
            'orderby' => array( 'views_click' => 'DESC', 'meta_value_num' => 'DESC' ),
        );
        $posts_arr = [];
        $sposts = get_posts($args);
        foreach($sposts as $i => $post) {
            $posts_arr['posts'][$i] = $post;
            $posts_arr['posts'][$i]->id = $post->ID;
            $posts_arr['posts'][$i]->old_price = get_field("old_price", $post->ID);
            $posts_arr['posts'][$i]->price = get_field("price", $post->ID);
            $posts_arr['posts'][$i]->sale = get_field("sale", $post->ID);
            $posts_arr['posts'][$i]->sale_size = get_field("sale_size", $post->ID);
            $posts_arr['posts'][$i]->source = get_field("source", $post->ID);
            $posts_arr['posts'][$i]->rating = get_field("rating", $post->ID);
            $posts_arr['posts'][$i]->promocode = get_field("promocode", $post->ID);
            $posts_arr['posts'][$i]->expiration_date = get_field("expiration_date", $post->ID);
            global $wpdb;
            $posts_arr['posts'][$i]->image_url = get_field('image_url', $post->ID);
            if (!$posts_arr['posts'][$i]->image_url):
                $posts_arr['posts'][$i]->image_url = get_the_post_thumbnail_url($post->ID, 'meduim');
            endif;
            $posts_arr['posts'][$i]->images_url = [];
            $gallery = get_field('gallery', $post->ID);
            if($gallery):
                foreach($gallery as $g){
                    array_push($posts_arr['posts'][$i]->images_url, $g["url"]);
                }
            endif;


            $posts_arr['posts'][$i]->shop_link = get_field('link', $post->ID);
            $term = get_term_by( 'slug', strtolower(get_field('source', $post->ID)), 'categories-shops' );
            $image = get_field('icon', 'categories-shops_'.$term->term_id);
            $posts_arr['posts'][$i]->shop_name = $term->name;
            $posts_arr["posts"][$i]->shop_slug = $term->slug;
            $posts_arr['posts'][$i]->shop_image_url = $image['url'];
//            $posts_arr['posts'][$i]->expiration_date = get_field('expiration_date', $post->ID);
            $taxsonomy = $wpdb->get_results('SELECT wp_term_relationships.object_id, wp_term_relationships.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_terms.name, wp_terms.slug
                                                FROM wp_term_relationships
                                                JOIN wp_term_taxonomy
                                                  ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                                                JOIN wp_terms
                                                  ON wp_term_taxonomy.term_taxonomy_id = wp_terms.term_id
                                                WHERE object_id= "'.$post->ID.'"
                                                AND wp_term_taxonomy.taxonomy LIKE "categories"
                                                        ');
            if(!empty($taxsonomy[0]->term_taxonomy_id)){
                $posts_arr['posts'][$i]->category_id = $taxsonomy[0]->term_taxonomy_id;
            }
//            $posts_arr['posts'][$i]->post_content = $post->post_content;
//            $posts_arr['posts'][$i]->rating = get_field("rating", $post->ID);
//            $posts_arr['posts'][$i]->sale = get_field("sale", $post->ID);

        }


        $this->cupons = $posts_arr;
    }
    public function all_Array()
    {

        $this->getCategories();
        $this->getCategoriesShops();
        $this->getCupons();

        array_push($this->all_array, $this->categories , $this->categories_shops, $this->cupons);
        $filename = get_template_directory() . '/array-page/best-deals/object.json';

        // Запись.
        $data = json_encode($this->all_array);  // JSON формат сохраняемого значения.
        file_put_contents($filename, $data);
    }

}

$call_Best_Deals_Json = new Best_Deals_Json();

$call_Best_Deals_Json->all_Array();
//echo '<pre>';
//var_dump($call_Best_Deals_Json->categories2);
//echo '</pre>';











