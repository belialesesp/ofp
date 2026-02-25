<?php
// POPULATE SELECT WITH CREDIT CARDS FROM CPT
function load_credit_cards_options_favorite_cards( $field ) {
  $field['choices'] = array();

  $cards = get_posts( array(
    'post_type'      => 'credit_cards',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
    'post_status'    => 'publish',
  ) );

  if ( $cards ) {
    foreach ( $cards as $card ) {
      $field['choices'][ $card->ID ] = $card->post_title;
    }
  }

  return $field;
}
add_filter( 'acf/load_field/name=fc_card_option', 'load_credit_cards_options_favorite_cards' );

// CUSTOM BLOCK FIELDS
add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_66cd51690090b',
    'title' => 'Favorite Cards [Custom Block]',
    'fields' => array(
      array(
        'key'   => 'field_66cd5169c433c',
        'label' => 'My Favorite Cards',
        'name'  => '',
        'type'  => 'accordion',
        'open'  => 0,
        'multi_expand' => 0,
        'endpoint' => 0,
      ),
      array(
        'key'   => 'field_67c09af3d9a64',
        'label' => 'Content',
        'name'  => '',
        'type'  => 'tab',
        'placement' => 'top',
        'endpoint'  => 0,
        'selected'  => 0,
      ),
      array(
        'key'   => 'field_66df5dc324a76',
        'label' => 'Is Widget?',
        'name'  => 'is_widget',
        'type'  => 'true_false',
        'default_value' => 0,
        'ui_on_text'    => 'Yes',
        'ui_off_text'   => 'No',
        'ui'            => 1,
      ),
      array(
        'key'   => 'field_66cd51bcc433f',
        'label' => 'Title [line 1]',
        'name'  => 'title_line_1',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_66cd51f0c4340',
        'label' => 'Title [line 2]',
        'name'  => 'title_line_2',
        'type'  => 'text',
      ),
      array(
        'key'           => 'field_66cd51fbc4341',
        'label'         => 'Left Image',
        'name'          => 'left_image',
        'type'          => 'image',
        'return_format' => 'array',
        'library'       => 'all',
        'preview_size'  => 'medium',
      ),
      array(
        'key'          => 'field_66cd518bc433d',
        'label'        => 'Favorite Cards',
        'name'         => 'favorite_cards',
        'type'         => 'repeater',
        'layout'       => 'table',
        'button_label' => 'Add Row',
        'sub_fields'   => array(
          array(
            'key'           => 'field_66cd5198c433e',
            'label'         => 'Card Option',
            'name'          => 'fc_card_option',
            'type'          => 'post_object',
            'post_type'     => array( 'credit_cards' ),
            'return_format' => 'id',
            'ui'            => 1,
            'allow_null'    => 0,
            'multiple'      => 0,
            'parent_repeater' => 'field_66cd518bc433d',
          ),
        ),
      ),
      array(
        'key'   => 'field_66cd55e90f105',
        'label' => 'CTA Label',
        'name'  => 'cta_label',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_66cd55f70f106',
        'label' => 'CTA URL',
        'name'  => 'cta_url',
        'type'  => 'text',
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/favorite-cards',
        ),
      ),
    ),
  ) );
} );