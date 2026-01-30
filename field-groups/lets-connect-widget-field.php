<?php
/**
 * ACF Field Group: Lets Connect Widget Settings
 */

function register_lets_connect_widget_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_lets_connect_widget',
        'title' => 'Lets Connect Widget Settings',
        'fields' => array(
            array(
                'key' => 'field_widget_background_color_lc',
                'label' => 'Background Color',
                'name' => 'widget_background_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'default_value' => '#f8f8f8',
            ),
            array(
                'key' => 'field_widget_title_lc',
                'label' => 'Title',
                'name' => 'widget_title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_image_lc',
                'label' => 'Image',
                'name' => 'widget_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_widget_description_lc',
                'label' => 'Description',
                'name' => 'widget_description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_social_medias',
                'label' => 'Social Media Links',
                'name' => 'widget_social_medias',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'layout' => 'block',
                'button_label' => 'Add Social Media',
                'sub_fields' => array(
                    array(
                        'key' => 'field_widget_social_icon',
                        'label' => 'Social Icon',
                        'name' => 'social_icon',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'layout' => 'block',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_widget_social_icon_type',
                                'label' => 'Icon Type',
                                'name' => 'type',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 0,
                                'choices' => array(
                                    'dashicons' => 'Dashicons',
                                    'media_library' => 'Media Library',
                                    'url' => 'URL',
                                ),
                                'default_value' => 'dashicons',
                            ),
                            array(
                                'key' => 'field_widget_social_icon_value',
                                'label' => 'Icon Value',
                                'name' => 'value',
                                'type' => 'text',
                                'instructions' => 'For Dashicons, enter the dashicon class (e.g. dashicons-facebook-alt). For Media Library, select an image. For URL, enter an image URL.',
                                'required' => 0,
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_widget_social_label',
                        'label' => 'Social Label',
                        'name' => 'social_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_social_url',
                        'label' => 'Social URL',
                        'name' => 'social_url',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_widget_color_icon',
                        'label' => 'Icon Color',
                        'name' => 'color_icon',
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
                    'value' => 'acf-options-lets-connect',
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
add_action('acf/init', 'register_lets_connect_widget_fields');