<?php get_header(); ?>

<main class="categories">
    <div class="container categories__container">
        <h1 class="categories__h1 h1">
            <?php single_cat_title(); ?>
        </h1>

        <nav class="categories__breadcrumbs">
            <a href="/" class="categories__link categories__link--breadcrumbs">
                На головну
            </a>
            <svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>

            <?php
            // Получаем текущую категорию
            $current_category = get_queried_object();

            if ($current_category) {
                // Проверяем, есть ли у категории родительские категории
                $parent_ids = [];
                $parent_category = $current_category->parent;

                // Получаем всех родительских категорий
                while ($parent_category) {
                    $parent = get_category($parent_category);
                    if ($parent) {
                        $parent_ids[] = $parent; // Добавляем родительскую категорию в массив
                        $parent_category = $parent->parent; // Переходим к следующему родителю
                    } else {
                        break;
                    }
                }

                // Если есть родительские категории, выводим их в виде ссылок
                if (!empty($parent_ids)) {
                    foreach (array_reverse($parent_ids) as $parent) {
                        $link = get_category_link($parent->term_id);
                        echo '<a href="' . esc_url($link) . '" class="categories__link categories__link--breadcrumbs">' . esc_html($parent->name) . '</a> ';
                        echo '<svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>';
                    }
                }

                // Выводим текущую категорию
                echo '<span class="categories__span">' . esc_html($current_category->name) . '</span>';
            }
            ?>
        </nav>
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
            ?>

            <?php if (have_posts()): ?>
                <div class="anounces__list">
                    <?php while (have_posts()):
                        the_post(); ?>

                        <a class="anounces__item" href="<?php the_permalink(); ?>">
                            <div class="anounces__overlay"></div>

                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="anounces__img" />
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-image.png"
                                    alt="Default image" class="anounces__img" />
                            <?php endif; ?>

                            <h2 class="anounces__title"><?php the_title(); ?></h2>
                        </a>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <nav class="pagination categories__pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Назад'),
                    'next_text' => __('Вперед &raquo;'),
                ));
                ?>
            </nav>
            <?php
        } else {
            // Код для других категорий
            ?>
            <div class="categories__block">
                <?php
                function get_reading_time($content)
                {
                    $word_count = str_word_count(strip_tags($content));
                    $reading_time = ceil($word_count / 180);
                    return max($reading_time, 1);
                }
                ?>
                <?php if (have_posts()): ?>
                    <div class="categories__list">
                        <?php while (have_posts()):
                            the_post(); ?>
                            <?php
                            get_template_part('template-parts/category-item');
                            ?>
                        <?php endwhile; ?>

                        <nav class="pagination categories__pagination">
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
                <aside class="categories-article__aside categories-article-aside">
                    <div class="categories-article-aside__block">
                        <h2 class="categories-article__h2">
                            Пошук по сайту
                        </h2>
                        <?php get_search_form(); // Вставка кастомной формы поиска ?>
                    </div>

                    <div class="categories-article-aside__block">
                        <h2 class="categories-article-aside__h2">
                            Нещодавні новини
                        </h2>
                        <div class="categories-article-aside__list">
                            <?php
                            $recent_posts = wp_get_recent_posts([
                                'numberposts' => 5,
                                'post_status' => 'publish'
                            ]);

                            foreach ($recent_posts as $post): ?>
                                <a href="<?php echo get_permalink($post['ID']); ?>"
                                    class="categories-article__link categories-article-aside__link">
                                    <?php echo esc_html($post['post_title']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div>
                        <h2 class="categories-article-aside__h2">
                            Категорії
                        </h2>
                        <div class="categories-article-aside__list">
                            <?php
                            // Получаем все категории
                            $categories = get_categories();

                            // Проверяем, есть ли категории
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    // Генерируем HTML для каждой категории
                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="categories-article__link categories-article-aside__link">';
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
            <?php
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>