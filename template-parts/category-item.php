<?php
// Файл: template-parts/category-item.php
?>

<article class="news__item">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', ['class' => 'news__img']); ?>
    <?php endif; ?>

    <div class="news__description">
        <div class="news__description-categories">
            <?php
            $categories = get_the_category(); // Получаем массив категорий для текущего поста
            if ($categories) {
                foreach ($categories as $category) {
                    // Вывод ссылки на категорию с названием категории
                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="news__description-link">';
                    echo esc_html($category->name);
                    echo '</a>';
                }
            }
            ?>
        </div>
        <a class="news__link" href="<?php the_permalink(); ?>">
            <h2 class="news__title"><?php the_title(); ?></h2>
        </a>
        <div class="news__description-bottom-block">
            <h3 class="news__p"><?php the_author(); ?></h3>
            <p class="news__date">
                <?php echo get_the_date(); ?>
            </p>
        </div>
    </div>
</article>