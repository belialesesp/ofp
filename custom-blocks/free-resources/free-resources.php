<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'free_resources_register_block');
function free_resources_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'free-resources',
      'title'             => __('Free Resources'),
      'description'       => __('Block to show Free Resources.'),
      'render_callback'   => 'free_resources_render',
      'category'          => 'formatting',
      'icon'              => 'welcome-learn-more',
      'keywords'          => array('resources', 'free', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function free_resources_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS - Exactly like Success Stories
add_action('acf/include_fields', function() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_free_resources_block',
        'title' => 'Free Resources Block',
        'fields' => array(
            // Title field (always visible)
            array(
                'key' => 'field_frb_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Section title',
                'default_value' => 'Free Resources',
            ),
            
            // Widget Mode toggle
            array(
                'key' => 'field_frb_is_widget',
                'label' => 'Widget Mode',
                'name' => 'is_widget',
                'type' => 'true_false',
                'instructions' => 'Use settings from Theme Options > Free Resources',
                'ui' => 1,
                'ui_on_text' => 'Widget',
                'ui_off_text' => 'Block',
                'default_value' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/free-resources',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
});