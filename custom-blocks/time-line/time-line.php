<?php
/**
 * Time Line — block registration is handled by index.php via register_custom_block().
 * This file only enqueues the block-specific JavaScript.
 */

add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'time-line-block-script',
    get_stylesheet_directory_uri() . '/custom-blocks/time-line/time-line.js',
    array( 'jquery' ),
    ofp_VERSION,
    true
  );
} );