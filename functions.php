<?php
add_filter('show_admin_bar', '__return_false');
add_action('wp_enqueue_scripts', 'theme_name_scripts');
function theme_name_scripts()
{
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('aos-style', get_template_directory_uri() . 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
    wp_enqueue_script('aos-script', get_template_directory_uri() . 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
}

add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('post'));          // Только для post
add_theme_support('post-thumbnails', array('page'));          // Только для page
add_theme_support('post-thumbnails', array('post', 'movie')); // Для post и movie типов
add_theme_support('custom-logo', [
    'height' => 190,
    'width' => 190,
    'flex-width' => false,
    'flex-height' => false,
    'header-text' => '',
    'unlink-homepage-logo' => false, // WP 5.5
]);
?>