<?php
/**
 * ACF Field Group: Free Resources Widget Settings
 */

function register_free_resources_widget_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_free_resources_widget',
        'title' => 'Free Resources Widget Settings',
        'fields' => array(
            array(
                'key' => 'field_widget_title_resources',
                'label' => 'Title',
                'name' => 'widget_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_description_resources',
                'label' => 'Description',
                'name' => 'widget_description',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_images_position',
                'label' => 'Images Position',
                'name' => 'widget_images_position',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'choices' => array(
                    'alternating' => 'Alternating',
                    'left' => 'Left',
                    'right' => 'Right',
                ),
                'default_value' => 'alternating',
            ),
            array(
                'key' => 'field_widget_space_between_resources',
                'label' => 'Space Between Resources (px)',
                'name' => 'widget_space_between_resources',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'default_value' => 30,
            ),
            array(
                'key' => 'field_widget_title_color',
                'label' => 'Title Color',
                'name' => 'widget_title_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '#222222',
            ),
            array(
                'key' => 'field_widget_description_color',
                'label' => 'Description Color',
                'name' => 'widget_description_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '#222222',
            ),
            array(
                'key' => 'field_widget_resources',
                'label' => 'Resources',
                'name' => 'widget_resources',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Add Resource',
                'sub_fields' => array(
                    array(
                        'key' => 'field_widget_resources_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_widget_resources_badge_image',
                        'label' => 'Badge Image',
                        'name' => 'badge_image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_widget_resources_badge_label',
                        'label' => 'Badge Label',
                        'name' => 'badge_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_resources_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_resources_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_resources_cta_label',
                        'label' => 'CTA Label',
                        'name' => 'cta_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_resources_cta_url',
                        'label' => 'CTA URL',
                        'name' => 'cta_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_resources_cta_color',
                        'label' => 'CTA Color',
                        'name' => 'cta_color',
                        'type' => 'color_picker',
                        'instructions' => '',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-free-resources',
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
add_action('acf/init', 'register_free_resources_widget_fields');