<?php
/**
 * Template part for displaying a page header (title area).
 *
 * Location: /template-parts/page-header.php
 *
 * Usage:
 *   get_template_part( 'template-parts/page-header' );
 *
 * To pass a custom title:
 *   set_query_var( 'ofp_page_header_title', 'My Custom Title' );
 *   get_template_part( 'template-parts/page-header' );
 */

// Allow a custom title to be injected via set_query_var()
$custom_title = get_query_var( 'ofp_page_header_title', '' );
?>

<header class="page-header">
    <?php if ( $custom_title ) : ?>
        <h1 class="page-title"><?php echo wp_kses_post( $custom_title ); ?></h1>

    <?php elseif ( is_search() ) : ?>
        <h1 class="page-title">
            <?php
            printf(
                /* translators: %s: search query */
                esc_html__( 'Search Results for: %s', 'our-family-passport' ),
                '<span>' . esc_html( get_search_query() ) . '</span>'
            );
            ?>
        </h1>

    <?php elseif ( is_archive() ) : ?>
        <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
        <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

    <?php elseif ( is_404() ) : ?>
        <h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'our-family-passport' ); ?></h1>

    <?php else : ?>
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    <?php endif; ?>
</header><!-- .page-header -->