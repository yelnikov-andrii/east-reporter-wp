<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<main class="main">

    <section class="main-top">
        <div class="container top__container">
            <div class="main-top__search-box">
            <?php get_search_form(); ?>
            </div>

            <div class="main-top__block">
                <div class="main-top__banner">
                    <iframe class="main-top__iframe" src="https://www.youtube.com/embed/2_ZgYGLoN0o?si=2Hmeqn7nFYgpGYmJ"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
                <?php
                $all_posts_query = new WP_Query(array(
                    'post_type' => 'post'
                ));
                if ($all_posts_query->have_posts()):
                    echo '<div class="main-top__news">';
                    while ($all_posts_query->have_posts()):
                        $all_posts_query->the_post(); ?>
                        <a class="main-top__news-card" href="<?php the_permalink(); ?>">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', array(
                                    'class' => 'main-top__news-img',
                                    'alt' => get_the_title(),
                                    'title' => 'Thumbnail Image'
                                ));
                            }
                            ?>
                            <h2 class="main-top__link">
                                <?php the_title(); ?>
                            </h2>
                        </a>
                    <?php endwhile;
                    echo '</div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <nav class="main-marquee">
        <ul class="main-marquee__content">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC'
            ));
            ?>
            <?php foreach ($categories as $category): ?>
                <li class="dropdown__item">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul aria-hidden="true" class="main-marquee__content">
            <?php foreach ($categories as $category): ?>
                <li class="dropdown__item">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <section class="main-news">
        <div class="container">
            <h2 class="main-news__title">
                Екологія
            </h2>

            <div class="main-news__block main-news__block--margin">
                <?php
                // Параметры запроса WP_Query для постов из категории "Екологія"
                $args = array(
                    'category_name' => 'ekologiya', // Слаг категории
                    'posts_per_page' => 3,         // Количество постов для отображения
                );

                $query = new WP_Query($args);

                // Проверяем, есть ли посты в категории
                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post(); ?>

                        <article class="main-news__article">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" class="main-news__img" alt="<?php the_title(); ?>" />
                            <?php endif; ?>

                            <h3 class="main-news__h3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="main-news__description">
                                <p><?php echo get_the_category_list(', '); ?></p>
                                <p><?php the_author(); ?></p>
                                <p><?php the_date(); ?></p>
                            </div>
                        </article>

                    <?php endwhile;
                    wp_reset_postdata(); // Сбрасываем глобальные данные поста
                else: ?>
                    <p>Пости в категорії екологія відсутні</p>
                <?php endif; ?>
            </div>

            <h2 class="main-news__title">
                Війна
            </h2>

            <div class="main-news__block main-news__block--margin">
                <?php
                $args = array(
                    'category_name' => 'vijna',
                    'posts_per_page' => 3,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post(); ?>

                        <article class="main-news__article">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" class="main-news__img" alt="<?php the_title(); ?>" />
                            <?php endif; ?>

                            <h3 class="main-news__h3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="main-news__description">
                                <p><?php echo get_the_category_list(', '); ?></p>
                                <p><?php the_author(); ?></p>
                                <p><?php the_date(); ?></p>
                            </div>
                        </article>

                    <?php endwhile;
                    wp_reset_postdata();
                else: ?>
                    <p>Пости в категорії війна відсутні</p>
                <?php endif; ?>
            </div>

            <h2 class="main-news__title">
                Мистецтво
            </h2>

            <div class="main-news__block main-news__block--margin">
                <?php
                $args = array(
                    'category__in' => array(get_cat_ID('Мистецтво'), get_cat_ID('.')),
                    'posts_per_page' => 3,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()):
                    while ($query->have_posts()):
                        $query->the_post(); ?>

                        <article class="main-news__article">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" class="main-news__img" alt="<?php the_title(); ?>" />
                            <?php endif; ?>

                            <h3 class="main-news__h3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="main-news__description">
                                <p><?php echo get_the_category_list(', '); ?></p>
                                <p><?php the_author(); ?></p>
                                <p><?php the_date(); ?></p>
                            </div>
                        </article>

                    <?php endwhile;
                    wp_reset_postdata();
                else: ?>
                    <p>Пости в категорії мистецтво відсутні</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <nav class="main-marquee">
        <ul class="main-marquee__content">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC'
            ));
            ?>
            <?php foreach ($categories as $category): ?>
                <li class="dropdown__item">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul aria-hidden="true" class="main-marquee__content">
            <?php foreach ($categories as $category): ?>
                <li class="dropdown__item">
                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                        <?php echo esc_html($category->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <section class="main-important">
        <div class="container main-important__block">
            <aside class="main-important__aside">
                <div>
                    <h2 class="main-important__title">
                        Новини
                    </h2>

                    <ul class="main-important__list">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order' => 'ASC'
                        ));
                        ?>
                        <?php foreach ($categories as $category): ?>
                            <li class="dropdown__item">
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                                    class="main-important__link">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
            <div class="main-important__banner">
                <h5>
                    Будьте в курсі
                    <br />
                    всіх новин з
                    <br />
                    <span class="main-important__span">
                        East Reporter
                    </span>
                    <?php 
                     $mypod = pods( 'contacts' );
                     if ($mypod->exists()) {
                        echo '<p>pod is exist</p>';
                     } else {
                        echo '<p> not found</p>';
                     }
                    ?>
                </h5>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>