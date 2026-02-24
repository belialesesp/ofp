<?php
/**
 * Favorite Cards Widget
 *
 * @package our-family-passport
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Favorite Cards Widget
 */
function register_favorite_cards_widget() {
    register_widget('Favorite_Cards_Widget');
}
add_action('widgets_init', 'register_favorite_cards_widget');

/**
 * Favorite Cards Widget Class
 */
class Favorite_Cards_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'favorite_cards_widget', // Base ID
            __('Favorite Cards Widget', 'our-family-passport'), // Name
            array('description' => __('Display your favorite credit cards in the sidebar', 'our-family-passport')) // Args
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
        
        // Flag this as a widget
        // This is critical - it tells the template to use widget mode
        update_field('is_widget', true);
        
        // Add a unique wrapper class for easier targeting
        echo '<div class="favorite-cards-widget-wrapper">';
        
        // Include the template file
        if (file_exists(get_theme_file_path("/custom-blocks/favorite-cards/favorite-cards-template.php"))) {
            // Also make instance data available to the template
            global $favorite_cards_widget_instance;
            $favorite_cards_widget_instance = $instance;
            
            include(get_theme_file_path("/custom-blocks/favorite-cards/favorite-cards-template.php"));
            
            // Clean up
            unset($GLOBALS['favorite_cards_widget_instance']);
        }
        
        echo '</div>';
        
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        // Default values
        $defaults = array(
            'title_line_1' => '',
            'title_line_2' => '',
            'cards' => array()
        );
        $instance = wp_parse_args($instance, $defaults);
        
        // Get the card options
        $card_options = array();
        $all_cards = get_field('credit_cards', 'option');
        if (is_array($all_cards)) {
            foreach ($all_cards as $key => $card) {
                if (isset($card['cci_card_name'])) {
                    $card_options[$key] = $card['cci_card_name'];
                }
            }
        }
        
        // Title line 1
        echo '<p>';
        echo '<label for="' . $this->get_field_id('title_line_1') . '">' . __('Title (Line 1):', 'our-family-passport') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('title_line_1') . '" name="' . $this->get_field_name('title_line_1') . '" type="text" value="' . esc_attr($instance['title_line_1']) . '">';
        echo '</p>';
        
        // Title line 2
        echo '<p>';
        echo '<label for="' . $this->get_field_id('title_line_2') . '">' . __('Title (Line 2):', 'our-family-passport') . '</label>';
        echo '<input class="widefat" id="' . $this->get_field_id('title_line_2') . '" name="' . $this->get_field_name('title_line_2') . '" type="text" value="' . esc_attr($instance['title_line_2']) . '">';
        echo '</p>';
        
        // Card selection
        echo '<p>' . __('Select Cards:', 'our-family-passport') . '</p>';
        echo '<div style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">';
        
        // Only show options if we have card data
        if (!empty($card_options)) {
            foreach ($card_options as $key => $name) {
                $checked = in_array($key, (array)$instance['cards']) ? 'checked="checked"' : '';
                echo '<p>';
                echo '<input type="checkbox" id="' . $this->get_field_id('cards') . '_' . $key . '" name="' . $this->get_field_name('cards') . '[]" value="' . esc_attr($key) . '" ' . $checked . '>';
                echo '<label for="' . $this->get_field_id('cards') . '_' . $key . '">' . esc_html($name) . '</label>';
                echo '</p>';
            }
        } else {
            echo '<p>' . __('No cards found in options. Please set up credit cards first.', 'our-family-passport') . '</p>';
        }
        
        echo '</div>';
        
        // Link to ACF options page
        echo '<p><a href="' . admin_url('admin.php?page=acf-options') . '" target="_blank">' . __('Edit Card Options', 'our-family-passport') . '</a></p>';
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
        
        $instance['title_line_1'] = (!empty($new_instance['title_line_1'])) ? sanitize_text_field($new_instance['title_line_1']) : '';
        $instance['title_line_2'] = (!empty($new_instance['title_line_2'])) ? sanitize_text_field($new_instance['title_line_2']) : '';
        $instance['cards'] = (!empty($new_instance['cards'])) ? array_map('sanitize_text_field', $new_instance['cards']) : array();
        
        return $instance;
    }
}