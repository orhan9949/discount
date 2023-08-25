<?php
/**
 *
 * Этот код предназначен для вывода подкатегорий и магазинов для фильтров, смотря какая страница
 *
 */
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/cat_and_chop_filter', [
        'methods'  => 'GET',
        'callback' => 'total_categ',
        'permission_callback' => '__return_true',
    ] );

} );
add_action( 'rest_api_init', function(){

    register_rest_route( 'theme/v1', '/cat_and_chop_filter?category=(?P<category>.+)&pageslug=(?P<pageslug>.+)', [
        'methods'  => 'GET',
        'callback' => 'total_categ',
        'permission_callback' => '__return_true',
    ] );

} );
 function total_categ(WP_REST_Request $request){
    /**
     * @array $cat_slug - находятся все слаги подкатегорий
     */
    $cat_slug = [];


    /**
     * @array $cat_slug_total - находятся только те категории которые есть в магазине
     */
    $cat_slug_total = [];


    /**
     * @args $terms - получаем все категории и записываем их в массив $cat_slug
     */
    $terms = get_terms( array(
        'taxonomy'   => $request['category'],
    ) );
     if($request['category'] == 'categories'):
//        echo $request['category'];
         foreach ($terms as $it):
             if ($it->parent != false):
                 array_push($cat_slug, $it->slug);
             endif;
         endforeach;
     endif;
     if($request['category'] == 'categories-shops'):
//        echo $request['category'];
         foreach ($terms as $it):
             array_push($cat_slug, $it->slug);
         endforeach;

     endif;


    /**
     * выполняем перебор массива $cat_slug
     */
    foreach($cat_slug as $cs):


        /**
         * @args $query - настраиваем аргументы для запроса
         */
        $args = [
            'post_type' => 'products',
            'post_status' => 'publish',

            'posts_per_page' => 100
        ];
        if($request['category'] == 'categories'){
            $args = array_merge($args , array(
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'categories-shops',
                        'field' => 'slug',
                        'terms' => $request['pageslug'],
                    ),
                    array(
                        'taxonomy' => 'categories',
                        'field' => 'slug',
                        'terms' => $cs,
                    ),
                ),

            ));
        }
        if($request['category'] == 'categories-shops'){
            $args = array_merge($args , array(
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'categories-shops',
                        'field' => 'slug',
                        'terms' => $cs,
                    ),
                    array(
                        'taxonomy' => 'categories',
                        'field' => 'slug',
                        'terms' => $request['pageslug'],
                    ),
                ),

            ));
        }
        $query = new WP_Query( $args );
        $items = $query->get_posts();


        /**
         * выполняем перебор $items и проверяем если есть посты то пушим их в массив $cat_slug_total
         */
        foreach($items as $it):
            if($it && !in_array($cs,$cat_slug_total)):
                array_push($cat_slug_total, $cs );
            endif;
        endforeach;
    endforeach;
    return $cat_slug_total;
}