<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'contact_form_register_block');
function contact_form_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'contact-form',
      'title'             => __('Contact Form'),
      'description'       => __('Block to show a Contact Form.'),
      'render_callback'   => 'contact_form_render',
      'category'          => 'formatting',
      'icon'              => 'feedback',
      'keywords'          => array('contact', 'image', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function contact_form_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS