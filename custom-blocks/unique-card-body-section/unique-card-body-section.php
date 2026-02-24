<?php
error_log('UNIQUE CARD BODY SECTION PHP CARREGADO');

// REGISTER CUSTOM BLOCK
add_action('acf/init', 'unique_card_body_section_register_block');
function unique_card_body_section_register_block()
{
  error_log('TENTANDO REGISTRAR BLOCO UNIQUE CARD BODY SECTION');
  
  if (function_exists('acf_register_block')) {
    error_log('ACF REGISTER BLOCK EXISTE - REGISTRANDO');
    acf_register_block(array(
      'name'              => 'unique-card-body-section',
      'title'             => __('Unique Card Body Section'),
      'description'       => __('Block to show a Unique Card Body Section.'),
      'render_callback'   => 'unique_card_body_section_render',
      'category'          => 'formatting',
      'icon'              => 'money-alt',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  } else {
    error_log('ACF REGISTER BLOCK NAO EXISTE');
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function unique_card_body_section_render($block)
{
  $slug = str_replace('acf/', '', $block['name']);

  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// FUNCTION TO FILL SELECT WITH CREDIT CARDS FROM CPT
function load_credit_cards_options_unique_card_body_section($field)
{
  // Reset choices
  $field['choices'] = array();
  
  // Query credit cards CPT
  $args = array(
    'post_type'      => 'credit_cards',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'title',
    'order'          => 'ASC'
  );
  
  $credit_cards = get_posts($args);
  
  if ($credit_cards) {
    foreach ($credit_cards as $card) {
      $field['choices'][$card->ID] = $card->post_title;
    }
  }
  
  return $field;
}
add_filter('acf/load_field/name=card_to_show', 'load_credit_cards_options_unique_card_body_section');

function unique_card_body_section_enqueue_styles() {
  wp_enqueue_style(
    'unique-card-body-section-styles',
    get_template_directory_uri() . '/custom-blocks/unique-card-body-section/unique-card-body-section.css',
    array(),
    filemtime(get_template_directory() . '/custom-blocks/unique-card-body-section/unique-card-body-section.css')
  );
}
add_action('wp_enqueue_scripts', 'unique_card_body_section_enqueue_styles');