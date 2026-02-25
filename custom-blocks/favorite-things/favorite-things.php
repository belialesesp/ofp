<?php
/**
 * Favorite Things — block registration is handled by index.php via register_custom_block().
 * This file only defines the ACF field group for this block.
 */

add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_66fc29346cfc7',
    'title' => 'Favorite Things [Custom Block]',
    'fields' => array(
      array(
        'key'          => 'field_66fc2934724bb',
        'label'        => 'Favorite Things',
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
      array(
        'key'          => 'field_66fc2934724d0',
        'label'        => 'Content',
        'name'         => '',
        'aria-label'   => '',
        'type'         => 'tab',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'placement'    => 'top',
        'endpoint'     => 0,
        'selected'     => 0,
      ),
      array(
        'key'          => 'field_66fdb55190cff',
        'label'        => 'Rotating Image',
        'name'         => 'rotating_image',
        'aria-label'   => '',
        'type'         => 'group',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'layout'       => 'block',
        'sub_fields'   => array(
          array(
            'key'          => 'field_66fdb59390d00',
            'label'        => 'Image',
            'name'         => 'image',
            'aria-label'   => '',
            'type'         => 'image',
            'instructions' => '',
            'required'     => 0,
            'conditional_logic' => 0,
            'wrapper'      => array( 'width' => '50', 'class' => '', 'id' => '' ),
            'return_format' => 'array',
            'library'      => 'all',
            'min_width'    => '',
            'min_height'   => '',
            'min_size'     => '',
            'max_width'    => '',
            'max_height'   => '',
            'max_size'     => '',
            'mime_types'   => '',
            'preview_size' => 'medium',
          ),
          array(
            'key'          => 'field_66fdb5a790d01',
            'label'        => 'Rotating Image',
            'name'         => 'rotating_image',
            'aria-label'   => '',
            'type'         => 'image',
            'instructions' => '',
            'required'     => 0,
            'conditional_logic' => 0,
            'wrapper'      => array( 'width' => '50', 'class' => '', 'id' => '' ),
            'return_format' => 'array',
            'library'      => 'all',
            'min_width'    => '',
            'min_height'   => '',
            'min_size'     => '',
            'max_width'    => '',
            'max_height'   => '',
            'max_size'     => '',
            'mime_types'   => '',
            'preview_size' => 'medium',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/favorite-things',
        ),
      ),
    ),
    'active' => true,
  ) );
} );