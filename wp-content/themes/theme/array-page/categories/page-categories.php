<?php

final Class Page_Categories_json{
    public function __construct(){
        $this->categories = [];
        $this->include_methods();

    }

    public function include_methods()
    {
        $this->allCategories();
        $this->record_in_jsonTopDeals();

    }

    private function allCategories()
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
                    $cater['count'] = $page->count;
                    $cater['description'] = $page->description;
                    $cater['taxonomy'] = $page->taxonomy;
                    $image = get_field('icon', 'categories-shops_' . $page->term_id);
                    $cater['image_url'] = $image['url'];
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
                    $cater['count'] = $page2->count;
                    $cater['url'] = get_term_link( $page2->term_id );
                    $cater['taxonomy'] = $page2->taxonomy;
                    $image = get_field('icon', 'categories-shops_' . $page2->term_id);
                    $cater['image_url'] = $image['url'];
                    array_push($categories['categories'][$i]['child'], $cater);
                }
            }
        }

        $categories2 = [];
//        $categories2['categories'] = [];
        foreach ($categories['categories'] as $cater){
            if($cater["child"] != false){
                array_push($categories2, $cater);
            }
        }
        $this->categories = $categories2;
    }



    private function record_in_jsonTopDeals(){
        $terms_allCategories = (object)$this->categories;
            $allCategories = get_template_directory() . '/array-page/categories/page-categories.json';
//             Запись.
            $jsonCategoriesPage = json_encode($terms_allCategories);  // JSON формат сохраняемого значения.
            file_put_contents($allCategories, $jsonCategoriesPage);
    }
}

$Page_Categories_json = new Page_Categories_json();
//echo '<pre>';
//var_dump($Categories_json->allCategories);
//echo '</pre>';