<?php
/**
 * Template part for posts pagination.
 *
 * Location: /template-parts/loop/pagination.php
 *
 * @global WP_Query $wp_query
 */

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
    return;
}

$next_link = get_next_posts_link( __( 'Older Posts', 'our-family-passport' ) );
$prev_link = get_previous_posts_link( __( 'Newer Posts', 'our-family-passport' ) );

if ( ! $prev_link && ! $next_link ) {
    return;
}
?>

<nav class="navigation posts-navigation" aria-label="<?php esc_attr_e( 'Posts navigation', 'our-family-passport' ); ?>">
    <div class="nav-links">
        <?php if ( $prev_link ) : ?>
            <div class="nav-previous"><?php echo wp_kses_post( $prev_link ); ?></div>
        <?php endif; ?>
        <?php if ( $next_link ) : ?>
            <div class="nav-next"><?php echo wp_kses_post( $next_link ); ?></div>
        <?php endif; ?>
    </div>
</nav>