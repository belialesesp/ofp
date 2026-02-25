<?php
/**
 * Course Library — block registration is handled by index.php via register_custom_block().
 * This file only enqueues the block-specific JavaScript.
 */

add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'course-library-block-script',
    get_stylesheet_directory_uri() . '/custom-blocks/course-library/course-library.js',
    array( 'jquery' ),
    ofp_VERSION,
    true
  );
} );