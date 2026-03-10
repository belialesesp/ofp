<?php
/**
 * Register ACF Fields for Favorite Cards Widget
 */
function register_favorite_cards_widget_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_favorite_cards_widget',
        'title' => 'Favorite Cards Widget Settings',
        'fields' => array(
            array(
                'key' => 'field_widget_title_line_1',
                'label' => 'Title [line 1]',
                'name' => 'widget_title_line_1',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_title_line_2',
                'label' => 'Title [line 2]',
                'name' => 'widget_title_line_2',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_left_image',
                'label' => 'Left Image',
                'name' => 'widget_left_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_widget_favorite_cards',
                'label' => 'Favorite Cards',
                'name' => 'widget_favorite_cards',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'layout' => 'table',
                'button_label' => 'Add Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_widget_fc_card_option',
                        'label' => 'Card Option',
                        'name' => 'fc_card_option',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'choices' => array(),
                        'default_value' => false,
                        'return_format' => 'value',
                    ),
                ),
            ),
            array(
                'key' => 'field_widget_cta_label',
                'label' => 'CTA Label',
                'name' => 'widget_cta_label',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
            ),
            array(
                'key' => 'field_widget_cta_url',
                'label' => 'CTA URL',
                'name' => 'widget_cta_url',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'favorite-cards',
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
add_action('acf/init', 'register_favorite_cards_widget_fields');