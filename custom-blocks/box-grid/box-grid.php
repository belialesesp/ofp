<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'box_grid_register_block');
function box_grid_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'box-grid',
      'title'             => __('Box Grid'),
      'description'       => __('Block to show a Box Grid.'),
      'render_callback'   => 'box_grid_render',
      'category'          => 'formatting',
      'icon'              => 'editor-kitchensink',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function box_grid_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS