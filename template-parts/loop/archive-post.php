<?php
/**
 * Template part for displaying a single post card in archive/loop contexts.
 *
 * Location: /template-parts/loop/archive-post.php
 */
?>

<div class="post">
    <div class="post__image">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>

    <?php the_title( '<h2 class="post__title">', '</h2>' ); ?>

    <a class="post__cta" href="<?php echo esc_url( get_permalink() ); ?>">
        <span><?php esc_html_e( 'Read Post', 'our-family-passport' ); ?></span>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <mask id="mask0_archive_post" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                <rect width="16" height="16" fill="#66B1BB" />
            </mask>
            <g mask="url(#mask0_archive_post)">
                <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="#66B1BB" />
            </g>
        </svg>
    </a>
</div>