<nav class="categories__breadcrumbs">
    <a href="/" class="categories__link categories__link--breadcrumbs">
        На головну
    </a>
    <svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
        fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
    </svg>

    <?php
    // Получаем текущую категорию
    $current_category = get_queried_object();

    if ($current_category) {
        // Проверяем, есть ли у категории родительские категории
        $parent_ids = [];
        $parent_category = $current_category->parent;

        // Получаем всех родительских категорий
        while ($parent_category) {
            $parent = get_category($parent_category);
            if ($parent) {
                $parent_ids[] = $parent; // Добавляем родительскую категорию в массив
                $parent_category = $parent->parent; // Переходим к следующему родителю
            } else {
                break;
            }
        }

        // Если есть родительские категории, выводим их в виде ссылок
        if (!empty($parent_ids)) {
            foreach (array_reverse($parent_ids) as $parent) {
                $link = get_category_link($parent->term_id);
                echo '<a href="' . esc_url($link) . '" class="categories__link categories__link--breadcrumbs">' . esc_html($parent->name) . '</a> ';
                echo '<svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
        fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
    </svg>';
            }
        }

        // Выводим текущую категорию
        echo '<span class="categories__span">' . esc_html($current_category->name) . '</span>';
    }
    ?>
</nav>