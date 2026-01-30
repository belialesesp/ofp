<section class="enchanted-link">

    <?php if (get_field('pre_title')) : ?>
        <p class="pre-title"><?php the_field('pre_title'); ?></p>
    <?php endif; ?>

    <?php if (get_field('title')) : ?>
        <h2 class="section-title"><?php the_field('title'); ?></h2>
    <?php endif; ?>

    <?php if (get_field('description')) : ?>
        <p class="section-description"><?php the_field('description'); ?></p>
    <?php endif; ?>

    <?php if (have_rows('links')) : ?>
        <div class="links-grid">
            <?php while (have_rows('links')) : the_row(); 
                $link_title = get_sub_field('link_title');
                $link_url = get_sub_field('link_url');
                $link_number = get_sub_field('link_number');
                $link_color = get_sub_field('link_color');
            ?>
                <div class="link-item">
                    <?php if ($link_url) : ?>
                        <a href="<?php echo esc_url($link_url); ?>">
                    <?php endif; ?>

                        <div class="link-content">
                            <h3 class="link-title"><?php echo esc_html($link_title); ?></h3>
                            <?php if ($link_number) : ?>
                                <span class="link-number" style="color: <?php echo esc_attr($link_color); ?>">
                                    <?php echo esc_html($link_number); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                    <?php if ($link_url) : ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

</section>