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

        if ($current_category->slug === 'anounces' || is_descendant_of($current_category->term_id, 'anounces')) {
            // Если это категория "Анонсы", выводим другой код
            get_template_part('/template-parts/category/category-anounces-list');
        } elseif ($current_category->slug === 'interview') {
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