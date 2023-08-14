<?php

final Class Categories_json{
    public function __construct(){
        $this->arrCategoriesPages = [];
        $this->allCategories = [];
        $this->include_methods();

    }

    public function include_methods()
    {
        $this->allCategories();
        $this->getTopDeals();
        $this->record_in_jsonTopDeals();

    }

    private function allCategories()
    {
        $popular_terms = get_terms( 'categories-shops', ['hide_empty' => true,  'meta_key' => 'popular', 'meta_value' => '1'] );
        foreach ($popular_terms as $page) {
            if( $popular_terms && ! is_wp_error( $popular_terms ) ):
                $this->allCategories[$page->slug]['name'] = $page->name;
                $this->allCategories[$page->slug]['slug'] = $page->slug;
                $this->allCategories[$page->slug]['term_id'] = $page->term_id;
                $this->allCategories[$page->slug]['taxonomy'] = $page->taxonomy;
                $image = get_field('icon', 'categories-shops_' . $page->term_id);
                $this->allCategories[$page->slug]['img_url'] = $image['url'];
            endif;
        }
    }
    private function getTopDeals()
    {
        self::setTopDeals();
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
                'posts_per_page' => 100
            ] );
            $items = $query->get_posts();
            if( $items ):
                $this->arrCategoriesPages[$i]['taxonomy'] = $term["taxonomy"];
                $this->arrCategoriesPages[$i]['term_slug'] = $term["slug"];
                $this->arrCategoriesPages[$i]['term-name'] = $term["name"];
                $this->arrCategoriesPages[$i]['img_url'] = $term['img_url'];
                $this->arrCategoriesPages[$i]['description'] = category_description($term['term_id']);
                $posts = [];
                foreach($items as $item ):
                    $term2 = get_term_by('slug', strtolower(get_field('source', $item->ID)), 'categories-shops');
                    array_push($posts, $item);
                    $item->price = round(get_field("price", $item->ID));
                    $item->old_price = round(get_field("old_price", $item->ID));
                    $item->sale_size = get_field("sale_size", $item->ID);
                    $item->permalink = get_permalink($item->ID);
                    $item->image = get_field('image_url', $item->ID);
                    if (!$item->image):
                        $item->image = get_the_post_thumbnail_url($item->ID, 'meduim');
                    endif;
                    $image = get_field('icon', 'categories-shops_' . $term2->term_id);
                    $item->shop_image_url = $image['url'];
                    $item->shop_name = $term2->name;
                    $item->shop_link = "/categories-shops/" .$term2->slug;
                    $item->expiration_date = get_field('expiration_date',$item->ID);
                    $item->promocode = get_field('promocode',$item->ID);
                    $item->link = get_field('link',$item->ID);
                endforeach;
                $this->arrCategoriesPages[$i]['posts'] = $posts;
            endif;
        endforeach;
    }



    private function record_in_jsonTopDeals(){
        $terms_allCategories = (object)$this->arrCategoriesPages;
        foreach($terms_allCategories as $term):
            $allCategories = get_template_directory() . '/array-page/categories-shops/jsons/'.$term['term_slug'].'.json';
//             Запись.
            $jsonCategoriesPage = json_encode($term);  // JSON формат сохраняемого значения.
            file_put_contents($allCategories, $jsonCategoriesPage);
        endforeach;
    }
}




$Categories_json = new Categories_json();
//echo '<pre>';
//var_dump($Categories_json->arrCategoriesPages);
//echo '</pre>';