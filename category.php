<?php get_header(); ?>

<main class="news">
    <div class="container news__container">
        <h1 class="news__h1">
            <?php single_cat_title(); ?>
        </h1>

        <div class="news__breadcrumbs">
            <a href="index.html" class="news__link news__link--breadcrumbs">
                На головну
            </a>
            <svg class="news__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <span class="news__span">
                <?php single_cat_title(); ?>
            </span>
        </div>

        <div class="news__block">
            <?php if (have_posts()): ?>
                <div class="news__list">
                    <?php while (have_posts()):
                        the_post(); ?>
                        <?php
                        get_template_part('template-parts/category-item');
                        ?>
                    <?php endwhile; ?>

                    <nav class="pagination news__pagination">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('&laquo; Назад'),
                            'next_text' => __('Вперед &raquo;'),
                        ));
                        ?>
                    </nav>
                </div>
            <?php endif; ?>
            <aside class="news-article__aside news-article-aside">
                <div class="news-article-aside__block">
                    <h2 class="news-article__h2">
                        Пошук по сайту
                    </h2>
                    <?php get_search_form(); // Вставка кастомной формы поиска ?>
                </div>

                <div class="news-article-aside__block">
                    <h2 class="news-article-aside__h2">
                        Нещодавні новини
                    </h2>
                    <div class="news-article-aside__list">
                        <?php
                        $recent_posts = wp_get_recent_posts([
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ]);

                        foreach ($recent_posts as $post): ?>
                            <a href="<?php echo get_permalink($post['ID']); ?>"
                                class="news-article__link news-article-aside__link">
                                <?php echo esc_html($post['post_title']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div>
                    <h2 class="news-article-aside__h2">
                        Категорії
                    </h2>
                    <div class="news-article-aside__list">
                        <?php
                        // Получаем все категории
                        $categories = get_categories();

                        // Проверяем, есть ли категории
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                // Генерируем HTML для каждой категории
                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="news-article__link news-article-aside__link">';
                                echo esc_html($category->name);
                                echo '</a>';
                            }
                        } else {
                            echo '<p>No categories found.</p>'; // Если категорий нет
                        }
                        ?>
                    </div>
                </div>
            </aside>
        </div>

    </div>
</main>

<?php get_footer(); ?>