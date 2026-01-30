<?php
/**
 * The sidebar containing the main widget area
 *
 * @package our-family-passport
 */

// Enhanced detection of sidebar blocks in content
function enhanced_has_sidebar_block($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    // Get the content
    $post = get_post($post_id);
    if (!$post) return false;
    
    $content = $post->post_content;
    
    // Check for specific block patterns
    $block_patterns = [
        'wp:acf/sidebar-block',
        'wp:core/sidebar',
        'sidebar-block-wrapper',
        'class="unique-card"',
        'class="free-resources"',
        'class="extra-benefits"',
        'class="success-stories"'
    ];
    
    foreach ($block_patterns as $pattern) {
        if (strpos($content, $pattern) !== false) {
            return true;
        }
    }
    
    return false;
}

// Early check for sidebar block to prevent widget sidebar display when block exists
if (is_singular() && enhanced_has_sidebar_block(get_the_ID())) {
    // Add body classes but don't display the sidebar
    add_filter('body_class', function($classes) {
        if (is_page()) {
            $classes[] = 'has-page-sidebar-block';
        } else {
            $classes[] = 'has-post-sidebar-block';
        }
        $classes[] = 'has-sidebar-block';
        $classes[] = 'no-widget-sidebar';
        return $classes;
    });
    
    // Exit early - do not display the sidebar widget
    return;
}

// Include the sidebar template
require_once get_template_directory() . '/sidebar-template.php';

// Display the appropriate sidebar
display_consistent_sidebar();