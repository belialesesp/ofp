<?php
/**
 * Unique Card Body Section — block registration is handled by index.php via register_custom_block().
 * This file defines the ACF filter to populate the card select field and enqueues block CSS.
 */

// POPULATE SELECT WITH CREDIT CARDS FROM CPT
add_filter( 'acf/load_field/name=card_to_show', function ( $field ) {
  $field['choices'] = array();

  $cards = get_posts( array(
    'post_type'      => 'credit_cards',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'order'          => 'ASC',
  ) );

  if ( $cards ) {
    foreach ( $cards as $card ) {
      $field['choices'][ $card->ID ] = $card->post_title;
    }
  }

  return $field;
} );

// CSS ENQUEUE
add_action( 'wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'unique-card-body-section-styles',
    get_template_directory_uri() . '/custom-blocks/unique-card-body-section/unique-card-body-section.css',
    array(),
    filemtime( get_template_directory() . '/custom-blocks/unique-card-body-section/unique-card-body-section.css' )
  );
} );