<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'about_kam_register_block');
function about_kam_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'about-kam',
      'title'             => __('About Kam'),
      'description'       => __('Block to show a About Kam.'),
      'render_callback'   => 'about_kam_render',
      'category'          => 'formatting',
      'icon'              => 'smiley',
      'keywords'          => array('social', 'about', 'links'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function about_kam_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS
