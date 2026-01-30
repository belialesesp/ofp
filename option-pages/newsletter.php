<?php
// NEWSLETTER OPTIONS PAGE FIELDS
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }
  
  acf_add_local_field_group(array(
    'key' => 'group_newsletter_widget_settings',
    'title' => 'Newsletter Settings',
    'fields' => array(
      array(
        'key' => 'field_nlw_info',
        'label' => 'Newsletter Settings',
        'name' => '',
        'type' => 'message',
        'message' => 'These settings will be used for Newsletter blocks when "Widget Mode" is enabled.',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      
      // Content Settings accordion
      array(
        'key' => 'field_nlw_content_accordion',
        'label' => 'Content Settings',
        'name' => '',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1,
        'endpoint' => 0,
      ),
      
      array(
        'key' => 'field_nlw_widget_title',
        'label' => 'Default Title',
        'name' => 'widget_title',
        'type' => 'text',
        'instructions' => 'Section title',
        'default_value' => 'Stay Connected',
        'wrapper' => array(
          'width' => '100',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_description',
        'label' => 'Description',
        'name' => 'widget_description',
        'type' => 'wysiwyg',
        'instructions' => 'Text below the title',
        'tabs' => 'all',
        'toolbar' => 'basic',
        'media_upload' => 0,
        'wrapper' => array(
          'width' => '50',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_flodesk_form_id',
        'label' => 'Flodesk Form ID',
        'name' => 'widget_flodesk_form_id',
        'type' => 'text',
        'instructions' => 'Enter the Flodesk form ID (e.g., 685421b840679baaea6652ec)',
        'placeholder' => '685421b840679baaea6652ec',
        'wrapper' => array(
          'width' => '50',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_title_color',
        'label' => 'Title Color',
        'name' => 'widget_title_color',
        'type' => 'color_picker',
        'default_value' => '#FFFFFF',
        'wrapper' => array(
          'width' => '25',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_description_color',
        'label' => 'Description Color',
        'name' => 'widget_description_color',
        'type' => 'color_picker',
        'default_value' => '#FFFFFF',
        'wrapper' => array(
          'width' => '25',
        ),
      ),
      
      // Close content accordion
      array(
        'key' => 'field_nlw_content_accordion_end',
        'label' => '',
        'name' => '',
        'type' => 'accordion',
        'endpoint' => 1,
      ),
      
      // Background Settings accordion
      array(
        'key' => 'field_nlw_background_accordion',
        'label' => 'Background Settings',
        'name' => '',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1,
        'endpoint' => 0,
      ),
      
      array(
        'key' => 'field_nlw_widget_background_color',
        'label' => 'Background Color',
        'name' => 'widget_background_color',
        'type' => 'color_picker',
        'default_value' => '#222222',
        'wrapper' => array(
          'width' => '50',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_background_image',
        'label' => 'Background Image',
        'name' => 'widget_background_image',
        'type' => 'image',
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all',
        'wrapper' => array(
          'width' => '50',
        ),
      ),
      
      array(
        'key' => 'field_nlw_widget_background_video',
        'label' => 'Background Video',
        'name' => 'widget_background_video',
        'type' => 'url',
        'instructions' => 'Enter a video URL (Vimeo, YouTube, or direct video file URL). Video will take priority over background image if both are set.',
        'wrapper' => array(
          'width' => '100',
        ),
      ),
      
      // Close background accordion
      array(
        'key' => 'field_nlw_background_accordion_end',
        'label' => '',
        'name' => '',
        'type' => 'accordion',
        'endpoint' => 1,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'newsletter',
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

// Helper function to get newsletter widget data
function get_newsletter_widget_data() {
  return array(
    'title' => get_field('widget_title', 'option') ?: 'Stay Connected',
    'title_color' => get_field('widget_title_color', 'option') ?: '#FFFFFF',
    'description' => get_field('widget_description', 'option'),
    'description_color' => get_field('widget_description_color', 'option') ?: '#FFFFFF',
    'background_color' => get_field('widget_background_color', 'option') ?: '#222222',
    'background_image' => get_field('widget_background_image', 'option'),
    'background_video' => get_field('widget_background_video', 'option'),
    'flodesk_form_id' => get_field('widget_flodesk_form_id', 'option'),
  );
}