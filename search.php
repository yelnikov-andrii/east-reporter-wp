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
            <svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
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
                    <?php while (have_posts()):
                        the_post(); ?>

                        <?php
                        // Проверка на наличие определённой категории
                        $announcements_category_id = get_cat_ID('anounces');
                        $interview_category_id = get_cat_ID('interview');

                        if (in_category($announcements_category_id)) {
                            // Если пост относится к категории "Анонсы"
                            get_template_part('template-parts/search/content-search-announces');

                        } elseif (has_category('interview')) {
                            // Если пост относится к категории "Интервью"
                            get_template_part('template-parts/search/content-search-interview');

                        } else {
                            // По умолчанию - загружается общий шаблон для остальных категорий
                            get_template_part('template-parts/search/content-search');
                        }
                        ?>

                    <?php endwhile; ?>

                    <?php the_posts_navigation(); ?>

                <?php else: ?>
                    <?php get_template_part('template-parts/search/content-none'); ?>
                <?php endif; ?>
            </div>

            <?php get_template_part('template-parts/common/aside') ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>