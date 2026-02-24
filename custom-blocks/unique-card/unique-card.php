<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'unique_card_register_block');
function unique_card_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'unique-card',
      'title'             => __('Unique Card'),
      'description'       => __('Block to show a Unique Card.'),
      'render_callback'   => 'unique_card_render',
      'category'          => 'formatting',
      'icon'              => 'money-alt',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function unique_card_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS

// FUNCTION TO FILL SELECT WITH CREDIT CARD INFO
function load_credit_cards_options_unique_card($field)
{
  // Reset choices
  $field['choices'] = array();
  // Check to see if Repeater has rows of data to loop over
  if (have_rows('credit_cards', 'option')) {
    // Execute repeatedly as long as the below statement is true
    $index = 0;
    while (have_rows('credit_cards', 'option')) {
      // Return an array with all values after the loop is complete
      the_row();
      // Variables
      $value = $index;
      $label = get_sub_field('cci_card_name');
      // Append to choices
      $field['choices'][$value] = $label;
      $index++;
    }
  }
  // Return the field
  return $field;
}
add_filter('acf/load_field/name=card_to_show', 'load_credit_cards_options_unique_card');

function unique_card_enqueue_styles() {
  wp_enqueue_style(
    'unique-card-styles',
    get_template_directory_uri() . '/custom-blocks/unique-card/unique-card.css',
    array(),
    filemtime(get_template_directory() . '/custom-blocks/unique-card/unique-card.css')
  );
}
add_action('wp_enqueue_scripts', 'unique_card_enqueue_styles');