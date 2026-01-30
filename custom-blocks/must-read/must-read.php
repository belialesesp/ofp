<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'must_read_register_block');
function must_read_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'must-read',
      'title'             => __('Must Read'),
      'description'       => __('Block to show a Must Read.'),
      'render_callback'   => 'must_read_render',
      'category'          => 'formatting',
      'icon'              => 'admin-post',
      'keywords'          => array('must', 'read', 'blog'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function must_read_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS