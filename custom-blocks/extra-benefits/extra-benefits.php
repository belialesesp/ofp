<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'extra_benefits_register_block');
function extra_benefits_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'extra-benefits',
      'title'             => __('Extra Benefits'),
      'description'       => __('Block to show a Extra Benefits.'),
      'render_callback'   => 'extra_benefits_render',
      'category'          => 'formatting',
      'icon'              => 'editor-kitchensink',
      'keywords'          => array('cards', 'favorite', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function extra_benefits_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS