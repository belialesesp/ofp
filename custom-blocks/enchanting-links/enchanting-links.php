<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'enchanting_links_register_block');
function enchanting_links_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'enchanting-links',
      'title'             => __('Enchanting Links'),
      'description'       => __('Block to show a Enchanting Links.'),
      'render_callback'   => 'enchanting_links_render',
      'category'          => 'formatting',
      'icon'              => 'heart',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function enchanting_links_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS