<div class="categories__block">
    <?php
    function get_reading_time($content)
    {
        $cleaned_content = strip_tags($content);
        $word_count = preg_match_all('/\b\w+\b/u', $cleaned_content, $matches);
        $reading_time = ceil($word_count / 250);
        return max($reading_time, 1);
    }
    ?>
    <?php if (have_posts()): ?>
        <div class="categories__list">
            <?php while (have_posts()):
                the_post(); ?>
                <?php
                get_template_part('template-parts/category/category-item');
                ?>
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