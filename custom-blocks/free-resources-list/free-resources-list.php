<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'free_resources_list_register_block');
function free_resources_list_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'free-resources-list',
      'title'             => __('Free Resources List'),
      'description'       => __('Block to show a Free Resources List.'),
      'render_callback'   => 'free_resources_list_render',
      'category'          => 'formatting',
      'icon'              => 'welcome-learn-more',
      'keywords'          => array('resources', 'free', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function free_resources_list_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS