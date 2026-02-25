<?php
/**
 * Free Resources — block registration is handled by index.php via register_custom_block().
 * This file only defines the ACF field group for this block.
 */

add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_free_resources_block',
    'title' => 'Free Resources Block',
    'fields' => array(
      array(
        'key'           => 'field_frb_title',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'instructions'  => 'Section title',
        'default_value' => 'Free Resources',
      ),
      array(
        'key'          => 'field_frb_is_widget',
        'label'        => 'Widget Mode',
        'name'         => 'is_widget',
        'type'         => 'true_false',
        'instructions' => 'Use settings from Theme Options > Free Resources',
        'ui'           => 1,
        'ui_on_text'   => 'Widget',
        'ui_off_text'  => 'Block',
        'default_value' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/free-resources',
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