<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'newsletter_register_block');
function newsletter_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'newsletter',
      'title'             => __('Newsletter'),
      'description'       => __('Block to show a Newsletter.'),
      'render_callback'   => 'newsletter_render',
      'category'          => 'formatting',
      'icon'              => 'email-alt',
      'keywords'          => array('newsletter', 'subscribe', 'email'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function newsletter_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);
  
  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// REGISTER SCRIPTS
function newsletter_scripts() {
    wp_enqueue_script( 'newsletter-block-style', esc_url( get_stylesheet_directory_uri() . '/custom-blocks/newsletter/newsletter.js' ), array('jquery'), '1.0.0', true );
    
    // Localize script for AJAX
    wp_localize_script('newsletter-block-style', 'newsletter_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('newsletter_nonce')
    ));
}
add_action( 'wp_enqueue_scripts', 'newsletter_scripts' );

// CUSTOM BLOCK FIELDS
add_action('acf/include_fields', function() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group(array(
        'key' => 'group_newsletter_block',
        'title' => 'Newsletter Block',
        'fields' => array(
            // Title
            array(
                'key' => 'field_nb_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Section title',
                'default_value' => 'Newsletter',
            ),
            // Widget Mode toggle - FIRST, no conditional logic
            array(
                'key' => 'field_nb_is_widget',
                'label' => 'Widget Mode',
                'name' => 'is_widget',
                'type' => 'true_false',
                'instructions' => 'Use widget settings from global options',
                'ui' => 1,
                'ui_on_text' => 'Widget',
                'ui_off_text' => 'Block',
                'default_value' => 0,
            ),
            
            // Widget Mode Message (shows when in widget mode)
            array(
                'key' => 'field_nb_widget_message',
                'label' => 'Widget Settings Active',
                'name' => '',
                'type' => 'message',
                'message' => 'This block is using global settings from <strong>Theme Options > Newsletter</strong>.<br>Switch to Block mode to set unique content for this block.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_nb_is_widget',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            // // Tab: Content (shown when NOT in widget mode)
            // array(
            //     'key' => 'field_nb_content_tab',
            //     'label' => 'Content',
            //     'name' => '',
            //     'type' => 'tab',
            //     'conditional_logic' => array(
            //         array(
            //             array(
            //                 'field' => 'field_nb_is_widget',
            //                 'operator' => '!=',
            //                 'value' => '1',
            //             ),
            //         ),
            //     ),
            //     'placement' => 'top',
            //     'endpoint' => 0,
            // ),
            
            // Flodesk Form ID
            array(
                'key' => 'field_nb_form_id',
                'label' => 'Flodesk Form ID',
                'name' => 'form_id',
                'type' => 'text',
                'instructions' => 'Enter the Flodesk form ID (e.g., 685421b840679baaea6652ec)',
                'default_value' => '685421b840679baaea6652ec',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_nb_is_widget',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            
            
            
        //     // Description
        //     array(
        //         'key' => 'field_nb_description',
        //         'label' => 'Description',
        //         'name' => 'description',
        //         'type' => 'wysiwyg',
        //         'instructions' => '',
        //         'default_value' => '',
        //         'tabs' => 'all',
        //         'toolbar' => 'basic',
        //         'media_upload' => 0,
        //         'delay' => 0,
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //     ),
            
        //     // Tab: Settings (shown when NOT in widget mode)
        //     array(
        //         'key' => 'field_nb_settings_tab',
        //         'label' => 'Settings',
        //         'name' => '',
        //         'type' => 'tab',
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //         'placement' => 'top',
        //         'endpoint' => 0,
        //     ),
            
        //     // Background Color
        //     array(
        //         'key' => 'field_nb_background_color',
        //         'label' => 'Background Color',
        //         'name' => 'background_color',
        //         'type' => 'color_picker',
        //         'instructions' => '',
        //         'default_value' => '#222222',
        //         'enable_opacity' => true,
        //         'return_format' => 'string',
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //     ),
            
        //     // Title Color
        //     array(
        //         'key' => 'field_nb_title_color',
        //         'label' => 'Title Color',
        //         'name' => 'title_color',
        //         'type' => 'color_picker',
        //         'instructions' => '',
        //         'default_value' => '#FFFFFF',
        //         'enable_opacity' => false,
        //         'return_format' => 'string',
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //     ),
            
        //     // Description Color
        //     array(
        //         'key' => 'field_nb_description_color',
        //         'label' => 'Description Color',
        //         'name' => 'description_color',
        //         'type' => 'color_picker',
        //         'instructions' => '',
        //         'default_value' => '#FFFFFF',
        //         'enable_opacity' => false,
        //         'return_format' => 'string',
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //     ),
            
        //     // Background Image
        //     array(
        //         'key' => 'field_nb_background_image',
        //         'label' => 'Background Image',
        //         'name' => 'background_image',
        //         'type' => 'image',
        //         'instructions' => '',
        //         'required' => 0,
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //         'return_format' => 'array',
        //         'preview_size' => 'medium',
        //         'library' => 'all',
        //     ),
            
        //     // Background Video
        //     array(
        //         'key' => 'field_nb_background_video',
        //         'label' => 'Background Video',
        //         'name' => 'background_video',
        //         'type' => 'url',
        //         'instructions' => 'Enter a video URL (Vimeo, YouTube, or direct video file URL)',
        //         'required' => 0,
        //         'conditional_logic' => array(
        //             array(
        //                 array(
        //                     'field' => 'field_nb_is_widget',
        //                     'operator' => '!=',
        //                     'value' => '1',
        //                 ),
        //             ),
        //         ),
        //     ),
         ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/newsletter',
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