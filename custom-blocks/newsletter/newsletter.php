<?php
// ENQUEUE BLOCK SCRIPTS
function newsletter_scripts() {
  wp_enqueue_script(
    'newsletter-block-script',
    esc_url( get_stylesheet_directory_uri() . '/custom-blocks/newsletter/newsletter.js' ),
    array(),
    _S_VERSION,
    true
  );
}
add_action( 'wp_enqueue_scripts', 'newsletter_scripts' );