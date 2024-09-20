<?php get_header(); ?>

<main class="news-article">
    <div class="container news-article__container">
        <nav class="news-article__breadcrumbs">
            <a class="news-article__link" href="/">
                На головну
            </a>
            <svg class="news__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <?php
            $post_id = get_the_ID();
            $categories = get_the_category($post_id);
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    echo '<a class="news-article__link" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                    echo '<svg class="news__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                          </svg>';
                }
            }
            ?>
            <span>
                <?php
                the_title();
                ?>
            </span>
        </nav>

        <div class="news-article__block">
            <div class="news-article__article-wrapper">
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" class="news-article__article">
                            <h1 class="news-article__h1"><?php the_title(); ?></h1>
                            <div class="news-article__meta">
                                <span class="news-article__span"><?php the_date(); ?></span>
                                <span class="news-article__span"><?php the_author(); ?></span>
                            </div>
                            <div class="news-article__content">
                                <?php the_content(); ?>
                            </div>
                        </article>
                    <?php endwhile;
                endif;
                ?>
                <nav class="news-article__nav news-article-nav">
                    <?php
                    // Получаем предыдущий пост
                    $prev_post = get_previous_post();
                    if (!empty($prev_post)): ?>
                        <a class="news-article-nav__item news-article-nav__item--prev"
                            href="<?php echo get_permalink($prev_post->ID); ?>">
                            <svg class="news-article-nav__button" focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                data-testid="ArrowBackIosIcon">
                                <path d="M11.67 3.87 9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"></path>
                            </svg>
                            <h2 class="news-article-nav__h2">
                                <?php echo esc_html($prev_post->post_title); ?>
                            </h2>
                        </a>
                    <?php endif; ?>

                    <?php
                    // Получаем следующий пост
                    $next_post = get_next_post();
                    if (!empty($next_post)): ?>
                        <a class="news-article-nav__item news-article-nav__item--next"
                            href="<?php echo get_permalink($next_post->ID); ?>">
                            <h2 class="news-article-nav__h2">
                                <?php echo esc_html($next_post->post_title); ?>
                            </h2>
                            <svg class="news-article-nav__button" focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                                data-testid="ArrowForwardIosIcon">
                                <path d="M6.23 20.23 8 22l10-10L8 2 6.23 3.77 14.46 12z"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </nav>

                <h2 class="news-article__h2">
                    Пов'язані пости
                </h2>
                <div class="news-article__related related-posts">
                    <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category_ids = array();
                        foreach ($categories as $category) {
                            $category_ids[] = $category->term_id;
                        }

                        $related_posts_args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array(get_the_ID()),
                            'posts_per_page' => -1,
                            'orderby' => 'rand'
                        );

                        $related_posts_query = new WP_Query($related_posts_args);

                        if ($related_posts_query->have_posts()) {

                            while ($related_posts_query->have_posts()) {
                                $related_posts_query->the_post(); ?>
                                <a class="related-posts__post" href="<?php the_permalink(); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium', ['class' => 'news-article__img']);
                                    }
                                    ?>
                                    <h2 class="news-article__title related-posts__title">
                                        <?php the_title(); ?>
                                    </h2>
                                    <p>
                                        <?php the_date(); ?>
                                    </p>
                                </a>
                            <?php }
                        }

                        wp_reset_postdata();
                    }
                    ?>
                </div>

                <h2 class="news-article__h2">
                    Коментувати
                </h2>
                <form class="news-article__form news-article-form">
                    <label for="comment" class="news-article-form__label">
                        Ваш комент
                    </label>
                    <textarea class="news-article-form__textarea" id="comment" rows="10">
                        </textarea>
                    <button class="news-article-form__button">
                        Відправити
                    </button>
                </form>
            </div>

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

    </div>
</main>

<?php get_footer(); ?>