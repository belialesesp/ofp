<?php
/**
 * Success Stories — block registration is handled by index.php via register_custom_block().
 * This file only defines the ACF field group for this block.
 */

add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_success_stories_block',
    'title' => 'Success Stories Block',
    'fields' => array(
      array(
        'key'           => 'field_ssb_title',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'instructions'  => 'Section title',
        'default_value' => 'Success Stories',
      ),
      array(
        'key'          => 'field_ssb_is_widget',
        'label'        => 'Widget Mode',
        'name'         => 'is_widget',
        'type'         => 'true_false',
        'instructions' => 'Use widget settings from global options',
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
          'value'    => 'acf/success-stories',
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