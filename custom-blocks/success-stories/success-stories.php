<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'success_stories_register_block');
function success_stories_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'success-stories',
      'title'             => __('Success Stories'),
      'description'       => __('Block to show a Success Stories.'),
      'render_callback'   => 'success_stories_render',
      'category'          => 'formatting',
      'icon'              => 'format-quote',
      'keywords'          => array('success', 'stories', 'testimonials'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function success_stories_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS
add_action('acf/include_fields', function() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_success_stories_block',
        'title' => 'Success Stories Block',
        'fields' => array(
            // Title field (always visible)
            array(
                'key' => 'field_ssb_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Section title',
                'default_value' => 'Success Stories',
            ),
            
            // Widget Mode toggle
            array(
                'key' => 'field_ssb_is_widget',
                'label' => 'Widget Mode',
                'name' => 'is_widget',
                'type' => 'true_false',
                'instructions' => 'Use widget settings from global options',
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
                    'value' => 'acf/success-stories',
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