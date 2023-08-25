<?php
Class Hidden_shops {
    public function __construct($total_count)
    {
        $this->total_count = $total_count;
        $this->all_shops_array = [];
        $this->all_coupons_array = [];
        $this->include();
    }
    public function include(){
        $this->shops();
        $this->check_shops_from_jsonFile();
        $this->check_shops_from_database();
        $this->write_in_json();
    }

    /**
     * @return array
     * @method shops - Этот метод выводит все магазины у которых количество купонов меньше чем значение в свойстве $this->total_count
     */
    public function shops(){
        $get_cat = get_categories([
                'taxonomy'     => 'categories-shops',
                'orderby'      => 'count',
                'order'        => 'ASC',
                'hierarchical' => true,
            ]
        );
        foreach ($get_cat as $term_one):
            if($term_one->count <= $this->total_count):
                $shops_slugs = $term_one->slug;
                array_push($this->all_shops_array , $shops_slugs);
            endif;
        endforeach;
        return $this->all_shops_array;
    }

    /**
     *
     * @return void
     * @method get_json_file - получаем json файл для дальнейшей обработки и сверки с массивом $this->all_shops_array(обновлённые магазины)
     *
     */
    private function get_json_file(){
        $object_json_link = file_get_contents(get_template_directory() .'/setting-pages/hidden-shops/object.json');
        $object_json = json_decode($object_json_link, true);
        if(empty($object_json)):
            $object_json = ["never_no"];
        endif;
        return $object_json;
    }


    /**
     * @return void
     * @method check_shops_from_jsonFile - в этом методе проходит проверка json объекта магазинов на наличие таких же магазинов
     * в массиве $this->all_shops_array. То-есть если такого магазина нет в массиве то мы получаем его купоны и ставим им
     * статус publish, чтобы на странице выводились эти купоны так как в магазине больше купонов чем значение в свойстве $this->total_count.
     *
     */
    private function check_shops_from_jsonFile(){
        $object_json = $this->get_json_file();
        foreach ($object_json as $all_i => $d):
            if(!in_array($d, $this->all_shops_array)):
                echo $all_i + 1 .') '.$d ;
                $args = array(
                    'post_type'        => 'products',
                    'post_status'      => 'private',
                    'posts_per_page'   => 100,
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    'tax_query' => array(
                        array(
                            array(
                                'taxonomy' => 'categories-shops',
                                'field' => 'slug',
                                'terms' => $d,
                            )
                        ),
                    ),
                );
                $my_posts = new WP_Query($args);
                foreach ($my_posts->posts as  $pos):
                    global $wpdb;
                    $wpdb->get_results("UPDATE wp_posts SET post_status='publish' WHERE ID='".$pos->ID."'");
                endforeach;
            endif;
        endforeach;

    }

    /**
     * @return void
     * @method check_shops_from_database - в этом методе проходит проверка массива $this->all_shops_array магазинов на наличие таких же магазинов
     * в json объекте магазинов. То-есть если такого магазина нет в json объекте то мы получаем его купоны и ставим им
     * статус private, чтобы на странице не выводились эти купоны так как в магазине меньше купонов чем значение в свойстве $this->total_count.
     *
     */
    private function check_shops_from_database(){
        $object_json = $this->get_json_file();
        foreach ($this->all_shops_array as $all_i => $d2){
            if(!in_array($d2 , $object_json)):
                echo $all_i + 1 .') ' .$d2 ;
                $args = array(
                    'post_type'        => 'products',
                    'post_status'      => 'publish',
                    'posts_per_page'   => 100,
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    'tax_query' => array(
                        array(
                            array(
                                'taxonomy' => 'categories-shops',
                                'field' => 'slug',
                                'terms' => $d2,
                            )
                        ),
                    ),
                );
                $my_posts = new WP_Query($args);
                foreach ($my_posts->posts as  $pos) {
                    global $wpdb;
                    $wpdb->get_results("UPDATE wp_posts SET post_status='private' WHERE ID='".$pos->ID."'");
                    echo $pos->ID.'<br>';
                }
            endif;
        }
    }


    /**
     * @return void
     * @method write_in_json - В этом методе идёт запись в object.json слагов магазинов у которых купонов меньше чем значение в свойстве $this->total_count
     */
    private function write_in_json(){
        $array_shops = $this->all_shops_array;
        $filename = get_template_directory() . '/setting-pages/hidden-shops/object.json';
        $data = json_encode($array_shops);
        file_put_contents($filename, $data);
    }
}
$hidden_shops_count = 0;

