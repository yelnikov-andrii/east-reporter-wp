<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>

    <header class="header">
        <div class="container header__container">
            <nav class="header__nav nav">
                <a class="header__logo" href="/">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/logo.png" alt="Logo"
                        class="header__img" />
                </a>
                <div class="header__toggle">
                    <span class="header__toggle-span"></span>
                    <span class="header__toggle-span"></span>
                    <span class="header__toggle-span"></span>
                </div>
                <ul class="header__list header-list">
                    <li class="header-list__item">
                        <div class="header-list__wrapper-link">
                            <?php

                            $parent_category = get_category_by_slug('news');
                            if ($parent_category) {
                                $news_page_link = get_category_link($parent_category->term_id);
                            }
                            ?>
                            <a class="header-list__link" href="<?php echo esc_url($news_page_link); ?>">
                                Новини
                            </a>
                            <svg class="header-list__svg header-list__svg--plus" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>
                            <svg class="header-list__svg header-list__svg--minus" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14" />
                            </svg>

                        </div>
                        <?php
                        $parent_category = get_category_by_slug('news');
                        if ($parent_category) {
                            // Получаем подкатегории категории "news"
                            $subcategories = get_categories(array(
                                'child_of' => $parent_category->term_id, // ID родительской категории
                                'hide_empty' => false, // Показывать пустые категории или нет
                                'orderby' => 'name',
                                'order' => 'ASC'
                            ));
                        }
                        ?>
                        <ul class="dropdown">
                            <?php foreach ($subcategories as $category): ?>
                                <li class="dropdown__item">
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                                        class="header-list__link">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="header-list__item">
                        <a class="header-list__link" href="stories.html">
                            Історії
                        </a>
                    </li>
                    <li class="header-list__item">
                        <a class="header-list__link" href="interview.html">
                            Інтерв'ю
                        </a>
                    </li>
                    <li class="header-list__item">
                        <div class="header-list__wrapper-link">
                            <?php
                            $anounces_page_id = get_page_by_title('Anounces');
                            $anounces_page_link = get_permalink($anounces_page_id);
                            ?>
                            <a class="header-list__link" href="<?php echo $anounces_page_link; ?>">
                                Анонси
                            </a>
                            <svg class="header-list__svg header-list__svg--plus" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>
                            <svg class="header-list__svg header-list__svg--minus" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 12h14" />
                            </svg>
                        </div>
                        <ul class="dropdown">
                            <li class="dropdown__item">
                                <a href="#" class="header-list__link">Подкатегория 1.1</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="#" class="header-list__link">Подкатегория 1.2</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="#" class="header-list__link">Подкатегория 1.3</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="#" class="header-list__link">Подкатегория 1.3</a>
                            </li>
                            <li class="dropdown__item">
                                <a href="#" class="header-list__link">Подкатегория 1.3</a>
                            </li>
                            <li>
                                <a href="#" class="header-list__link">Подкатегория 1.3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="header-list__item">
                        <?php 
                         $contacts_slug = 'contacts';
                        ?>
                        <a class="header-list__link" href="<?php echo get_permalink(get_page_by_path($contacts_slug)); ?>">
                            Контакти
                        </a>
                    </li>
                    <li class="header-list__item">
                        <?php $about_slug = 'pro-nas' ?>
                        <a class="header-list__link" href="<?php echo get_permalink( get_page_by_path( $about_slug )) ?>">
                            Про нас
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>