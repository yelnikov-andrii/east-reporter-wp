<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<?php
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'dark'; // Получаем тему из куки или задаем по умолчанию
?>

<body class="<?php echo ($theme === 'light') ? 'light-theme' : ''; ?>">

    <header class="header">
        <div class="container header__container">
            <nav class="header__nav nav">
                <a class="header__logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/logo.png" alt="Logo"
                        class="header__img header__img--white-logo" />
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/logo_black.png" alt="Logo"
                        class="header__img header__img--black-logo" />
                </a>
                <div class="header__toggle">
                    <span class="header__toggle-span"></span>
                    <span class="header__toggle-span"></span>
                    <span class="header__toggle-span"></span>
                </div>
                <div class="header__wrapper-list">
                    <?php
                    // Выводим меню из админки
                    wp_nav_menu(array(
                        'theme_location' => 'menu',
                        'container' => false,
                        'menu_class' => 'header__list header-list',
                        'depth' => 1, // Уровень вложенности
                        'fallback_cb' => false, // Не выводить ничего, если меню не задано
                        'walker' => new My_Custom_Nav_Walker() // Используем кастомный walker
                    ));
                    ?>
                </div>

                <?php
                class My_Custom_Nav_Walker extends Walker_Nav_Menu
                {
                    function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0)
                    {
                        // Создаем элемент меню
                        $output .= '<li class="header-list__item">';
                        $output .= '<div class="header-list__wrapper-link">';

                        // Ссылка на элемент меню
                        $output .= '<a class="header-list__link" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';

                        // Получаем термин (категорию) по его object_id
                        $category = get_category($item->object_id);

                        // Если категория имеет подкатегории, добавляем SVG
                        if ($category) {
                            $subcategories = get_categories(array(
                                'child_of' => $category->term_id,
                                'hide_empty' => true,
                                'orderby' => 'name',
                                'order' => 'ASC',
                            ));

                            // Если подкатегории существуют
                            if (!empty($subcategories)) {
                                $output .= '<svg class="header-list__svg header-list__svg--plus" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14m-7 7V5" />
                                            </svg>';
                                $output .= '<svg class="header-list__svg header-list__svg--minus" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14" />
                                            </svg>';
                            }
                        }

                        $output .= '</div>'; // Закрываем div wrapper
                
                        // Закрываем li только после добавления контента внутри div
                

                        // Если есть подкатегории, добавляем их после закрытия li
                        if (!empty($subcategories)) {
                            $output .= '<ul class="dropdown">';
                            foreach ($subcategories as $subcategory) {
                                $output .= '<li class="dropdown__item">';
                                $output .= '<a href="' . esc_url(get_category_link($subcategory->term_id)) . '" class="header-list__link">';
                                $output .= esc_html($subcategory->name);
                                $output .= '</a></li>';
                            }
                            $output .= '</ul>';
                        }
                        $output .= '</li>';
                    }
                }
                ?>

                <!-- Добавление переключателя темы -->
                <div class="header__switchers-block">
                    <button id="theme-toggle" aria-label="Перемкнути тему світла/темна">
                        <svg class="theme-toggle-svg--sun" height="36px" id="Layer_1" version="1.1"
                            viewBox="0 0 512 512" width="36x" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g>
                                <g>
                                    <path
                                        d="M256,144c-61.75,0-112,50.25-112,112s50.25,112,112,112s112-50.25,112-112S317.75,144,256,144z M256,336    c-44.188,0-80-35.812-80-80c0-44.188,35.812-80,80-80c44.188,0,80,35.812,80,80C336,300.188,300.188,336,256,336z M256,112    c8.833,0,16-7.167,16-16V64c0-8.833-7.167-16-16-16s-16,7.167-16,16v32C240,104.833,247.167,112,256,112z M256,400    c-8.833,0-16,7.167-16,16v32c0,8.833,7.167,16,16,16s16-7.167,16-16v-32C272,407.167,264.833,400,256,400z M380.438,154.167    l22.625-22.625c6.25-6.25,6.25-16.375,0-22.625s-16.375-6.25-22.625,0l-22.625,22.625c-6.25,6.25-6.25,16.375,0,22.625    S374.188,160.417,380.438,154.167z M131.562,357.834l-22.625,22.625c-6.25,6.249-6.25,16.374,0,22.624s16.375,6.25,22.625,0    l22.625-22.624c6.25-6.271,6.25-16.376,0-22.625C147.938,351.583,137.812,351.562,131.562,357.834z M112,256    c0-8.833-7.167-16-16-16H64c-8.833,0-16,7.167-16,16s7.167,16,16,16h32C104.833,272,112,264.833,112,256z M448,240h-32    c-8.833,0-16,7.167-16,16s7.167,16,16,16h32c8.833,0,16-7.167,16-16S456.833,240,448,240z M131.541,154.167    c6.251,6.25,16.376,6.25,22.625,0c6.251-6.25,6.251-16.375,0-22.625l-22.625-22.625c-6.25-6.25-16.374-6.25-22.625,0    c-6.25,6.25-6.25,16.375,0,22.625L131.541,154.167z M380.459,357.812c-6.271-6.25-16.376-6.25-22.625,0    c-6.251,6.25-6.271,16.375,0,22.625l22.625,22.625c6.249,6.25,16.374,6.25,22.624,0s6.25-16.375,0-22.625L380.459,357.812z"
                                        fill="#ffffff" />
                                </g>
                            </g>
                        </svg>

                        <svg class="theme-toggle-svg--moon" enable-background="new 0 0 512 512" height="36px"
                            id="Layer_1" version="1.1" viewBox="0 0 512 512" width="36px" xml:space="preserve"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path
                                d="M349.852,343.15c-49.875,49.916-131.083,49.916-181,0c-49.916-49.918-49.916-131.125,0-181.021  c13.209-13.187,29.312-23.25,47.832-29.812c5.834-2.042,12.293-0.562,16.625,3.792c4.376,4.375,5.855,10.833,3.793,16.625  c-12.542,35.375-4,73.666,22.25,99.917c26.209,26.228,64.5,34.75,99.916,22.25c5.792-2.062,12.271-0.582,16.625,3.793  c4.376,4.332,5.834,10.812,3.771,16.625C373.143,313.838,363.06,329.941,349.852,343.15z M191.477,184.754  c-37.438,37.438-37.438,98.354,0,135.771c40,40.021,108.125,36.416,143-8.168c-35.959,2.25-71.375-10.729-97.75-37.084  c-26.375-26.354-39.333-61.771-37.084-97.729C196.769,179.796,194.039,182.192,191.477,184.754z"
                                fill="#1D1D1B" />
                        </svg>
                    </button>
                    <div class="language-switcher">
                        <button class="language-switcher__toggle">
                            <?php
                            if (function_exists('pll_current_language') && function_exists('pll_the_languages')) {
                                $current_lang_code = pll_current_language(); // Получаем код текущего языка
                            
                                // Получаем список всех языков, включая флаги
                                $languages = pll_the_languages(array(
                                    'show_flags' => 1,
                                    'show_names' => 0, // Отключаем отображение названий языков
                                    'dropdown' => 0,
                                    'echo' => 0
                                ));

                                // Находим текущий язык в списке языков
                                if (preg_match('/<li.*?lang="' . $current_lang_code . '".*?>(.*?)<\/li>/', $languages, $matches)) {
                                    // Извлекаем HTML с флагом текущего языка
                                    echo $current_lang_code;
                                    echo $matches[1]; // Здесь будет только флаг
                                }
                            }
                            ?>
                        </button>
                        <ul class="language-switcher__dropdown">
                            <?php
                            if (function_exists('pll_the_languages')) {
                                $languages = pll_the_languages(array(
                                    'show_flags' => 1,
                                    'show_names' => 1,
                                    'dropdown' => 0, // Убедитесь, что dropdown здесь выключен
                                    'echo' => 0 // Получить HTML вместо вывода
                                ));
                                echo $languages;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>