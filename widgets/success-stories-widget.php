<?php
/**
 * Success Stories Widget
 *
 * @package our-family-passport
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Success Stories Widget Class
 */
class Success_Stories_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'success_stories_widget', // Base ID
            __('Success Stories Widget', 'our-family-passport'), // Name
            array('description' => __('Display success stories testimonials in a widget area', 'our-family-passport')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
    // Skip the before_widget to avoid extra div wrapping

    ofp_set_widget_mode( true );

    if (file_exists(get_theme_file_path("/custom-blocks/success-stories/success-stories-template.php"))) {
        include(get_theme_file_path("/custom-blocks/success-stories/success-stories-template.php"));
    }

    ofp_set_widget_mode( false );

    // Skip the after_widget to avoid extra div wrapping
}

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        echo '<p>' . __('Configure this widget in the ACF options page.', 'our-family-passport') . '</p>';
        echo '<p><a href="' . admin_url('admin.php?page=acf-options-success-stories') . '">' . __('Go to Widget Settings', 'our-family-passport') . '</a></p>';
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        return $instance;
    }
}