<?php
// POPULATE SELECT WITH CREDIT CARD INFO (from options repeater)
function load_credit_cards_options_unique_card( $field ) {
  $field['choices'] = array();

  if ( have_rows( 'credit_cards', 'option' ) ) {
    $index = 0;
    while ( have_rows( 'credit_cards', 'option' ) ) {
      the_row();
      $field['choices'][ $index ] = get_sub_field( 'cci_card_name' );
      $index++;
    }
  }

  return $field;
}
add_filter( 'acf/load_field/name=card_to_show', 'load_credit_cards_options_unique_card' );

// ENQUEUE BLOCK STYLES
function unique_card_enqueue_styles() {
  wp_enqueue_style(
    'unique-card-styles',
    get_template_directory_uri() . '/custom-blocks/unique-card/unique-card.css',
    array(),
    filemtime( get_template_directory() . '/custom-blocks/unique-card/unique-card.css' )
  );
}
add_action( 'wp_enqueue_scripts', 'unique_card_enqueue_styles' );