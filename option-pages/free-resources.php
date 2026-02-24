<?php
// FREE RESOURCES OPTIONS PAGE FIELDS AND FUNCTIONS

// FREE RESOURCES OPTIONS PAGE FIELDS
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_free_resources_settings',
    'title' => 'Free Resources Settings',
    'fields' => array(
      // Float Icon
      array(
        'key' => 'field_fr_float_icon',
        'label' => 'Float Icon',
        'name' => 'widget_float_icon',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'return_format' => 'array',
        'preview_size' => 'thumbnail',
        'library' => 'all',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
      ),
      
      // Sub Title
      array(
        'key' => 'field_fr_sub_title',
        'label' => 'Sub Title',
        'name' => 'widget_sub_title',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'POINTS & MILES',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // Title
      array(
        'key' => 'field_fr_widget_title',
        'label' => 'Title',
        'name' => 'widget_title',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 'Free Resources',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      
      // Description
      array(
        'key' => 'field_fr_widget_description',
        'label' => 'Description',
        'name' => 'widget_description',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
      ),
      
      // Title Color
      array(
        'key' => 'field_fr_widget_title_color',
        'label' => 'Title Color',
        'name' => 'widget_title_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '#222222',
        'enable_opacity' => false,
        'return_format' => 'string',
      ),
      
      // Description Color
      array(
        'key' => 'field_fr_widget_description_color',
        'label' => 'Description Color',
        'name' => 'widget_description_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '#222222',
        'enable_opacity' => false,
        'return_format' => 'string',
      ),
      
      // Images Position
      array(
        'key' => 'field_fr_widget_images_position',
        'label' => 'Images Position',
        'name' => 'widget_images_position',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array(
          'alternating' => 'Alternating (left-right-left)',
          'left' => 'All images on left',
          'right' => 'All images on right',
        ),
        'allow_null' => 0,
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => 'alternating',
        'layout' => 'horizontal',
        'return_format' => 'value',
      ),
      
      // Space Between Resources
      array(
        'key' => 'field_fr_widget_space_between_resources',
        'label' => 'Space Between Resources',
        'name' => 'widget_space_between_resources',
        'type' => 'range',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => 0,
        'min' => 0,
        'max' => 100,
        'step' => 5,
        'prepend' => '',
        'append' => 'px',
      ),
      
      // Resources Repeater
      array(
        'key' => 'field_fr_widget_resources',
        'label' => 'Resources',
        'name' => 'widget_resources',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_fr_resource_title',
        'min' => 0,
        'max' => 0,
        'layout' => 'block',
        'button_label' => 'Add Resource',
        'sub_fields' => array(
          array(
            'key' => 'field_fr_resource_title',
            'label' => 'Title',
            'name' => 'title',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_fr_resource_image',
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
          ),
          array(
            'key' => 'field_fr_resource_description',
            'label' => 'Description',
            'name' => 'description',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => 4,
            'new_lines' => 'br',
          ),
          array(
            'key' => 'field_fr_resource_badge_label',
            'label' => 'Badge Label',
            'name' => 'badge_label',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_fr_resource_badge_image',
            'label' => 'Badge Image',
            'name' => 'badge_image',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'field_fr_resource_cta_label',
            'label' => 'CTA Label',
            'name' => 'cta_label',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 'Learn More',
          ),
          array(
            'key' => 'field_fr_resource_cta_url',
            'label' => 'CTA URL',
            'name' => 'cta_url',
            'type' => 'url',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_fr_resource_cta_color',
            'label' => 'CTA Color',
            'name' => 'cta_color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#000000',
            'enable_opacity' => false,
            'return_format' => 'string',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'free-resources',
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

// Helper function to get free resources data
function get_free_resources_data() {
  return array(
    'float_icon' => get_field('widget_float_icon', 'option'),
    'sub_title' => get_field('widget_sub_title', 'option') ?: 'POINTS & MILES',
    'title' => get_field('widget_title', 'option') ?: 'Free Resources',
    'title_color' => get_field('widget_title_color', 'option') ?: '#222222',
    'description' => get_field('widget_description', 'option'),
    'description_color' => get_field('widget_description_color', 'option') ?: '#222222',
    'images_position' => get_field('widget_images_position', 'option') ?: 'alternating',
    'space_between_resources' => get_field('widget_space_between_resources', 'option') ?: 0,
    'resources' => get_field('widget_resources', 'option') ?: array(),
  );
}