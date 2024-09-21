<?php
/*
Template Name: Home Index page
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

    <?php
    get_template_part('template-parts/main-marquee-categories');
    ?>

    <section class="main-news">
        <div class="container">
            <h2 class="main-news__title" data-aos="fade-up">
                Екологія
            </h2>

            <?php
            $category_slug = 'ekologiya';
            get_template_part('template-parts/main-news-block', null, array('category_slug' => $category_slug));
            ?>

            <h2 class="main-news__title" data-aos="fade-up">
                Війна
            </h2>

            <?php
            $category_slug = 'vijna';
            get_template_part('template-parts/main-news-block', null, array('category_slug' => $category_slug));
            ?>


            <h2 class="main-news__title" data-aos="fade-up">
                Мистецтво
            </h2>

            <?php
            $category_slug = 'mystecztvo';
            get_template_part('template-parts/main-news-block', null, array('category_slug' => $category_slug));
            ?>
        </div>
    </section>

    <?php
    get_template_part('template-parts/main-marquee-categories');
    ?>

    <section class="main-important">
        <div class="container main-important__block">
            <aside class="main-important__aside">
                <div>
                    <h2 class="main-important__title">
                        Новини
                    </h2>

                    <ul class="main-important__list">
                        <?php
                        $parent_category = get_category_by_slug('news');
                        if ($parent_category) {
                            // Получаем подкатегории категории "news"
                            $subcategories = get_categories(array(
                                'child_of' => $parent_category->term_id, // ID родительской категории
                                'hide_empty' => false, // Показывать пустые категории или нет
                                'orderby' => 'name',
                                'order' => 'ASC'
                            ));
                        }
                        ?>
                        <?php foreach ($subcategories as $category): ?>
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
            <div class="main-important__banner" data-aos="fade-left">
                <h5>
                    Будьте в курсі
                    <br />
                    всіх новин з
                    <br />
                    <span class="main-important__span">
                        East Reporter
                    </span>
                    <?php
                    $mypod = pods('contacts');
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