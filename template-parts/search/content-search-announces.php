<article class="categories__item">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', ['class' => 'categories__img search__img']); ?>
    <?php endif; ?>
    <div class="categories__description">
        <a class="categories__link" href="<?php the_permalink(); ?>">
            <h2 class="categories__title">
                <?php the_title(); ?>
                anounces
            </h2>
        </a>
    </div>
</article>