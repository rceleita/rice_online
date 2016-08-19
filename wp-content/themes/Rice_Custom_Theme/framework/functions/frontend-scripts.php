<?php

function frontend_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('custom_scripts', get_stylesheet_directory_uri() . '/scripts/script.js');
        wp_enqueue_script('filter_courses', get_stylesheet_directory_uri() . '/scripts/filter-courses.js');
}

add_action('wp_enqueue_scripts', 'frontend_scripts');
