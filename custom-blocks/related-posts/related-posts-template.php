<?php
/**
 * Related Posts Block Template
 * Location: /custom-blocks/related-posts/related-posts-template.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_title      = get_field( 'title' )              ?: 'Other posts you may like';
$section_icon       = get_field( 'image' );
$posts_number       = (int) ( get_field( 'posts_number' ) ?: 3 );
$selection_criteria = get_field( 'selection_criteria' ) ?: 'category';
$order_by           = get_field( 'order_by' )           ?: 'date';

$current_id    = get_the_ID();
$related_posts = ofp_get_related_posts( $current_id, $posts_number, $selection_criteria, $order_by );
?>

<div class="related-posts-auto-block">
    <div class="related-posts-auto-block-container container">
        <div class="related-posts-header">
            <h3 class="related-posts-title">
                <?php echo esc_html( $section_title ); ?>
            </h3>
            <?php if ( $section_icon ) : ?>
                <img src="<?php echo esc_url( $section_icon['url'] ); ?>"
                     alt="<?php echo esc_attr( $section_icon['alt'] ); ?>"
                     class="section-icon">
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $related_posts ) ) : ?>
            <div class="related-posts-grid">
                <?php foreach ( $related_posts as $post ) :
                    global $post;
                    setup_postdata( $post ); ?>
                    <article class="related-post-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="related-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="related-post-content">
                            <?php $categories = get_the_category();
                            if ( $categories ) : ?>
                                <div class="related-post-category">
                                    <p><?php echo esc_html( $categories[0]->name ); ?></p>
                                </div>
                            <?php endif; ?>

                            <h4 class="related-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        </div>
                    </article>
                <?php endforeach;
                wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <p>No related posts found.</p>
        <?php endif; ?>
    </div>
</div>