<?php
/**
 * Template for displaying single Credit Card posts
 *
 * @package our-family-passport
 */

get_header();
?>

<main id="primary" class="site-main credit-card-single">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        
    <?php endwhile; ?>
</main>

<?php
get_footer();