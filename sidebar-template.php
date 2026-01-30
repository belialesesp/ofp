<?php
/**
 * Sidebar Template
 * 
 * Displays the sidebar in a consistent manner across both posts and pages
 */

// Make sure this is only included once
if (!function_exists('display_consistent_sidebar')) {
    function display_consistent_sidebar($context = '') {
        // Check if current post/page has a sidebar block
        if (is_singular() && has_sidebar_block(get_the_ID())) {
            // Add sidebar-block body class but don't display the widget sidebar
            add_filter('body_class', function($classes) {
                if (is_page()) {
                    $classes[] = 'has-page-sidebar-block';
                } else {
                    $classes[] = 'has-post-sidebar-block';
                }
                $classes[] = 'has-sidebar-block';
                return $classes;
            });
            
            return; // Don't display the sidebar widget if there's a sidebar block
        }
        
        // Determine which sidebar to use based on context
        $sidebar_id = 'sidebar-1'; // Default
        $sidebar_class = '';
        
        if (is_singular('post') && is_active_sidebar('post-sidebar')) {
            $sidebar_id = 'post-sidebar';
            $sidebar_class = 'post-sidebar-widget';
        } elseif (is_page() && is_active_sidebar('page-sidebar')) {
            $sidebar_id = 'page-sidebar';
            $sidebar_class = 'page-sidebar-widget';
        } elseif (!empty($context) && is_active_sidebar($context)) {
            $sidebar_id = $context;
        }
        
        // Add a body class to indicate the sidebar is active
        add_filter('body_class', function($classes) use ($sidebar_id) {
            if (is_page()) {
                $classes[] = 'has-page-sidebar';
            } else {
                $classes[] = 'has-post-sidebar';
            }
            $classes[] = 'has-sidebar';
            return $classes;
        });
        
        // Check if the sidebar is active
        if (is_active_sidebar($sidebar_id)) {
            ?>
            <aside class="sidebar sidebar-<?php echo esc_attr($sidebar_id); ?> <?php echo esc_attr($sidebar_class); ?>">
                <?php dynamic_sidebar($sidebar_id); ?>
            </aside>
            <?php
        }
    }
}