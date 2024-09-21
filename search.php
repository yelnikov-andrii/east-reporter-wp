<?php get_header(); ?>

<main class="categories">
    <div class="container categories__container">
        <h1 class="categories__h1 h1">
            <?php printf(esc_html__('Результати пошуку для: %s', 'textdomain'), '<span>' . get_search_query() . '</span>'); ?>
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
            <span class="categories__span">
                <?php printf(esc_html__('Результати пошуку для: %s', 'textdomain'), '<span>' . get_search_query() . '</span>'); ?>
            </span>
        </nav>

        <div class="categories__block">
            <div class="categories__list">

                <?php if (have_posts()): ?>
                    <?php
                    while (have_posts()):

                        the_post();
                        get_template_part('template-parts/content', 'search');
                    endwhile;

                    the_posts_navigation();

                    ?>
                </div>

                <aside class="categories__aside categories-article-aside">
                    <div class="categories-article-aside__block">
                        <h2 class="categories-article-aside__h2">Recent posts</h2>
                        <div class="categories-article-aside__list">
                            <?php
                            $recent_posts = wp_get_recent_posts(array('numberposts' => 4));
                            foreach ($recent_posts as $post) {
                                echo '<a href="' . get_permalink($post["ID"]) . '" class="categories-article__link categories-article-aside__link">';
                                echo esc_html($post["post_title"]);
                                echo '</a>';
                            }
                            ?>
                        </div>
                    </div>

                    <div>
                        <h2 class="categories-article-aside__h2">Categories</h2>
                        <div class="categories-article-aside__list">
                            <?php
                            // Вывод категорий
                            $categories = get_categories();
                            foreach ($categories as $category) {
                                echo '<a href="' . get_category_link($category->term_id) . '" class="categories-article__link categories-article-aside__link">';
                                echo esc_html($category->name);
                                echo '</a>';
                            }
                            ?>
                        </div>
                    </div>
                </aside>

            </div>
        <?php else:
                    get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>


    </div>
</main>

<?php get_footer(); ?>