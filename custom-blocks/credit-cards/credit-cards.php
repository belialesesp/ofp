<?php
/**
 * Credit Cards — block registration is handled by index.php via register_custom_block().
 * This file only defines the ACF field group for this block.
 */

add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_66b8447f1fb12',
    'title' => 'Credit Cards - Custom Block',
    'fields' => array(
      array(
        'key'          => 'field_66b8486e82b2b',
        'label'        => 'Credit Card Config',
        'name'         => '',
        'type'         => 'accordion',
        'open'         => 1,
        'multi_expand' => 0,
        'endpoint'     => 0,
      ),
      array(
        'key'            => 'field_66b8447fa0590',
        'label'          => 'Card Style',
        'name'           => 'ccb_card_stye',
        'type'           => 'select',
        'choices'        => array( 'large' => 'Large', 'medium' => 'Medium', 'small' => 'Small' ),
        'default_value'  => 'Large',
        'return_format'  => 'value',
        'multiple'       => 0,
        'allow_null'     => 0,
        'ui'             => 0,
      ),
      array(
        'key'           => 'field_66b8480ffefd7',
        'label'         => 'Credit Card',
        'name'          => 'ccb_credit_card',
        'type'          => 'select',
        'choices'       => array(),
        'default_value' => false,
        'return_format' => 'value',
        'multiple'      => 0,
        'allow_null'    => 0,
        'ui'            => 0,
      ),
    ),
    'location' => array(
      array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/credit-cards' ) ),
    ),
    'active' => true,
  ) );
} );