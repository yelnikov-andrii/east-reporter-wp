<?php
if (isset($args['category_slug'])) {
    $category_slug = $args['category_slug'];
}
?>

<div class="swiper-wrapper">
    <?php
    // Параметры запроса WP_Query для постов из категории
    $args = array(
        'category_name' => $category_slug, // Слаг категории
        'posts_per_page' => 9,         // Количество постов для отображения
    );

    $query = new WP_Query($args);

    // Проверяем, есть ли посты в категории
    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>
            <?php
            $thumbnail_url = get_the_post_thumbnail_url();
            ?>
            <article
                class="<?php echo $thumbnail_url ? 'main-news__article swiper-slide' : 'main-news__article swiper-slide main-news__article--no-image'; ?>">
                <?php
                if ($thumbnail_url): ?>
                    <img src="<?php echo esc_url($thumbnail_url); ?>" class="main-news__img" alt="<?php the_title(); ?>" />
                <?php else: ?>
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/default-image.png" class="main-news__img"
                        alt="Default image" />
                <?php endif; ?>

                <div>
                    <h3 class="main-news__h3">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <div class="main-news__description">
                        <p class="main-news__category-list"><?php echo get_the_category_list('<span>,</span> '); ?></p>
                        <p><?php the_author(); ?></p>
                        <p><?php the_date(); ?></p>
                    </div>
                </div>
            </article>

        <?php endwhile;
        wp_reset_postdata(); // Сбрасываем глобальные данные поста
    else: ?>
        <p>Пости відсутні</p>
    <?php endif; ?>
</div>