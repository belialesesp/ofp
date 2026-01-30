<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'instagram_cb_register_block');
function instagram_cb_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'instagram-cb',
      'title'             => __('Instagram'),
      'description'       => __('Block to show a Instagram.'),
      'render_callback'   => 'instagram_cb_render',
      'category'          => 'formatting',
      'icon'              => 'instagram',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function instagram_cb_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS