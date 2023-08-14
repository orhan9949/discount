<?php
// Создает кастомный интервал времени и обзвает его
function home_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_home_page_everyminute'] = array(
    'interval' => 600,
    'display'  => __( 'Update Home Page', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'home_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function home_page_core_activate() {
    if ( ! wp_next_scheduled( 'home_page_event' ) ) {
        wp_schedule_event( time(), 'json_home_page_everyminute', 'home_page_event' );
    }
}

register_activation_hook( __FILE__, 'home_page_core_activate' );

add_action( 'home_page_event', 'home_page_cronjob' );

// Вызывает фцнкицю внутри
function home_page_cronjob() {
    require get_template_directory() .'/array-page/home/home.php';
    home_array();
}


// Удаляет задачу из очереди
function home_page_deactivation() {
    wp_clear_scheduled_hook( 'home_page_event' );
}

register_deactivation_hook( __FILE__, 'home_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//home_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//home_page_deactivation();