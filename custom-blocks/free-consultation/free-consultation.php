<?php
/**
 * Free Consultation — block registration is handled by index.php via register_custom_block().
 * This file only defines the ACF field group for this block.
 */

add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_free_consultation_block',
    'title' => 'Free Consultation Block',
    'fields' => array(
      array(
        'key'           => 'field_ssb_title',
        'label'         => 'Title',
        'name'          => 'title',
        'type'          => 'text',
        'instructions'  => 'Section title',
        'default_value' => 'Free Consultation',
      ),
      array(
        'key'          => 'field_fcb_is_widget',
        'label'        => 'Widget Mode',
        'name'         => 'is_widget',
        'type'         => 'true_false',
        'instructions' => 'Use default settings from Theme Options > Free Consultation',
        'ui'           => 1,
        'ui_on_text'   => 'Widget',
        'ui_off_text'  => 'Block',
        'default_value' => 1,
      ),
      array(
        'key'     => 'field_fcb_widget_message',
        'label'   => 'Widget Settings Active',
        'name'    => '',
        'type'    => 'message',
        'message' => 'This block is using global settings from <strong>Theme Options > Free Consultation</strong>.<br>Switch to Block mode to set unique content for this block.',
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_fcb_is_widget',
              'operator' => '==',
              'value'    => '1',
            ),
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/free-consultation',
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