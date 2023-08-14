<?php

final Class Single_json{
    public function __construct(){
        $this->arrTopDeals = [];
        $this->allShops = [];
        $this->include_methods();

    }

    public function include_methods()
    {
        $this->categoriesShops();
        $this->getTopDeals();
        $this->record_in_jsonTopDeals();

    }
    private function getTopDeals()
    {
        self::setTopDeals();
    }


    private function setTopDeals()
    {
        $terms_allShops = (object)$this->allShops;
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
                    $item->image = get_field('image_url', $item->ID);
                    if (!$item->image):
                        $item->image = get_the_post_thumbnail_url($item->ID, 'meduim');
                    endif;
                    $term2 = get_term_by('name', get_field('source', $item->ID), 'categories-shops');
                    if($term2->term_id){
                        $image = get_field('icon', 'categories-shops_' . $term2->term_id);
                        $item->shop_image_url = $image['url'];
                        $item->shop_name = $image['title'];
                        $item->shop_link = "/categories-shops/" .$term2->slug;
                    }
                endforeach;
                $this->arrTopDeals[$i]['posts'] = $posts;
            endif;

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
            }
        }
    }


    private function record_in_jsonTopDeals(){
        $top_deals = get_template_directory() . '/array-page/categories-shops/top-deals.json';
        // Запись.
        $jsonTopDeals = json_encode($this->arrTopDeals);  // JSON формат сохраняемого значения.
        file_put_contents($top_deals, $jsonTopDeals);
    }
}




$Single_json = new Single_json();
