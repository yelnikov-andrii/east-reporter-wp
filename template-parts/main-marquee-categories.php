<nav class="main-marquee">
    <ul class="main-marquee__content">
        <?php
        $parent_category = get_category_by_slug('news');
        if ($parent_category) {
            // Получаем подкатегории категории "news"
            $subcategories = get_categories(array(
                'child_of' => $parent_category->term_id, // ID родительской категории
                'hide_empty' => false, // Показывать пустые категории или нет
                'orderby' => 'name',
                'order' => 'ASC',
                'number' => 8
            ));
        }
        ?>
        <?php foreach ($subcategories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php foreach ($subcategories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <ul aria-hidden="true" class="main-marquee__content">
        <?php foreach ($subcategories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
        <?php foreach ($subcategories as $category): ?>
            <li class="dropdown__item">
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="main-marquee__link">
                    <?php echo esc_html($category->name); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>