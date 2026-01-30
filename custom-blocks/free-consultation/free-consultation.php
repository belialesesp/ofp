<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'free_consultation_register_block');
function free_consultation_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'free-consultation',
      'title'             => __('Free Consultation'),
      'description'       => __('Block to show a Free Consultation.'),
      'render_callback'   => 'free_consultation_render',
      'category'          => 'formatting',
      'icon'              => 'welcome-learn-more',
      'keywords'          => array('consultation', 'free', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function free_consultation_render($block)
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
        'key' => 'group_free_consultation_block',
        'title' => 'Free Consultation Block',
        'fields' => array(
        // Title field (always visible)
            array(
                'key' => 'field_ssb_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Section title',
                'default_value' => 'Free Consultation',
            ),
            // Widget Mode toggle
            array(
                'key' => 'field_fcb_is_widget',
                'label' => 'Widget Mode',
                'name' => 'is_widget',
                'type' => 'true_false',
                'instructions' => 'Use default settings from Theme Options > Free Consultation',
                'ui' => 1,
                'ui_on_text' => 'Widget',
                'ui_off_text' => 'Block',
                'default_value' => 1,
            ),
            
            // Widget Mode Message
            array(
                'key' => 'field_fcb_widget_message',
                'label' => 'Widget Settings Active',
                'name' => '',
                'type' => 'message',
                'message' => 'This block is using global settings from <strong>Theme Options > Free Consultation</strong>.<br>Switch to Block mode to set unique content for this block.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Tab: Content (shown when NOT in widget mode)
            array(
                'key' => 'field_fcb_content_tab',
                'label' => 'Content',
                'name' => '',
                'type' => 'tab',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            
            // Sub Title [Left]
            array(
                'key' => 'field_fcb_sub_title_left',
                'label' => 'Sub Title [Left]',
                'name' => 'sub_title_left',
                'type' => 'text',
                'instructions' => '',
                'default_value' => 'NEED HELP?',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Title [Left]
            array(
                'key' => 'field_fcb_title_left',
                'label' => 'Title [Left]',
                'name' => 'title_left',
                'type' => 'text',
                'instructions' => '',
                'default_value' => 'Get Expert Financial Guidance Today',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Title [Right]
            array(
                'key' => 'field_fcb_title_right',
                'label' => 'Title [Right]',
                'name' => 'title_right',
                'type' => 'text',
                'instructions' => '',
                'default_value' => 'Free Consultation',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Description [Right]
            array(
                'key' => 'field_fcb_description_right',
                'label' => 'Description [Right]',
                'name' => 'description_right',
                'type' => 'wysiwyg',
                'instructions' => '',
                'default_value' => 'Take the first step towards financial freedom. Schedule your complimentary consultation with our experts today.',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // CTA Label [Right]
            array(
                'key' => 'field_fcb_cta_label_right',
                'label' => 'CTA Label [Right]',
                'name' => 'cta_label_right',
                'type' => 'text',
                'instructions' => '',
                'default_value' => 'SCHEDULE NOW',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // CTA URL [Right]
            array(
                'key' => 'field_fcb_cta_url_right',
                'label' => 'CTA URL [Right]',
                'name' => 'cta_url_right',
                'type' => 'url',
                'instructions' => '',
                'default_value' => '/contact',
                'placeholder' => '',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Tab: Setting (shown when NOT in widget mode)
            array(
                'key' => 'field_fcb_setting_tab',
                'label' => 'Setting',
                'name' => '',
                'type' => 'tab',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            
            // Background Color
            array(
                'key' => 'field_fcb_background_color',
                'label' => 'Background Color',
                'name' => 'background_color',
                'type' => 'color_picker',
                'instructions' => '',
                'default_value' => '#f7f7f7',
                'enable_opacity' => true,
                'return_format' => 'string',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Box Background Color
            array(
                'key' => 'field_fcb_box_background_color',
                'label' => 'Box Background Color',
                'name' => 'box_background_color',
                'type' => 'color_picker',
                'instructions' => '',
                'default_value' => '#ffffff',
                'enable_opacity' => true,
                'return_format' => 'string',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // Text Color
            array(
                'key' => 'field_fcb_text_color',
                'label' => 'Text Color',
                'name' => 'text_color',
                'type' => 'color_picker',
                'instructions' => '',
                'default_value' => '#222222',
                'enable_opacity' => false,
                'return_format' => 'string',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_fcb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/free-consultation',
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