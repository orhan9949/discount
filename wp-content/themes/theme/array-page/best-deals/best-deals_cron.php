<?php
// Создает кастомный интервал времени и обзвает его
function best_deals_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_best_deals_page_everyminute'] = array(
        'interval' => 1200,
        'display'  => __( 'Update Best Deals', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'best_deals_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function best_deals_page_core_activate() {
    if ( ! wp_next_scheduled( 'best_deals_page_event' ) ) {
        wp_schedule_event( time(), 'json_best_deals_page_everyminute', 'best_deals_page_event' );
    }
}

register_activation_hook( __FILE__, 'best_deals_page_core_activate' );

add_action( 'best_deals_page_event', 'best_deals_page_cronjob' );

// Вызывает фцнкицю внутри
function best_deals_page_cronjob() {
    require get_template_directory() .'/array-page/best-deals/best-deals.php';
//    home_array();
}


// Удаляет задачу из очереди
function best_deals_page_deactivation() {
    wp_clear_scheduled_hook( 'best_deals_page_event' );
}

register_deactivation_hook( __FILE__, 'best_deals_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//best_deals_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//best_deals_page_deactivation();