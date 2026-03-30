<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package our-family-passport
 */

get_header();
?>

<main id="primary" class="site-main container">

    <?php if ( have_posts() ) : ?>

        <?php get_template_part( 'template-parts/page-header' ); ?>

        <div class="search-grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'search' ); ?>
            <?php endwhile; ?>
        </div>

        <?php get_template_part( 'template-parts/loop/pagination' ); ?>

    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

</main><!-- #main -->

<?php get_footer(); ?>