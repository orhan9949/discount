<?php
// Создает кастомный интервал времени и обзвает его
function categories_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_categories_page_everyminute'] = array(
        'interval' => 1200,
        'display'  => __( 'Update Home Page', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'categories_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function categories_page_core_activate() {
    if ( ! wp_next_scheduled( 'categories_page_event' ) ) {
        wp_schedule_event( time(), 'json_categories_page_everyminute', 'categories_page_event' );
    }
}

register_activation_hook( __FILE__, 'categories_page_core_activate' );

add_action( 'categories_page_event', 'categories_page_cronjob' );

// Вызывает фцнкицю внутри
function categories_page_cronjob() {
    require get_template_directory() .'/array-page/categories/categories.php';
}


// Удаляет задачу из очереди
function categories_page_deactivation() {
    wp_clear_scheduled_hook( 'categories_page_event' );
}

register_deactivation_hook( __FILE__, 'categories_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//categories_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//categories_page_deactivation();