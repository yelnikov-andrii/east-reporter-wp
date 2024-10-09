<?php
// Файл: template-parts/category-item.php
?>

<article class="categories__item">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', ['class' => 'categories__img']); ?>
    <?php endif; ?>

    <div class="categories__description">
        <div class="categories__description-wrapper-categories">
            <div class="categories__description-categories">
                <?php
                $categories = get_the_category(); // Получаем массив категорий для текущего поста
                if ($categories) {
                    foreach ($categories as $category) {
                        // Вывод ссылки на категорию с названием категории
                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="categories__description-link">';
                        echo esc_html($category->name);
                        echo '</a>';
                    }
                }
                ?>
            </div>
            <div class="categories__reading-time">
                <svg fill="#ffffff" height="16px" width="16px" version="1.1" id="Capa_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 489.42 489.42" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M46.1,138.368c4.2,2.1,16.1,8.4,29.1-6.2c5.2-7.3,10.4-14.6,16.6-21.8c7.3-8.3,6.2-21.8-2.1-29.1
            c-8.3-7.3-21.8-6.2-29.1,2.1s-14.6,17.7-20.8,27C33.7,119.668,36.8,132.068,46.1,138.368z" />
                            <path d="M249,40.568c19.8,0,39.5,3.1,58.3,9.4c12.6,3.7,21.8-4.2,26-12.5c3.1-11.4-3.1-22.9-13.5-26
            c-22.9-7.3-45.8-11.4-69.7-11.4c-11.4,0-20.8,8.3-20.8,19.8S237.6,40.568,249,40.568z" />
                            <path d="M434.2,167.468c7.3,17.7,11.4,36.4,13.5,55.1c0,0,1.2,23.2,22.9,19.8c21.5-2.8,18.7-23.9,18.7-23.9
            c-2.1-22.9-8.3-45.8-16.6-66.6c-5.2-10.4-16.6-15.6-27-11.4C435.2,145.668,430,157.068,434.2,167.468z" />
                            <path d="M359.3,75.968c16.6,11.4,31.2,25,43.7,40.6c9.3,11.6,25,6.8,28.1,3.1c8.3-7.3,10.4-20.8,3.1-29.1
            c-14.6-17.7-32.3-34.3-52-47.9c-9.4-6.2-21.8-4.2-28.1,5.2S349.9,69.668,359.3,75.968z" />
                            <path d="M134.6,72.768c16.6-10.4,35.4-18.7,54.1-23.9c11.4-3.1,17.7-14.6,14.6-25c-3.1-11.4-14.6-17.7-25-14.6
            c-22.9,6.2-44.7,15.6-64.5,28.1c-9.4,6.2-12.5,18.7-6.2,28.1C111.7,71.768,120.5,77.968,134.6,72.768z" />
                            <path d="M468.5,268.368c-11.4-3.1-21.8,4.2-23.9,15.6c-2.1,9.4-8.5,31.3-8.6,33.4c-27.5,71.5-93.5,121.8-169.3,129.9
            c-74.6,7.8-147.2-25.9-189.3-86.5l38.5,8.5c10.4,2.1,21.8-4.2,23.9-15.6c2.1-10.4-4.2-21.8-15.6-23.9l-81.1-17.7
            c-5.2-1-21.4,0-25,15.6l-17.7,82.2c-2.1,10.4,4.2,21.8,15.6,23.9c12.7,1.3,21.8-6.2,25-16.6l6.2-28.2
            c46.3,62.7,129.9,109.1,223.7,99c94.6-10.2,174.8-73.9,206-163.3c1-2.6,5.7-24.4,7.3-32.3
            C487.3,280.868,480,270.468,468.5,268.368z" />
                            <path d="M164.6,265.268h95.9c11.4,0,19.8-9.4,20.8-20.8v-142.2c0-11.4-9.4-20.8-20.8-20.8c-11.4,0-20.8,9.4-20.8,20.8v121.4h-75.1
            c-11.4,0-20.8,9.4-20.8,20.8S153.1,265.268,164.6,265.268z" />
                        </g>
                    </g>
                </svg>
                <?php
                    $article_content = get_the_content();
                    $reading_time_res = get_reading_time($article_content);
                    $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'uk';
                    $minutes = ' min.';
                    if ($current_lang == 'uk') $minutes = ' хв.';
                    
                    echo "" . $reading_time_res . $minutes;
                ?>
            </div>
        </div>
        <a class="categories__link" href="<?php the_permalink(); ?>">
            <h2 class="categories__title"><?php the_title(); ?></h2>
        </a>
        <div class="categories__description-bottom-block">
            <h3 class="categories__p"><?php the_author(); ?></h3>
            <p class="categories__date">
                <?php echo get_the_date(); ?>
            </p>
        </div>
    </div>
</article>