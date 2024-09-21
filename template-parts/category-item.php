<?php
// Файл: template-parts/category-item.php
?>

<article class="categories__item">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', ['class' => 'categories__img']); ?>
    <?php endif; ?>

    <div class="categories__description">
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