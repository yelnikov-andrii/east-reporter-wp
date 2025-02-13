<?php
add_filter('show_admin_bar', '__return_false');
function disable_jquery()
{
    if (!is_admin()) {  // Отключить только на фронтенде, оставить jQuery в админке
        wp_deregister_script('jquery');  // Удаление стандартного jQuery
    }
}
// disable query
add_action('wp_enqueue_scripts', 'disable_jquery');

// menu registration

function my_theme_setup()
{
    register_nav_menus(array(
        'menu' => __('menu', 'East Reporter'),
    ));
}
add_action('after_setup_theme', 'my_theme_setup');

// pll string registration

if (function_exists('pll_register_string')) {
    pll_register_string('phone_label', 'Phone_str', 'Контакты');
    pll_register_string('no_posts_found', 'Посты не найдены', 'Сообщения');
    pll_register_string('video_not_found', 'Відео недоступне', 'Сообщения');
    pll_register_string('categories_not_found', 'Категорії відсутні', 'Сообщения');
    pll_register_string('no_data_found', 'За запитом нічого не знайдено', 'Сообщения');
    pll_register_string('news', 'Новини', 'Заголовки');
    pll_register_string('main_page', 'Головна сторінка', 'Заголовки');
    pll_register_string('search_on_website', 'Пошук по сайту', 'Заголовки');
    pll_register_string('recent_news', 'Нещодавні новини', 'Заголовки');
    pll_register_string('categories', 'Категорії', 'Заголовки');
    pll_register_string('related_posts', 'Пов\'язані пости', 'Заголовки');
    pll_register_string('page_not_found', 'Сторінка не знайдена', 'Заголовки');

}

// colors 

function my_theme_add_new_features()
{

    // Try to get the current theme default color palette
    $oldColorPalette = current((array) get_theme_support('editor-color-palette'));

    // Get default core color palette from wp-includes/theme.json
    if (false === $oldColorPalette && class_exists('WP_Theme_JSON_Resolver')) {
        $settings = WP_Theme_JSON_Resolver::get_core_data()->get_settings();
        if (isset($settings['color']['palette']['default'])) {
            $oldColorPalette = $settings['color']['palette']['default']; // there is no need to apply translations to color names - they are translated already
        }
    }

    // The new colors we are going to add
    $newColorPalette = [
        [
            'name' => esc_attr__('Primary Blue new', 'mytheme'),
            'slug' => 'primary-blue-new',
            'color' => '#0057b8',
        ],
        [
            'name' => __('Golden Yellow', 'mytheme'),
            'slug' => 'golden-yellow',
            'color' => '#ffd700',
        ],
        [
            'name' => __('Black', 'mytheme'),
            'slug' => 'black',
            'color' => '#000000',
        ],
        [
            'name' => __('White', 'mytheme'),
            'slug' => 'white',
            'color' => '#ffffff',
        ],
        [
            'name' => __('Red', 'mytheme'),
            'slug' => 'red',
            'color' => '#ff0000',
        ],
        [
            'name' => __('Green', 'mytheme'),
            'slug' => 'green',
            'color' => '#00ff00',
        ],
        [
            'name' => __('Blue', 'mytheme'),
            'slug' => 'blue',
            'color' => '#0000ff',
        ],
    ];

    // Merge the old and new color palettes
    if (!empty($oldColorPalette)) {
        $newColorPalette = array_merge($oldColorPalette, $newColorPalette);
    }

    // Apply the color palette containing the original colors and 2 new colors:
    add_theme_support('editor-color-palette', $newColorPalette);
}
add_action('after_setup_theme', 'my_theme_add_new_features');

// Polylang API add posibility to fetch posts by lang

function filter_posts_by_language($query)
{
    // Проверка, чтобы фильтр работал только на главном запросе и в API
    if ($query->is_main_query() && !is_admin() && isset($_GET['lang'])) {
        $lang = sanitize_text_field($_GET['lang']); // Получаем язык из параметра URL
        $query->set('lang', $lang); // Устанавливаем язык для WP запросов
    }
}

add_action('pre_get_posts', 'filter_posts_by_language');

// styles and scripts

add_action('wp_enqueue_scripts', 'theme_name_scripts');

function theme_name_scripts()
{
    // wp_enqueue_style('aos-style', 'https://unpkg.com/aos@2.3.4/dist/aos.css', array(), '2.3.4');

    // wp_enqueue_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');

    // wp_enqueue_script('aos-script', 'https://unpkg.com/aos@2.3.4/dist/aos.js', array(), '1.3.4', true);

    wp_enqueue_script('lazyframe-script', 'https://cdn.jsdelivr.net/npm/lazyframe/dist/lazyframe.min.js');

    // wp_enqueue_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');

    wp_enqueue_script('swiper-bundle-script', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array(), '1.0.0', true);
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
// remove block library for main page
function remove_block_library_css_on_home() {
    if (is_front_page()) { // Если это главная страница
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-blocks-style'); // Если WooCommerce
    }
}
add_action('wp_enqueue_scripts', 'remove_block_library_css_on_home', 100);


?>