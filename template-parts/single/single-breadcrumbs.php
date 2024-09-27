<nav class="categories-article__breadcrumbs">
            <a class="categories-article__link" href="/">
                На головну
            </a>
            <svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg>
            <?php
            $post_id = get_the_ID();
            $categories = get_the_category($post_id);
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    echo '<a class="categories-article__link" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                    echo '<svg class="categories__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                          </svg>';
                }
            }
            ?>
            <span>
                <?php
                the_title();
                ?>
            </span>
        </nav>