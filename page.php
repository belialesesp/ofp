<?php
get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();

        if (is_page('privacy-policy') || is_page('terms-of-use')) {
            echo '<div class="container">';
        }

        get_template_part('template-parts/content', 'page');

        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

        if (is_page('privacy-policy') || is_page('terms-of-use')) {
            echo '</div>';
        }

    endwhile;
    ?>
</main>

<?php
get_sidebar();
get_footer();