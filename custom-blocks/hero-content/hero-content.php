<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'hero_content_register_block');
function hero_content_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'hero-content',
      'title'             => __('Hero Content'),
      'description'       => __('Block to show a Hero Content.'),
      'render_callback'   => 'hero_content_render',
      'category'          => 'formatting',
      'icon'              => 'schedule',
      'keywords'          => array('hero', 'image', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function hero_content_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS