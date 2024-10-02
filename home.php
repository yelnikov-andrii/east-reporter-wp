<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<main class="main">
    <section class="main-top">
        <div class="container top__container">
            <div class="main-top__search-box">
                <?php get_search_form(); ?>
            </div>

            <div class="main-top__block">
                <div class="main-top__banner">
                    <?php
                    $pod = pods('main-video-frame');
                    $video_url = esc_url($pod->field('video'));
                    preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $video_url, $matches);
                    $video_id = isset($matches[1]) ? esc_attr($matches[1]) : '';
                    ?>
                    <div class="youtube-placeholder" data-video-id="<?php echo $video_id; ?>">
                        <?php if ($video_id): ?>
                            <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/hqdefault.jpg"
                                alt="Video Thumbnail">
                            <button class="youtube-play-button" aria-label="Відтворити відео">
                                <svg style="width: 100px; height: 100px" viewBox="0 0 1024 1024" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M658.2 523.8l-151.9 87.7c-31.6 18.2-71-4.6-71-41V395c0-36.4 39.5-59.2 71-41l151.9 87.7c31.5 18.4 31.5 63.9 0 82.1z"
                                        fill="#025cc0" />
                                    <path
                                        d="M533.2 870c-217.2 0-394-176.7-394-394S316 82 533.2 82s394 176.7 394 394-176.8 394-394 394z m0-737.1C344 132.9 190.1 286.8 190.1 476S344 819.1 533.2 819.1 876.3 665.2 876.3 476 722.4 132.9 533.2 132.9z"
                                        fill="#025cc0" />
                                </svg>
                            </button>
                        <?php else: ?>
                            <p>Відео недоступне</p>
                        <?php endif; ?>
                    </div>
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
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="swiper-navigation">
                <button class="swiper-button swiper-button-prev" aria-label="Попередній слайд">
                    <svg xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 384 512">
                        <path
                            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
                        </path>
                    </svg>
                </button>
                <button class="swiper-button swiper-button-next" aria-label="Наступний слайд"><svg
                        xmlns="http://www.w3.org/2000/svg" height="32" width="32" viewBox="0 0 384 512">
                        <path
                            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
                        </path>
                    </svg>
                </button>
            </div>
            </div>
            <?php
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