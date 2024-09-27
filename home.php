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
                    <?php echo render_video_from_pod(get_the_ID()); ?>
                </div>
                <?php
                $news_query = new WP_Query(array(
                    'post_type' => 'post',
                    'category_name' => 'news'
                ));
                if ($news_query->have_posts()):
                    echo '<div class="main-top__news swiper"><div class="swiper-wrapper">';
                    while ($news_query->have_posts()):
                        $news_query->the_post(); ?>
                        <a class="main-top__news-card swiper-slide" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('large', array(
                                    'class' => 'main-top__news-img',
                                    'alt' => get_the_title(),
                                    'title' => 'Thumbnail Image'
                                )); ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-image.png"
                                    alt="Default Image" class="main-top__news-img" />
                            <?php endif; ?>
                            <h2 class="main-top__link">
                                <?php the_title(); ?>
                            </h2>
                        </a>
                    <?php endwhile;
                    echo '</div>
              </div>
              <div class="swiper-navigation">
                  <div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 384 512">
            <path
                d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
            </path>
        </svg></div>
                  <div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 384 512">
            <path
                d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
            </path>
        </svg></div>
              </div>
            </div>';
                endif;
                wp_reset_postdata();
                ?>
            </div>

        </div>
    </section>

    <?php
    get_template_part('template-parts/main/main-marquee-categories');
    ?>

    <section class="main-news">
        <div class="container">
            <h2 class="main-news__title" data-aos="fade-up">
                Екологія
            </h2>

            <div class="swiper-news-1 main-news__block main-news__block--margin" data-aos="fade-up">
                <?php
                $category_slug = 'ekologiya';
                get_template_part('template-parts/main/main-news-block', null, array('category_slug' => $category_slug));
                ?>
            </div>

            <h2 class="main-news__title" data-aos="fade-up">
                Війна
            </h2>

            <div class="swiper-news-2 main-news__block main-news__block--margin" data-aos="fade-up">
                <?php
                $category_slug = 'vijna';
                get_template_part('template-parts/main/main-news-block', null, array('category_slug' => $category_slug));
                ?>
            </div>


            <h2 class="main-news__title" data-aos="fade-up">
                Культура
            </h2>

            <div class="swiper-news-3 main-news__block" data-aos="fade-up">
                <?php
                $category_slug = 'kultura';
                get_template_part('template-parts/main/main-news-block', null, array('category_slug' => $category_slug));
                ?>
            </div>
        </div>
    </section>

    <?php
    get_template_part('template-parts/main/main-marquee-categories');
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
                        <?php foreach ($subcategories as $index => $category): ?>
                            <li class="dropdown__item" data-aos="fade-left" data-aos-delay="<?php echo $index * 100; ?>">
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                                    class="main-important__link">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
            <div class="main-important__banner" data-aos="fade-right">
                <h5>
                    Будьте в курсі
                    <br />
                    всіх новин з
                    <br />
                    <span class="main-important__span">
                        East Reporter
                    </span>
                </h5>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>