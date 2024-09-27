<article class="categories__item">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', ['class' => 'categories__img search__img']); ?>
    <?php endif; ?>

    <div class="categories__description">
        <div class="categories__description-categories">
            <?php
            $categories = get_the_category();
            if ($categories) {
                foreach ($categories as $category) {
                    echo '<a href="' . get_category_link($category->term_id) . '" class="categories__description-link">' . esc_html($category->name) . '</a>';
                }
            }
            ?>
        </div>
        <a class="categories__link" href="<?php the_permalink(); ?>">
            <h2 class="categories__title">
                <?php the_title(); ?>
            </h2>
        </a>
    </div>
    <?php
    ?>
</article>