<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'rotating_words_register_block');
function rotating_words_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'rotating-words',
      'title'             => __('Rotating Words'),
      'description'       => __('Block to show a Rotating Words.'),
      'render_callback'   => 'rotating_words_render',
      'category'          => 'formatting',
      'icon'              => 'heart',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function rotating_words_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS