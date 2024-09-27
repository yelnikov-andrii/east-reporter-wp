<article class="categories__item">
    <?php the_content(); ?>
    <div class="categories__description">
        <a class="categories__link" href="<?php the_permalink(); ?>">
            <h2 class="categories__title">
                <?php the_title(); ?>
            </h2>
        </a>
    </div>
</article>