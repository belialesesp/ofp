<?php
/**
 * Register all custom widgets
 *
 * @package our-family-passport
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Include individual widget class files
require_once get_template_directory() . '/widgets/favorite-cards-widget.php';
require_once get_template_directory() . '/widgets/success-stories-widget.php';
require_once get_template_directory() . '/widgets/free-resources-widget.php';
require_once get_template_directory() . '/widgets/lets-connect-widget.php';

/**
 * Register widgets with WordPress
 */
function register_all_custom_widgets() {
    register_widget('Favorite_Cards_Widget');
    register_widget('Success_Stories_Widget');
    register_widget('Free_Resources_Widget');
    register_widget('Lets_Connect_Widget');
}
add_action('widgets_init', 'register_all_custom_widgets');

/**
 * Register ACF Options Page for Widgets
 */
function register_widget_options_pages() {
    if (function_exists('acf_add_options_page')) {
        // Parent options page
        acf_add_options_page(array(
            'page_title'    => 'Widget Settings',
            'menu_title'    => 'Widget Settings',
            'menu_slug'     => 'widget-settings',
            'capability'    => 'edit_posts',
            'redirect'      => true
        ));
        
        // Sub-page for Favorite Cards Widget
        acf_add_options_sub_page(array(
            'page_title'    => 'Favorite Cards Widget',
            'menu_title'    => 'Favorite Cards',
            'parent_slug'   => 'widget-settings',
            'menu_slug'     => 'acf-options-favorite-cards'
        ));
        
        // Sub-page for Success Stories Widget
        acf_add_options_sub_page(array(
            'page_title'    => 'Success Stories Widget',
            'menu_title'    => 'Success Stories',
            'parent_slug'   => 'widget-settings',
            'menu_slug'     => 'acf-options-success-stories'
        ));
        
        // Sub-page for Free Resources Widget
        acf_add_options_sub_page(array(
            'page_title'    => 'Free Resources Widget',
            'menu_title'    => 'Free Resources',
            'parent_slug'   => 'widget-settings',
            'menu_slug'     => 'acf-options-free-resources'
        ));
        
        // Sub-page for Lets Connect Widget
        acf_add_options_sub_page(array(
            'page_title'    => 'Lets Connect Widget',
            'menu_title'    => 'Lets Connect',
            'parent_slug'   => 'widget-settings',
            'menu_slug'     => 'acf-options-lets-connect'
        ));
    }
}
add_action('acf/init', 'register_widget_options_pages');

// Include ACF field group definitions for widgets
$field_groups_dir = get_template_directory() . '/field-groups';
if (file_exists($field_groups_dir)) {
    $widget_field_files = array(
        '/favorite-cards-widget-fields.php',
        '/free-resources-widget-field.php',
        '/success-stories-widget-field.php',
        '/lets-connect-widget-field.php',
    );
    
    foreach ($widget_field_files as $field_file) {
        if (file_exists($field_groups_dir . $field_file)) {
            require_once $field_groups_dir . $field_file;
        }
    }
}