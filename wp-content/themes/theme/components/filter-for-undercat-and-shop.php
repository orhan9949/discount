<?php
function filter_for_undercat_and_shop($request)
{

    /**
     * @array $cat_slug - находятся все слаги подкатегорий
     */
    $cat_slug = [];


    /**
     * @array $cat_slug_total - находятся только те категории которые есть в магазине
     */
    $cat_slugs = [];


    /**
     * @args $terms - получаем все категории и записываем их в массив $cat_slug
     */
    $terms = get_terms(array(
        'taxonomy' => $request['category'],
    ));
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
    foreach ($cat_slug as $cs):


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
        foreach ($items as $it):
            if ($it && !in_array($cs, $cat_slugs)):
                array_push($cat_slugs, $cs);
            endif;
        endforeach;
    endforeach;


    $terms_ext = get_terms(array(
        'taxonomy' => $request['category'],
    ));
    foreach($cat_slugs as $c_sl):
        foreach($terms_ext as $t_ex):
            if($c_sl == $t_ex->slug):
                echo '<label>'.$t_ex->name.'<input type="radio"  name="cat_or_shop" value="'.$t_ex->slug.'"></label>';
            endif;
        endforeach;
    endforeach;
}