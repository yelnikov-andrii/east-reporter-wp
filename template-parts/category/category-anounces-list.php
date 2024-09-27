<?php if (have_posts()): ?>
    <div class="anounces__list">
        <?php while (have_posts()):
            the_post(); ?>

            <a class="anounces__item" href="<?php the_permalink(); ?>">
                <div class="anounces__overlay"></div>

                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" class="anounces__img" />
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-image.png" alt="Default image"
                        class="anounces__img" />
                <?php endif; ?>

                <h2 class="anounces__title"><?php the_title(); ?></h2>
            </a>

        <?php endwhile; ?>
    </div>
<?php endif; ?>
<nav class="pagination categories__pagination">
    <?php
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('&laquo; Назад'),
        'next_text' => __('Вперед &raquo;'),
    ));
    ?>
</nav>