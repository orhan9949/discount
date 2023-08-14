<?php
// Создает кастомный интервал времени и обзвает его
function categories_shops_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_categories_shops_page_everyminute'] = array(
        'interval' => 1200,
        'display'  => __( 'Update Home Page', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'categories_shops_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function categories_shops_page_core_activate() {
    if ( ! wp_next_scheduled( 'categories_shops_page_event' ) ) {
        wp_schedule_event( time(), 'json_categories_shops_page_everyminute', 'categories_shops_page_event' );
    }
}

register_activation_hook( __FILE__, 'categories_shops_page_core_activate' );

add_action( 'categories_shops_page_event', 'categories_shops_page_cronjob' );

// Вызывает фцнкицю внутри
function categories_shops_page_cronjob() {
    require get_template_directory() .'/array-page/categories-shops/categories-shops.php';
    require get_template_directory() .'/array-page/categories-shops/top-deals.php';
}


// Удаляет задачу из очереди
function categories_shops_page_deactivation() {
    wp_clear_scheduled_hook( 'categories_shops_page_event' );
}

register_deactivation_hook( __FILE__, 'categories_shops_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//categories_shops_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//categories_shops_page_deactivation();