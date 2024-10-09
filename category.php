<?php get_header(); ?>

<main class="categories">
    <div class="container categories__container">
        <h1 class="categories__h1 h1">
            <?php single_cat_title(); ?>
        </h1>

        <?php
          get_template_part( '/template-parts/category/category-breadcrumbs');
        ?>

        <?php
        // Получаем текущую категорию
        $current_category = get_queried_object();
        $current_category_id = $current_category->term_id;

        // Получаем текущий язык
        $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';

        // Задаем slugs для категорий на разных языках
        $category_slugs = array(
            'anounces' => array(
                'uk' => 'anounces',       // Украинский
                'en' => 'anounces-en',   // Английский
                'de' => 'anounces-de'   // Немецкий (пример)
            ),
            'interview' => array(
                'uk' => 'interview',      // Украинский
                'en' => 'interview-en',     // Английский
                'de' => 'interview-de'      // Немецкий (пример)
            )
        );

        // Получаем правильный slug для текущего языка
        $announces_slug = isset($category_slugs['anounces'][$current_lang]) ? $category_slugs['anounces'][$current_lang] : 'anounces';
        $interview_slug = isset($category_slugs['interview'][$current_lang]) ? $category_slugs['interview'][$current_lang] : 'interview';

        // Функция для проверки, является ли категория потомком другой категории
        function is_descendant_of($term_id, $parent_slug)
        {
            $parent = get_term_by('slug', $parent_slug, 'category');
            if (!$parent) {
                return false; // Если родительская категория не найдена
            }

            // Получаем всех потомков
            $children = get_term_children($parent->term_id, 'category');

            return in_array($term_id, $children);
        }

        // Получаем ID категории "Анонсы" на текущем языке
        $announces_category = get_term_by('slug', $announces_slug, 'category');
        $announces_cat_id = $announces_category ? pll_get_term($announces_category->term_id) : false;

        // Получаем ID категории "Интервью" на текущем языке
        $interview_category = get_term_by('slug', $interview_slug, 'category');
        $interview_cat_id = $interview_category ? pll_get_term($interview_category->term_id) : false;

        // Проверка на наличие категорий и вывод соответствующего шаблона
        if ($announces_cat_id && ($current_category_id === $announces_cat_id || is_descendant_of($current_category_id, $announces_slug))) {
            // Если это категория "Анонсы", выводим другой код
            get_template_part('/template-parts/category/category-anounces-list');
        } elseif ($interview_cat_id && ($current_category_id === $interview_cat_id || is_descendant_of($current_category_id, $interview_slug))) {
            // Если это категория "Интервью", выводим код для интервью
            get_template_part('/template-parts/category/category-interviews-list');
        } else {
            // Код для других категорий
            get_template_part('/template-parts/category/category-news-list');
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>
