<?php
/**
 * Destinations Map — block registration is handled by index.php via register_custom_block().
 * This file defines the ACF field group.
 *
 * JS enqueue REMOVED: OFP_Block_Destinations_Map (inc/blocks/blocks/class-ofp-block-destinations-map.php)
 * already enqueues destinations-map.js via OFP_Block_Base::enqueue_assets(), which uses has_block()
 * correctly. The previous unconditional wp_enqueue_script() here was a duplicate that loaded the
 * script on every page regardless of whether the block was present.
 */

// ACF FIELDS
add_action( 'acf/include_fields', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'   => 'group_66c430cac3313',
        'title' => 'Destinations Map [Custom Block]',
        'fields' => array(
            array(
                'key'               => 'field_66c430ea16014',
                'label'             => 'Map Config',
                'name'              => '',
                'aria-label'        => '',
                'type'              => 'accordion',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array( 'width' => '', 'class' => '', 'id' => '' ),
                'open'              => 0,
                'multi_expand'      => 0,
                'endpoint'          => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'block',
                    'operator' => '==',
                    'value'    => 'acf/destinations-map',
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
        'show_in_rest'          => 0,
    ) );
} );