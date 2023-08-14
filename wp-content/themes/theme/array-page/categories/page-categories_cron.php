<?php
// Создает кастомный интервал времени и обзвает его
function page_categories_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_page_categories_page_everyminute'] = array(
        'interval' => 1200,
        'display'  => __( 'Update Page-categories', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'page_categories_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function page_categories_page_core_activate() {
    if ( ! wp_next_scheduled( 'page_categories_page_event' ) ) {
        wp_schedule_event( time(), 'json_page_categories_page_everyminute', 'page_categories_page_event' );
    }
}


register_activation_hook( __FILE__, 'page_categories_page_core_activate' );

add_action( 'page_categories_page_event', 'page_categories_page_cronjob' );

// Вызывает фцнкицю внутри
function page_categories_page_cronjob() {
    require get_template_directory() .'/array-page/categories/page-categories.php';
}


// Удаляет задачу из очереди
function page_categories_page_deactivation() {
    wp_clear_scheduled_hook( 'page_categories_page_event' );
}

register_deactivation_hook( __FILE__, 'page_categories_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//page_categories_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//page_categories_page_deactivation();