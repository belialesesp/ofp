<?php
/**
 * Destinations Map — block registration is handled by index.php via register_custom_block().
 * This file defines the ACF field group and enqueues the block-specific JavaScript.
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
        'key'          => 'field_66c430ea16014',
        'label'        => 'Map Config',
        'name'         => '',
        'aria-label'   => '',
        'type'         => 'accordion',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'open'         => 0,
        'multi_expand' => 0,
        'endpoint'     => 0,
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
    'menu_order'          => 0,
    'position'            => 'normal',
    'style'               => 'default',
    'label_placement'     => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'      => '',
    'active'              => true,
    'description'         => '',
    'show_in_rest'        => 0,
  ) );
} );

// JS ENQUEUE
add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'destinations-map-block-script',
    get_stylesheet_directory_uri() . '/custom-blocks/destinations-map/destinations-map.js',
    array( 'jquery' ),
    ofp_VERSION,
    true
  );
} );