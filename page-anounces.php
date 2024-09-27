<?php
/*
Template Name: Anounces
*/
?>

<?php get_header(); ?>

<main class="anounces">
    <div class="container anounces__container">
        <h1 class="anounces__h1 h1">
            Анонси
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
                <?php single_cat_title(); ?>
            </span>
        </nav>

        <div class="anounces__list">

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'category_name' => 'anounces', // Слаг категории "Анонсы"
                'posts_per_page' => 10,         // Количество записей на страницу
                'paged' => $paged,     // Параметр пагинации
            );

            $anounces_query = new WP_Query($args);

            // Если есть записи
            if ($anounces_query->have_posts()) {
                // Выводим записи
                while ($anounces_query->have_posts()) {
                    $anounces_query->the_post(); ?>
                    <a class="anounces__item" href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url('full'); ?>" class="anounces__img" alt="<?php the_title(); ?>" />
                        <?php else: ?>
                            <img src="<?php bloginfo('template_url'); ?>/assets/images/default-image.png" class="anounces__img"
                                alt="Default image" />
                        <?php endif; ?>
                        <div class="anounces__description">
                            <h2 class="anounces__title">
                                <?php the_title(); ?>
                            </h2>
                        </div>
                    </a>
                <?php }

                // Выводим встроенную пагинацию
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('« Назад'),
                    'next_text' => __('Вперед »'),
                ));

                // Сбрасываем данные после запроса
                wp_reset_postdata();
            } else {
                echo '<p>Анонси відсутні</p>';
            }
            ?>
        </div>

        <nav class="pagination anounces__pagination">
            <ul class="pagination__list">
                <li class="pagination__item pagination__item--prev">
                    <a href="#" class="pagination__link">&laquo; Назад</a>
                </li>
                <li class="pagination__item pagination__item--active">
                    <a href="#" class="pagination__link">1</a>
                </li>
                <li class="pagination__item">
                    <a href="#" class="pagination__link">2</a>
                </li>
                <li class="pagination__item">
                    <a href="#" class="pagination__link">3</a>
                </li>
                <li class="pagination__item pagination__item--next">
                    <a href="#" class="pagination__link">Вперед &raquo;</a>
                </li>
            </ul>
        </nav>

    </div>
</main>

<?php get_footer(); ?>