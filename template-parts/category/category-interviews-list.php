<div class="categories__block interview">
    <?php if (have_posts()): ?>
        <div class="categories__list interview__list">
            <?php while (have_posts()):
                the_post(); ?>
                <div class="interview__item">
                    <div class="interview__video-container">
                        <?php
                        $content = get_the_content();

                        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^&\n]{11})/', $content, $matches);

                        $video_id = isset($matches[1]) ? esc_attr($matches[1]) : '';
                        ?>
                        <div class="youtube-placeholder" data-video-id="<?php echo $video_id; ?>">
                            <?php if ($video_id): ?>
                                <img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/maxresdefault.jpg" alt="Video Thumbnail">
                                <button class="youtube-play-button" aria-label="Відтворити відео">
                                    <svg style="width: 100px; height: 100px" viewBox="0 0 1024 1024" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M658.2 523.8l-151.9 87.7c-31.6 18.2-71-4.6-71-41V395c0-36.4 39.5-59.2 71-41l151.9 87.7c31.5 18.4 31.5 63.9 0 82.1z"
                                            fill="#025cc0" />
                                        <path
                                            d="M533.2 870c-217.2 0-394-176.7-394-394S316 82 533.2 82s394 176.7 394 394-176.8 394-394 394z m0-737.1C344 132.9 190.1 286.8 190.1 476S344 819.1 533.2 819.1 876.3 665.2 876.3 476 722.4 132.9 533.2 132.9z"
                                            fill="#025cc0" />
                                    </svg>
                                </button>
                            <?php else: ?>
                                <p>
                                    <?php
                                      echo pll__('Відео недоступне');
                                    ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a class="categories__link" href="<?php the_permalink(); ?>">
                        <h2 class="categories__title interview__title"><?php the_title(); ?>
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