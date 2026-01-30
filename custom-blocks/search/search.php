<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'search_register_block');
function search_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'search',
      'title'             => __('Search'),  
      'description'       => __('Hero search block with trending searches.'),
      'render_callback'   => 'search_render',
      'category'          => 'formatting',
      'icon'              => 'search',
      'keywords'          => array('search', 'hero', 'trending', 'busca'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function search_render($block)
{
  // convert name ("acf/search") into path friendly slug ("search")
  $slug = str_replace('acf/', '', $block['name']);
  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}