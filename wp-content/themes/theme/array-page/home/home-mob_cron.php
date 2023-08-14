<?php
// Создает кастомный интервал времени и обзвает его
function home_mob_page_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_home_mob_page_everyminute'] = array(
    'interval' => 600,
    'display'  => __( 'Update Home Page mob', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'home_mob_page_schedule' );

// Добавляет в очередь вполнения для Cron'a
function home_mob_page_core_activate() {
    if ( ! wp_next_scheduled( 'home_mob_page_event' ) ) {
        wp_schedule_event( time(), 'json_home_mob_page_everyminute', 'home_mob_page_event' );
    }
}

register_activation_hook( __FILE__, 'home_mob_page_core_activate' );

add_action( 'home_mob_page_event', 'home_mob_page_cronjob' );

// Вызывает фцнкицю внутри
function home_mob_page_cronjob() {
    require get_template_directory() .'/array-page/home/home-mob.php';
}


// Удаляет задачу из очереди
function home_mob_page_deactivation() {
    wp_clear_scheduled_hook( 'home_mob_page_event' );
}

register_deactivation_hook( __FILE__, 'home_mob_page_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
//home_mob_page_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//home_mob_page_deactivation();