<?php
add_filter('show_admin_bar', '__return_false');
function disable_jquery() {
    if (!is_admin()) {  // Отключить только на фронтенде, оставить jQuery в админке
        wp_deregister_script('jquery');  // Удаление стандартного jQuery
    }
}
add_action('wp_enqueue_scripts', 'disable_jquery');

add_action('wp_enqueue_scripts', 'theme_name_scripts');

function theme_name_scripts()
{
    wp_enqueue_style('aos-style', 'https://unpkg.com/aos@2.3.4/dist/aos.css', array(), '2.3.4');

    wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');

    wp_enqueue_script('aos-script', 'https://unpkg.com/aos@2.3.4/dist/aos.js', array(), '1.3.4', true);

    wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');

    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}

add_theme_support('admin-bar', array('callback' => '__return_false'));
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