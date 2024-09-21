<?php
/*
Template Name: About us
*/
?>

<?php get_header(); ?>

<?php
$page_slug = 'pro-nas'; // Слаг страницы
$page_data = get_page_by_path($page_slug);
$content = apply_filters('the_content', $page_data->post_content); // Получаем контент страницы с фильтрацией
?>

<main class="about">
    <div class="container">
        <h1 class="about__h1 h1">
            <?php echo get_the_title($page_id); ?>
        </h1>
        <div class="about__content">
            <?php echo $content; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>