<?php
/**
 * Non-Affiliate Disclosure — uses acf_register_block_type with render_template and custom
 * supports, so it cannot use the generic register_custom_block() helper.
 * Registration is handled here and required from index.php.
 */

add_action( 'acf/init', function () {
  if ( ! function_exists( 'acf_register_block_type' ) ) {
    return;
  }

  acf_register_block_type( array(
    'name'            => 'non-affiliate-disclosure',
    'title'           => __( 'Non-Affiliate Disclosure' ),
    'description'     => __( 'Displays a non-affiliate disclosure message.' ),
    'render_template' => 'custom-blocks/non-affiliate-disclosure/non-affiliate-disclosure-template.php',
    'category'        => 'formatting',
    'icon'            => 'info',
    'keywords'        => array( 'disclosure', 'affiliate', 'legal' ),
    'mode'            => 'edit',
    'supports'        => array(
      'align' => array( 'wide', 'full' ),
      'mode'  => true,
    ),
  ) );
} );