<?php
/*
Template Name: About us
*/
?>

<?php get_header(); ?>

<main class="about">
    <div class="container">
        <h1 class="about__h1 h1">
            <?php echo get_the_title($page_id); ?>
        </h1>
        <div class="about__content">
            <?php echo the_content(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>