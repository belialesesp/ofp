<?php
/**
 * Related Posts (Automatic) — uses acf_register_block_type with render_template and custom
 * supports, so it cannot use the generic register_custom_block() helper.
 * Registration is handled here and required from index.php.
 */

add_action( 'acf/init', function () {
  if ( ! function_exists( 'acf_register_block_type' ) ) {
    return;
  }

  acf_register_block_type( array(
    'name'            => 'related-posts-auto',
    'title'           => __( 'Related Posts (Automatic)' ),
    'description'     => __( 'Display related posts automatically by category.' ),
    'render_template' => get_template_directory() . '/custom-blocks/related-posts/related-posts.php',
    'category'        => 'formatting',
    'icon'            => 'admin-links',
    'keywords'        => array( 'posts', 'related', 'automatic' ),
    'mode'            => 'edit',
    'supports'        => array(
      'align' => false,
      'mode'  => true,
      'jsx'   => true,
    ),
  ) );
} );