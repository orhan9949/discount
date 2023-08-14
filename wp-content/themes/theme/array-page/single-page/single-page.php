<?php

final Class Single_json{
    public function __construct(){
        $this->arrOtherDeals = [];
        $this->arrTopDeals = [];
        $this->allShops = [];
        $this->allCategories = [];
        $this->include_methods();

    }

    public function include_methods()
    {
        $this->categoriesShops();
        $this->categories();
        $this->getOtherDeals();
        $this->getTopDeals();
        $this->record_in_jsonTopDeals();
        $this->record_in_jsonOther_deals();

    }
    private function getTopDeals()
    {
        self::setTopDeals();
    }

    private function getOtherDeals()
    {
        self::setOtherDeals();
    }

    private function setTopDeals()
    {
        $terms_allShops = (object)$this->allCategories;
        foreach($terms_allShops as $i => $term):

            $query = new WP_Query( [
                'post_type' => 'products',
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => $term["taxonomy"],
                        'field' => 'slug',
                        'terms' => $term["slug"],
                    ),
                ),
                'orderby' => 'views_click',
                'order' => 'DESC',
                'posts_per_page' => 6
            ] );
            $items = $query->get_posts();
            if( $items ):
                $this->arrTopDeals[$i]['taxonomy'] = $term["taxonomy"];
                $this->arrTopDeals[$i]['term_slug'] = $term["slug"];
                $this->arrTopDeals[$i]['term-name'] = $term["name"];

                $posts = [];
                foreach($items as $item ):
                    array_push($posts, $item);
                    $item->price = round(get_field("price", $item->ID));
                    $item->old_price = round(get_field("old_price", $item->ID));
                    $item->sale_size = get_field("sale_size", $item->ID);
//                    $item->shop_url = "/categories-shops/".$term["slug"];
                    $item->permalink = get_permalink($item->ID);
                    $item->image_url = get_field('image_url', $item->ID);
                    if (!$item->image_url):
                        $item->image_url = get_the_post_thumbnail_url($item->ID, 'meduim');
                    endif;
                    $term2 = get_term_by('slug', strtolower(get_field('source', $item->ID)), 'categories-shops');
                    if($term2->term_id){
                        $image = get_field('icon', 'categories-shops_' . $term2->term_id);
                        $item->shop_image_url = $image['url'];
                        $item->shop_name = $image['title'];
                        $item->shop_link = get_field('link', $item->ID);
                    }
                    $item->id = $item->ID;
                    $item->rating = get_field('rating', $item->ID);;
                    $item->promocode = get_field('promocode', $item->ID);;
                    $item->expiration_date = get_field('expiration_date', $item->ID);
                    $item->category_id = $term["term_id"];
                endforeach;
                $this->arrTopDeals[$i]['posts'] = $posts;
            endif;

        endforeach;
    }


    private function setOtherDeals()
    {
        $terms_allCategories = (object)$this->allShops;
        foreach($terms_allCategories as $i => $term):

            $query = new WP_Query([
                'post_type' => 'products',
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => $term["taxonomy"],
                        'field' => 'slug',
                        'terms' => $term["slug"],
                    ),
                ),
                'meta_key' => 'sale_size',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => 6
            ]);
            $items = $query->get_posts();
            if ($items):
                $this->arrOtherDeals[$i]['shop-url'] = "/categories-shops/" . $term["slug"];
                $this->arrOtherDeals[$i]['shop-name'] = $term["name"];
                $this->arrOtherDeals[$i]['slug'] = $term["slug"];
                $posts = [];
                foreach ($items as $item):
                    array_push($posts, $item);
                    $item->price = round(get_field("price", $item->ID));
                    $item->old_price = round(get_field("old_price", $item->ID));
                    $item->sale_size = get_field("sale_size", $item->ID);
                    $item->permalink = get_permalink($item->ID);
                    $item->image_url = get_field('image_url', $item->ID);
                    if (!$item->image_url):
                        $item->image_url = get_the_post_thumbnail_url($item->ID, 'meduim');
                    endif;
                    $term2 = get_term_by('slug', get_field('source', $item->ID), 'categories-shops');
                    if($term2->term_id){
                        $image = get_field('icon', 'categories-shops_' . $term2->term_id);
                        $item->shop_image_url = $image['url'];
                        $item->shop_name = $term2->name;
                        $item->shop_link = get_field('link', $item->ID);
                    }
                    $item->id = $item->ID;
                    $item->rating = get_field('rating', $item->ID);;
                    $item->promocode = get_field('promocode', $item->ID);;
                    $item->expiration_date = get_field('expiration_date', $item->ID);
                    $item->shop_url = "/categories-shops/" . $term["slug"];
                    $item->category_id = $term["term_id"];
                endforeach;
                $this->arrOtherDeals[$i]['posts'] = $posts;
            endif;

//            echo '<pre>';
//            var_dump($this->arrTopDeals);
//            echo '</pre>';
        endforeach;
    }


    private function categoriesShops()
    {
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
        foreach ($cat_id as $page) {
            if($page->count != 0){
                $this->allShops[$page->slug]['name'] = $page->name;
                $this->allShops[$page->slug]['slug'] = $page->slug;
                $this->allShops[$page->slug]['taxonomy'] = $page->taxonomy;
                $this->allShops[$page->slug]['term_id'] = $page->term_id;
            }
        }
    }


    private function categories()
    {
        $cat_id = get_terms(
            array(
                'taxonomy'   => [ 'categories' ],
                'hide_empty' => true,
                'pad_counts'  => true,
                'meta_key' => 'popular',
//                'meta_value' => '1',
                'orderby' => 'name',
                'order' => 'ASC',

                'hierarchical' => true,
            )
        );
        foreach ($cat_id as $page) {
            if($page->count != 0){
                $this->allCategories[$page->slug]['name'] = $page->name;
                $this->allCategories[$page->slug]['slug'] = $page->slug;
                $this->allCategories[$page->slug]['taxonomy'] = $page->taxonomy;
                $this->allCategories[$page->slug]['term_id'] = $page->term_id;
            }
        }
    }

    private function record_in_jsonTopDeals(){
        $top_deals = get_template_directory() . '/array-page/single-page/top-deals.json';
        // Запись.
        $jsonTopDeals = json_encode($this->arrTopDeals);  // JSON формат сохраняемого значения.
        file_put_contents($top_deals, $jsonTopDeals);
    }

    private function record_in_jsonOther_deals(){
        $other_deals = get_template_directory() . '/array-page/single-page/other-deals.json';
        // Запись.
        $jsonOtherDeals = json_encode($this->arrOtherDeals);  // JSON формат сохраняемого значения.
        file_put_contents($other_deals, $jsonOtherDeals);
    }
}




$Single_json = new Single_json();
