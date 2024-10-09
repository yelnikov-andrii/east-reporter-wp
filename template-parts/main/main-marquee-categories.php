<nav class="main-marquee">
    <ul class="main-marquee__content">
        <?php
        $categories = get_categories(array(
            'parent'=> '0',
            'hide_empty' => true
        ));
        ?>
        <?php foreach ($categories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php foreach ($categories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul aria-hidden="true" class="main-marquee__content">
        <?php foreach ($categories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php foreach ($categories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>