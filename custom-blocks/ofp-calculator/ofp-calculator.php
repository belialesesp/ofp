<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'ofp_calculator_register_block');
function ofp_calculator_register_block()
{
    if (function_exists('acf_register_block')) {
        acf_register_block(array(
            'name' => 'ofp-calculator',
            'title' => __('Points Calculator'),
            'description' => __('Calculate travel points value to determine if redemptions are worth it.'),
            'render_callback' => 'ofp_calculator_render',
            'category' => 'formatting',
            'icon' => 'calculator',
            'keywords' => array('calculator', 'points', 'miles', 'rewards', 'travel'),
        ));
    }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function ofp_calculator_render($block)
{
    // convert name ("acf/block") into path friendly slug ("block")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from folder
    if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
        include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
    }
}

// CUSTOM BLOCK FIELDS
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_ofp_calculator',
        'title' => 'Points Calculator [Custom Block]',
        'fields' => array(
            array(
                'key' => 'field_ofp_calculator_accordion',
                'label' => 'Points Calculator',
                'name' => '',
                'aria-label' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_ofp_calculator_content_tab',
                'label' => 'Content',
                'name' => '',
                'aria-label' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
                'selected' => 0,
            ),
            array(
                'key' => 'field_ofp_calculator_title',
                'label' => 'Title',
                'name' => 'title',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'Points Calculator',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_ofp_calculator_description',
                'label' => 'Description',
                'name' => 'description',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'What are my points worth? Based on this calculator, you can see if a points redemption is the best way to go!',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'rows' => 3,
            ),
            array(
                'key' => 'field_ofp_calculator_show_logo',
                'label' => 'Display Logo',
                'name' => 'show_logo',
                'aria-label' => '',
                'type' => 'true_false',
                'instructions' => 'Show the OFP logo above the calculator',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 1,
                'ui_on_text' => 'Yes',
                'ui_off_text' => 'No',
                'ui' => 1,
            ),
            array(
                'key' => 'field_ofp_calculator_logo',
                'label' => 'Custom Logo',
                'name' => 'custom_logo',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => 'Upload a custom logo (leave empty to use default site logo)',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_show_logo',
                            'operator' => '==',
                            'value' => 1,
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_ofp_calculator_settings_tab',
                'label' => 'Settings',
                'name' => '',
                'aria-label' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
                'selected' => 0,
            ),
            array(
                'key' => 'field_ofp_calculator_background_type',
                'label' => 'Background Type',
                'name' => 'background_type',
                'aria-label' => '',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'color' => 'Color',
                    'gradient' => 'Gradient',
                    'image' => 'Image',
                ),
                'default_value' => 'color',
                'return_format' => 'value',
                'multiple' => 0,
                'allow_null' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_ofp_calculator_background_color',
                'label' => 'Background Color',
                'name' => 'background_color',
                'aria-label' => '',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_background_type',
                            'operator' => '==',
                            'value' => 'color',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#f8f9fa',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_ofp_calculator_background_color_start',
                'label' => 'Background Color Start',
                'name' => 'background_color_start',
                'aria-label' => '',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '33.333',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#9abfcc',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_ofp_calculator_background_color_end',
                'label' => 'Background Color End',
                'name' => 'background_color_end',
                'aria-label' => '',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '33.333',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#d3eff4',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
            array(
                'key' => 'field_ofp_calculator_rotation_deg',
                'label' => 'Rotation (Deg) (0-360)',
                'name' => 'rotation_deg',
                'aria-label' => '',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '33.333',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '90',
                'min' => '',
                'max' => '',
                'placeholder' => '',
                'step' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_ofp_calculator_background_image',
                'label' => 'Background Image',
                'name' => 'background_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_ofp_calculator_background_type',
                            'operator' => '==',
                            'value' => 'image',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_ofp_calculator_accent_color',
                'label' => 'Accent Color',
                'name' => 'accent_color',
                'aria-label' => '',
                'type' => 'color_picker',
                'instructions' => 'Color for buttons and highlights',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#6496c8',
                'enable_opacity' => 0,
                'return_format' => 'string',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/ofp-calculator',
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
        'show_in_rest' => 0,
    ));
});

// Check if Bootstrap is already enqueued
function ofp_calculator_enqueue_bootstrap() {
    // Check if Bootstrap is already enqueued
    global $wp_styles;
    $bootstrap_enqueued = false;
    
    foreach($wp_styles->registered as $style) {
        if (strpos($style->src, 'bootstrap') !== false) {
            $bootstrap_enqueued = true;
            break;
        }
    }
    
    // Enqueue Bootstrap only if not already loaded
    if (!$bootstrap_enqueued) {
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3.0');
        wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    }
}
add_action('wp_enqueue_scripts', 'ofp_calculator_enqueue_bootstrap');

// Enqueue FontAwesome for the calculator block - only if not already loaded
function ofp_calculator_enqueue_fontawesome() {
    // Check if FontAwesome is already enqueued
    global $wp_styles;
    $fontawesome_enqueued = false;
    
    foreach($wp_styles->registered as $style) {
        if (strpos($style->src, 'font-awesome') !== false || strpos($style->src, 'fontawesome') !== false) {
            $fontawesome_enqueued = true;
            break;
        }
    }
    
    if (!$fontawesome_enqueued) {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    }
}
add_action('wp_enqueue_scripts', 'ofp_calculator_enqueue_fontawesome');