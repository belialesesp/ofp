<?php
// FAVORITE CARDS OPTIONS PAGE FIELDS

add_action( 'acf/include_fields', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'    => 'group_favorite_cards_settings',
        'title'  => 'Favorite Cards Settings',
        'fields' => array(

            // Title line 1
            array(
                'key'           => 'field_fc_title_line_1',
                'label'         => 'Title [line 1]',
                'name'          => 'widget_title_line_1',
                'type'          => 'text',
                'instructions'  => 'Displayed in the styled/script font.',
                'required'      => 0,
                'default_value' => 'my favorite',
            ),

            // Title line 2
            array(
                'key'           => 'field_fc_title_line_2',
                'label'         => 'Title [line 2]',
                'name'          => 'widget_title_line_2',
                'type'          => 'text',
                'instructions'  => 'Displayed in uppercase gothic font.',
                'required'      => 0,
                'default_value' => 'CARDS',
            ),

            // Left image
            array(
                'key'           => 'field_fc_left_image',
                'label'         => 'Left Image',
                'name'          => 'widget_left_image',
                'type'          => 'image',
                'instructions'  => 'Decorative image shown to the left of the title.',
                'required'      => 0,
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ),

            // Cards repeater — each row picks one credit card CPT post
            array(
                'key'          => 'field_fc_cards',
                'label'        => 'Favorite Cards',
                'name'         => 'widget_favorite_cards',
                'type'         => 'repeater',
                'instructions' => 'Select the credit cards to display. Order here defines display order.',
                'required'     => 0,
                'layout'       => 'table',
                'button_label' => 'Add Card',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_fc_card_post',
                        'label'         => 'Card',
                        'name'          => 'fc_card_post',
                        'type'          => 'post_object',
                        'instructions'  => '',
                        'required'      => 0,
                        'post_type'     => array( 'credit_cards' ),
                        'taxonomy'      => '',
                        'allow_null'    => 0,
                        'multiple'      => 0,
                        'return_format' => 'id',
                        'ui'            => 1,
                    ),
                ),
            ),

            // CTA label
            array(
                'key'          => 'field_fc_cta_label',
                'label'        => 'CTA Label',
                'name'         => 'widget_cta_label',
                'type'         => 'text',
                'instructions' => 'Text for the bottom call-to-action button. Leave blank to hide.',
                'required'     => 0,
            ),

            // CTA URL
            array(
                'key'          => 'field_fc_cta_url',
                'label'        => 'CTA URL',
                'name'         => 'widget_cta_url',
                'type'         => 'url',
                'instructions' => '',
                'required'     => 0,
            ),
        ),

        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'favorite-cards',
                ),
            ),
        ),

        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => true,
        'description'           => '',
    ) );
} );