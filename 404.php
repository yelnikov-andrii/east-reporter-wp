<?php
get_header(); ?>

<section class="error">
    <div class="container">
        <h1 class="error__h1 h1"><?php echo pll__('Сторінка не знайдена'); ?></h1>
        <a class="categories__description-link error__link" href="<?php echo home_url(); ?>"><?php echo pll__('Головна сторінка'); ?></a>
    </div>
</section>

<?php
get_footer();
