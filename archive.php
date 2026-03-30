<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package our-family-passport
 */

get_header();
?>

<main id="primary" class="site-main archives-page container">

    <?php if ( have_posts() ) : ?>

        <?php get_template_part( 'template-parts/page-header' ); ?>

        <div class="archive-posts">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/loop/archive-post' ); ?>
            <?php endwhile; ?>
        </div>

        <?php get_template_part( 'template-parts/loop/pagination' ); ?>

    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>