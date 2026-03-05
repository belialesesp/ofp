<?php
/**
 * Newsletter block — extra logic file (fields, enqueues).
 *
 * Changed: wrapped enqueue in has_block() so the script only loads on pages
 * that actually contain this block, instead of on every page sitewide.
 */

add_action( 'wp_enqueue_scripts', function () {
    if ( ! has_block( 'acf/newsletter' ) ) {
        return;
    }

    wp_enqueue_script(
        'newsletter-block-script',
        esc_url( get_stylesheet_directory_uri() . '/custom-blocks/newsletter/newsletter.js' ),
        array(),
        filemtime( get_template_directory() . '/custom-blocks/newsletter/newsletter.js' ),
        true
    );
} );