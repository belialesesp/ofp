<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'start_here_register_block');
function start_here_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'start-here',
      'title'             => __('Start Here'),
      'description'       => __('Block to show a Start Here.'),
      'render_callback'   => 'start_here_render',
      'category'          => 'formatting',
      'icon'              => 'editor-spellcheck',
      'keywords'          => array('start', 'here', 'content'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function start_here_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS