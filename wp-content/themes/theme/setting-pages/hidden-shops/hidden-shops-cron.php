<?php
// Создает кастомный интервал времени и обзвает его
function hidden_shops_schedule( $schedules ) {
    // add a 'everyminute' schedule to the existing set
    $schedules['json_hidden_shops_everyminute'] = array(
        'interval' => 1200,
        'display'  => __( 'Update Hidden shops', 'gca-core' ),
    );
    return $schedules;
}

add_filter( 'cron_schedules', 'hidden_shops_schedule' );

// Добавляет в очередь вполнения для Cron'a
function hidden_shops_core_activate() {
    if ( ! wp_next_scheduled( 'hidden_shops_event' ) ) {
        wp_schedule_event( time(), 'json_hidden_shops_everyminute', 'hidden_shops_event' );
    }
}

register_activation_hook( __FILE__, 'hidden_shops_core_activate' );

add_action( 'hidden_shops_event', 'hidden_shops_cronjob' );

// Вызывает фцнкицю внутри
function hidden_shops_cronjob() {
    require get_template_directory() .'/setting-pages/hidden-shops/hidden-shops.php';
    global $hidden_shops_count;
    new Hidden_shops($hidden_shops_count);
}


// Удаляет задачу из очереди
function hidden_shops_deactivation() {
    wp_clear_scheduled_hook( 'hidden_shops_event' );
}

register_deactivation_hook( __FILE__, 'hidden_shops_deactivation' );

// Добавить эту задачу в текщие задачи крона
// Закомментировать сразу после включения
hidden_shops_core_activate();

// Удалить текущую задачу из задач крона
// Закомментировать сразу после отключения
//hidden_shops_deactivation();