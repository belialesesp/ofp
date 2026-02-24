<?php
/**
 * Block: Automatic Related Posts
 */

// Don't show placeholder in admin - let ACF fields show
// ACF will automatically display the fields for editing

// Get block settings from ACF fields
$section_title = get_field('title') ?: 'Related Posts';
$section_icon = get_field('image');
$posts_number = get_field('posts_number') ?: 3;
$selection_criteria = get_field('selection_criteria') ?: 'category';
$order_by = get_field('order_by') ?: 'rand';

// Current post ID
$current_post_id = get_the_ID();

// If not a post on frontend, don't show anything
if (!is_admin() && (!$current_post_id || get_post_type($current_post_id) !== 'post')) {
    return;
}

// Only show the actual block on frontend, not in admin
if (!is_admin()) {
    // Prepare query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_number,
        'post__not_in' => array($current_post_id),
        'orderby' => $order_by,
        'post_status' => 'publish',
    );

    // Define selection criteria
    switch ($selection_criteria) {
        case 'category':
            $categories = get_the_category($current_post_id);
            if ($categories) {
                $category_ids = array();
                foreach($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                $args['category__in'] = $category_ids;
            }
            break;
            
        case 'tag':
            $tags = get_the_tags($current_post_id);
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $tag) {
                    $tag_ids[] = $tag->term_id;
                }
                $args['tag__in'] = $tag_ids;
            }
            break;
            
        case 'both':
            $categories = get_the_category($current_post_id);
            $tags = get_the_tags($current_post_id);
            
            $tax_query = array('relation' => 'OR');
            
            if ($categories) {
                $category_ids = array();
                foreach($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                $tax_query[] = array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $category_ids,
                );
            }
            
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $tag) {
                    $tag_ids[] = $tag->term_id;
                }
                $tax_query[] = array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'term_id',
                    'terms'    => $tag_ids,
                );
            }
            
            if (count($tax_query) > 1) {
                $args['tax_query'] = $tax_query;
            }
            break;
    }

    // Execute query
    $related_posts = new WP_Query($args);

    if ($related_posts->have_posts()): ?>
        <div class="related-posts-auto-block">
            <div class="related-posts-auto-block-container container">
                <div class="related-posts-header">
                    <h3 class="related-posts-title">
                        <?php echo esc_html($section_title); ?>
                    </h3>
                    <?php if ($section_icon): ?>
                        <img src="<?php echo esc_url($section_icon['url']); ?>" 
                             alt="<?php echo esc_attr($section_icon['alt']); ?>" 
                             class="section-icon">
                    <?php endif; ?>
                </div>
                <div class="related-posts-grid">
                    <?php while ($related_posts->have_posts()): 
                        $related_posts->the_post(); ?>
                        <article class="related-post-item">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="related-post-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="related-post-content">
                                <?php 
                                $categories = get_the_category();
                                if ($categories): ?>
                                    <div class="related-post-category">
                                        <p><?php echo esc_html($categories[0]->name); ?></p>
                                    </div>
                                <?php endif; ?>
                                
                                <h4 class="related-post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php else: ?>
        <div class="related-posts-auto-block">
            <div class="related-posts-auto-block-container container">
                <div class="related-posts-header">
                    <h3 class="related-posts-title">
                        <?php if ($section_icon): ?>
                            <img src="<?php echo esc_url($section_icon['url']); ?>" 
                                 alt="<?php echo esc_attr($section_icon['alt']); ?>" 
                                 class="section-icon">
                        <?php endif; ?>
                        <?php echo esc_html($section_title); ?>
                    </h3>
                </div>
                <p>No related posts found.</p>
            </div>
        </div>
    <?php endif;
}
?>

<style>
.related-posts-auto-block {
    background: #F7F0E5;
    padding: 3rem 0;
}
.related-posts-auto-block-container {
    display: flex;
    flex-direction: column;
}

.related-posts-header{
    display: flex;
    gap: 1rem;
    align-items: center;
}
.related-posts-title {
    font-size: 2.5rem;
}
.related-post-thumb a img {
    height: 103px;
    width: 103px;
    min-width: 103px;
    border-radius: 50%;
    object-fit: cover;
    aspect-ratio: 1 / 1;
}
.related-post-item {
    display: flex;
    gap: 2rem;
    align-items: center;
    padding: 2rem 0;
    border-bottom: 1px solid #F0A9AD;
    max-width: 750px;
}

.related-post-item:last-child {
    border-bottom: none;
}
.related-post-category p{
    margin: 0;
    color: #F0A9AD;
    font-family: "GlacialIndifference";
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 28.8px; /* 180% */
    text-transform: uppercase;
}
.related-post-item:nth-child(2) .related-post-category p {
    color: #9BBFCD !important;
}
.related-post-title a {
    color: #222;
    font-family: "GlacialIndifference";
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 26.4px; /* 146.667% */
    text-decoration: none;
}
</style>