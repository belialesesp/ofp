<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'about_kam_widget_register_block');
function about_kam_widget_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'about-kam-widget',
      'title'             => __('About Kam widget'),
      'description'       => __('Block to show a About Kam widget.'),
      'render_callback'   => 'about_kam_widget_render',
      'category'          => 'formatting',
      'icon'              => 'format-image',
      'keywords'          => array('hero', 'image', 'banner'),
    ));
}
}
// RENDER FUNCTION FOR CUSTOM BLOCK
function about_kam_widget_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);
  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS