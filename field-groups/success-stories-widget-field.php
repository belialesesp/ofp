<?php
/**
 * ACF Field Group: Success Stories Widget Settings
 */

function register_success_stories_widget_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_success_stories_widget',
        'title' => 'Success Stories Widget Settings',
        'fields' => array(
            array(
                'key' => 'field_widget_title_success',
                'label' => 'Title',
                'name' => 'widget_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_stories',
                'label' => 'Stories',
                'name' => 'widget_stories',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Add Story',
                'sub_fields' => array(
                    array(
                        'key' => 'field_widget_stories_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_widget_stories_storie',
                        'label' => 'Story',
                        'name' => 'storie',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_stories_author',
                        'label' => 'Author',
                        'name' => 'author',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_stories_color',
                        'label' => 'Image Border Color / Author Color',
                        'name' => 'image_border_color__author_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_widget_background_type',
                'label' => 'Background Type',
                'name' => 'widget_background_type',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'choices' => array(
                    'gradient' => 'Gradient',
                    'color' => 'Solid Color',
                ),
                'default_value' => 'gradient',
                'return_format' => 'value',
            ),
            array(
                'key' => 'field_widget_background_color',
                'label' => 'Background Color',
                'name' => 'widget_background_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_widget_background_type',
                            'operator' => '==',
                            'value' => 'color',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_widget_background_color_start',
                'label' => 'Background Color Start',
                'name' => 'widget_background_color_start',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_widget_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_widget_background_color_end',
                'label' => 'Background Color End',
                'name' => 'widget_background_color_end',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_widget_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
            ),
            array(
                'key' => 'field_widget_rotation_deg',
                'label' => 'Rotation (Degrees)',
                'name' => 'widget_rotation_deg',
                'type' => 'number',
                'instructions' => 'Enter a value between 0 and 360',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_widget_background_type',
                            'operator' => '==',
                            'value' => 'gradient',
                        ),
                    ),
                ),
                'default_value' => 90,
                'min' => 0,
                'max' => 360,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-success-stories',
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
}
add_action('acf/init', 'register_success_stories_widget_fields');