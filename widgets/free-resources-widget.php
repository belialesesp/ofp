<?php
/**
 * Free Resources Widget
 *
 * @package our-family-passport
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Free Resources Widget Class
 */
class Free_Resources_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'free_resources_widget', // Base ID
            __('Free Resources Widget', 'our-family-passport'), // Name
            array('description' => __('Display free resources in a widget area', 'our-family-passport')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        ofp_set_widget_mode( true );

        if (file_exists(get_theme_file_path("/custom-blocks/free-resources/free-resources-template.php"))) {
            include(get_theme_file_path("/custom-blocks/free-resources/free-resources-template.php"));
        }

        ofp_set_widget_mode( false );

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        echo '<p>' . __('Configure this widget in the ACF options page.', 'our-family-passport') . '</p>';
        echo '<p><a href="' . admin_url('admin.php?page=acf-options-free-resources') . '">' . __('Go to Widget Settings', 'our-family-passport') . '</a></p>';
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