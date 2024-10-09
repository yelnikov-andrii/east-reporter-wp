<aside class="categories-article__aside categories-article-aside">
    <div class="categories-article-aside__block">
        <h2 class="categories-article__h2">
            <?php
              echo pll__('Пошук по сайту');
            ?>
        </h2>
        <?php get_search_form(); // Вставка кастомной формы поиска ?>
    </div>

    <div class="categories-article-aside__block">
        <h2 class="categories-article-aside__h2">
            <?php
              echo pll__('Нещодавні новини');
            ?>
        </h2>
        <div class="categories-article-aside__list">
            <?php
            $recent_news_query = new WP_Query([
                'category_name' => 'news', // Слаг категории "новости"
                'posts_per_page' => 9, // Количество постов
                'post_status' => 'publish' // Только опубликованные посты
            ]);
            if ($recent_news_query->have_posts()):
                while ($recent_news_query->have_posts()):
                    $recent_news_query->the_post(); ?>
                    <a href="<?php echo get_permalink(); ?>" class="categories-article__link categories-article-aside__link">
                        <?php echo esc_html(get_the_title()); ?>
                    </a>
                <?php endwhile;
                wp_reset_postdata(); // Сброс глобальной переменной $post
            else:
                echo pll__('Посты не найдены');
            endif;
            ?>

        </div>
    </div>

    <div class="categories-article-aside__block">
        <h2 class="categories-article-aside__h2">
            <?php echo pll__('Категорії'); ?>
        </h2>
        <div class="categories-article-aside__list">
            <?php
            // Получаем все категории
            $categories = get_categories(array(
                'parent' => 0 // Получаем только верхние категории
            ));

            // Проверяем, есть ли категории
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    // Генерируем HTML для каждой категории
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="categories-article__link categories-article-aside__link">';
                    echo esc_html($category->name);
                    echo '</a>';
                }
            } else {
                echo pll__('Категорії відсутні');
            }
            ?>
        </div>
    </div>

    <div>
        <h2 class="categories-article-aside__h2">
            <?php echo pll__('Новини') ?>
        </h2>
        <div class="categories-article-aside__list">
            <?php
            $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';

            // Задаем slugs для категорий на разных языках
            $category_slugs = array(
                'news' => array(
                    'uk' => 'news',       // Украинский
                    'en' => 'news-en',   // Английский
                    'de' => 'news-de'   // Немецкий (пример)
                )
            );
            $parent_category = get_category_by_slug($category_slugs['news'][$current_lang]);

            if ($parent_category) {
                $categories = get_categories(array('parent' => $parent_category->term_id));
            }

            // Проверяем, есть ли категории
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    // Генерируем HTML для каждой категории
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="categories-article__link categories-article-aside__link">';
                    echo esc_html($category->name);
                    echo '</a>';
                }
            } else {
                echo pll__('Категорії відсутні');
            }
            ?>
        </div>
    </div>
</aside>