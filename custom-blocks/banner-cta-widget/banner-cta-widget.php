<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'banner_cta_widget_register_block');
function banner_cta_widget_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'banner-cta-widget',
      'title'             => __('Banner CTA widget'),
      'description'       => __('Block to show a Banner CTA widget.'),
      'render_callback'   => 'banner_cta_widget_render',
      'category'          => 'formatting',
      'icon'              => 'format-image',
      'keywords'          => array('hero', 'image', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function banner_cta_widget_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS