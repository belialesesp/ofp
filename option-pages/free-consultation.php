<?php
/**
 * Free Consultation Options Page Fields
 * Location: /option-pages/free-consultation.php
 */

// FREE CONSULTATION OPTIONS PAGE FIELDS
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_free_consultation_settings',
    'title' => 'Free Consultation Settings',
    'fields' => array(
      array(
        'key' => 'field_free_consultation_info',
        'label' => 'Free Consultation Information',
        'name' => '',
        'type' => 'message',
        'message' => 'Configure the global settings for Free Consultation blocks. These settings will be used when the block is set to use global settings.',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      
      // Tab: Content
      array(
        'key' => 'field_fc_content_tab',
        'label' => 'Content',
        'name' => '',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
      ),
      
      // Sub Title [Left]
      array(
        'key' => 'field_widget_sub_title_left',
        'label' => 'Sub Title [Left]',
        'name' => 'widget_sub_title_left',
        'type' => 'text',
        'instructions' => '',
        'default_value' => 'NEED HELP?',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // Title [Left]
      array(
        'key' => 'field_widget_title_left',
        'label' => 'Title [Left]',
        'name' => 'widget_title_left',
        'type' => 'text',
        'instructions' => '',
        'default_value' => 'Get Expert Financial Guidance Today',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // Title [Right]
      array(
        'key' => 'field_widget_title_right',
        'label' => 'Title [Right]',
        'name' => 'widget_title_right',
        'type' => 'text',
        'instructions' => '',
        'default_value' => 'Free Consultation',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // Description [Right]
      array(
        'key' => 'field_widget_description_right',
        'label' => 'Description [Right]',
        'name' => 'widget_description_right',
        'type' => 'wysiwyg',
        'instructions' => '',
        'default_value' => 'Take the first step towards financial freedom. Schedule your complimentary consultation with our experts today.',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
      
      // CTA Label [Right]
      array(
        'key' => 'field_widget_cta_label_right',
        'label' => 'CTA Label [Right]',
        'name' => 'widget_cta_label_right',
        'type' => 'text',
        'instructions' => '',
        'default_value' => 'SCHEDULE NOW',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // CTA URL [Right]
      array(
        'key' => 'field_widget_cta_url_right',
        'label' => 'CTA URL [Right]',
        'name' => 'widget_cta_url_right',
        'type' => 'url',
        'instructions' => '',
        'default_value' => '/contact',
        'placeholder' => '',
      ),
      
      // Tab: Setting
      array(
        'key' => 'field_fc_setting_tab',
        'label' => 'Setting',
        'name' => '',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
      ),
      
      // Background Color
      array(
        'key' => 'field_widget_background_color',
        'label' => 'Background Color',
        'name' => 'widget_background_color',
        'type' => 'color_picker',
        'instructions' => '',
        'default_value' => '#f7f7f7',
        'enable_opacity' => true,
        'return_format' => 'string',
      ),
      
      // Box Background Color
      array(
        'key' => 'field_widget_box_background_color',
        'label' => 'Box Background Color',
        'name' => 'widget_box_background_color',
        'type' => 'color_picker',
        'instructions' => '',
        'default_value' => '#ffffff',
        'enable_opacity' => true,
        'return_format' => 'string',
      ),
      
      // Text Color
      array(
        'key' => 'field_widget_text_color',
        'label' => 'Text Color',
        'name' => 'widget_text_color',
        'type' => 'color_picker',
        'instructions' => '',
        'default_value' => '#222222',
        'enable_opacity' => false,
        'return_format' => 'string',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'free-consultation',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'field',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
});

// Helper function to get free consultation data
function get_free_consultation_data() {
  return array(
    'sub_title_left' => get_field('widget_sub_title_left', 'option') ?: 'NEED HELP?',
    'title_left' => get_field('widget_title_left', 'option') ?: 'Get Expert Financial Guidance Today',
    'title_right' => get_field('widget_title_right', 'option') ?: 'Free Consultation',
    'description_right' => get_field('widget_description_right', 'option') ?: 'Take the first step towards financial freedom. Schedule your complimentary consultation with our experts today.',
    'cta_label_right' => get_field('widget_cta_label_right', 'option') ?: 'SCHEDULE NOW',
    'cta_url_right' => get_field('widget_cta_url_right', 'option') ?: '/contact',
    'background_color' => get_field('widget_background_color', 'option') ?: '#f7f7f7',
    'box_background_color' => get_field('widget_box_background_color', 'option') ?: '#ffffff',
    'text_color' => get_field('widget_text_color', 'option') ?: '#222222',
  );
}