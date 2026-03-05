<?php
/**
 * Course Library — block registration is handled by index.php via register_custom_block().
 * This file only enqueues the block-specific JavaScript.
 *
 * Changed: wrapped enqueue in has_block() so the script only loads on pages
 * that actually contain this block, instead of on every page sitewide.
 */

add_action( 'wp_enqueue_scripts', function () {
    if ( ! has_block( 'acf/course-library' ) ) {
        return;
    }

    wp_enqueue_script(
        'course-library-block-script',
        get_stylesheet_directory_uri() . '/custom-blocks/course-library/course-library.js',
        array( 'jquery' ),
        filemtime( get_template_directory() . '/custom-blocks/course-library/course-library.js' ),
        true
    );
} );