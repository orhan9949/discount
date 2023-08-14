<?php
Class Hidden_shops {
    public function __construct($total_count)
    {
        $this->total_count = $total_count;
        $this->all_shops_array = [];
        $this->write_in_json();
    }

    public function shops(){
        $get_cat = get_categories([
                'taxonomy'     => 'categories-shops',
                'orderby'      => 'count',
                'order'        => 'ASC',
                'hierarchical' => true,
            ]
        );
        foreach ($get_cat as $term_one):
            if($term_one->count < $this->total_count):
                $shop = [];
                $shop['name'] = $term_one->name;
                $shop['slug'] = $term_one->slug;
                $shop['term_id'] = $term_one->term_id;
                $shop["count"]   = $term_one->count;
                array_push($this->all_shops_array , $shop);
            endif;
        endforeach;
        return $this->all_shops_array;
    }

    private function write_in_json(){
        $array_shops = $this->shops();
        $filename = get_template_directory() . '/setting-pages/hidden-shops/object.json';
        $data = json_encode($array_shops);
        file_put_contents($filename, $data);
    }
}
$hidden_shops = new Hidden_shops(100);
