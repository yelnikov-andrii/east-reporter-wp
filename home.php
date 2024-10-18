<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<main class="main">
    <section class="main-top">
        <div class="container top__container">
            <div class="main-top__search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
        <div class="main-top__block">
            <div class="main-top__banner">
                <?php
                $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';

                // Задаем slugs для категорий на разных языках
                $category_slugs = array(
                    'interview' => array(
                        'uk' => 'interview',      // Украинский
                        'en' => 'interview-en',     // Английский
                        'de' => 'interview-de'      // Немецкий (пример)
                    )
                );

                $interview_slug = isset($category_slugs['interview'][$current_lang]) ? $category_slugs['interview'][$current_lang] : $category_slugs['interview']['uk'];

                $interview_posts = get_posts(array(
                    'category_name' => $interview_slug, // Используем slug для текущего языка
                    'posts_per_page' => -1, // Получаем все посты категории
                    'orderby' => 'rand',    // Сортировка случайным образом
                ));

                if ($interview_posts) {
                    $random_post = $interview_posts[0];

                    $random_post_content = $random_post->post_content;

                    preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $random_post_content, $matches);

                    $video_id = isset($matches[1]) ? esc_attr($matches[1]) : '';
                }
                ?>
                <div class="youtube-placeholder" data-video-id="<?php echo $video_id; ?>">
                    <?php if ($video_id): ?>
                        <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/maxresdefault.jpg"
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
            $current_lang = pll_current_language();
            $category_slug = ($current_lang === 'en') ? 'news-en' : (($current_lang === 'de') ? 'news-de' : 'news');
            $news_query = new WP_Query(array(
                'post_type' => 'post',
                'category_name' => $category_slug
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
    </section>

    <?php
    get_template_part('template-parts/main/main-marquee-categories');
    ?>

    <section class="main-news">
        <div class="container">
            <?php
            $current_lang = pll_current_language();
            $news_slug = ($current_lang === 'en') ? 'news-en' : (($current_lang === 'de') ? 'news-de' : 'news');
            $category = get_category_by_slug($news_slug);
            $categories = get_categories(array(
                'child_of' => $category->term_id,
                'orderby' => 'count',
                'order' => 'DESC'
            ));
            $coefficient = 1;

            foreach ($categories as $category):

                if ($coefficient > 3)
                    break;
                ?>


                <h2 class="main-news__title" data-aos="fade-up">
                    <?php echo esc_html($category->name); ?>
                </h2>

                <div class="swiper-news-<?php echo $coefficient; ?> main-news__block main-news__block--margin"
                    data-aos="fade-up">
                    <?php
                    $category_slug = $category->slug;
                    get_template_part('template-parts/main/main-news-block', null, array('category_slug' => $category_slug));
                    ?>
                </div>

                <?php
                $coefficient++;
            endforeach;

            ?>
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
                        <?php
                        echo pll__('Новини');
                        ?>
                    </h2>

                    <ul class="main-important__list">
                        <?php
                        $current_lang = pll_current_language();
                        $news_slug = ($current_lang === 'en') ? 'news-en' : (($current_lang === 'de') ? 'news-de' : 'news');
                        $parent_category = get_category_by_slug($news_slug);
                        if ($parent_category) {
                            // Получаем подкатегории категории "news"
                            $subcategories = get_categories(array(
                                'child_of' => $parent_category->term_id, // ID родительской категории
                                'hide_empty' => true, // Показывать пустые категории или нет
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
                    <?php
                    if (function_exists('pll_current_language')) {
                        // В зависимости от текущего языка выводим соответствующий текст
                        if ($current_lang === 'en') {
                            echo 'Stay informed<br /> about all news from<br /><span class="main-important__span">East Reporter</span>';
                        } elseif ($current_lang === 'de') {
                            echo 'Bleiben Sie informiert<br /> über alle Nachrichten von<br /><span class="main-important__span">East Reporter</span>';
                        } else {
                            // По умолчанию, например, для украинского языка
                            echo 'Будьте в курсі<br /> всіх новин з<br /><span class="main-important__span">East Reporter</span>';
                        }
                    } else {
                        // Если функция не существует, по умолчанию
                        echo 'Будьте в курсі<br /> всіх новин з<br /><span class="main-important__span">East Reporter</span>';
                    }
                    ?>
                </h5>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>