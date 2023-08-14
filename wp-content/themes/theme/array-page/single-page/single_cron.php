<?php
// Создает кастомный интервал времени и обзвает его
function single_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_single_page_everyminute'] = array(
        'interval' => 300,
        'display'  => __( 'Update Home Page', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'single_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function single_page_core_activate() {
    if ( ! wp_next_scheduled( 'single_page_event' ) ) {
        wp_schedule_event( time(), 'json_single_page_everyminute', 'single_page_event' );
    }
}

register_activation_hook( __FILE__, 'single_page_core_activate' );

add_action( 'single_page_event', 'single_page_cronjob' );

// Вызывает фцнкицю внутри
function single_page_cronjob() {
    require get_template_directory() .'/array-page/single-page/single-page.php';
}


// Удаляет задачу из очереди
function single_page_deactivation() {
    wp_clear_scheduled_hook( 'single_page_event' );
}

register_deactivation_hook( __FILE__, 'single_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//single_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//single_page_deactivation();