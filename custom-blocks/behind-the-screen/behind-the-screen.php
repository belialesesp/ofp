<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'behind_the_screen_register_block');
function behind_the_screen_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'behind-the-screen',
      'title'             => __('Behind The Screen'),
      'description'       => __('Block to show a Behind The Screen.'),
      'render_callback'   => 'behind_the_screen_render',
      'category'          => 'formatting',
      'icon'              => 'heart',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function behind_the_screen_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS