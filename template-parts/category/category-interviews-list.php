<div class="categories__block interview">
    <?php if (have_posts()): ?>
        <div class="categories__list interview__list">
            <?php while (have_posts()):
                the_post(); ?>
                <div class="interview__item">
                    <div class="interview__video-container"><?php the_content(); ?></div>
                    <a class="categories__link" href="<?php the_permalink(); ?>">
                        <h2 class="categories__title"><?php the_title(); ?>
                        </h2>
                    </a>
                </div>
            <?php endwhile; ?>

            <nav class="pagination categories__pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Назад'),
                    'next_text' => __('Вперед &raquo;'),
                ));
                ?>
            </nav>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/common/aside'); ?>
</div>