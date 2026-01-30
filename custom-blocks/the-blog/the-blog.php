<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'the_blog_register_block');
function the_blog_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'the-blog',
      'title'             => __('The Blog'),
      'description'       => __('Block to show a The Blog.'),
      'render_callback'   => 'the_blog_render',
      'category'          => 'formatting',
      'icon'              => 'format-quote',
      'keywords'          => array('blog', 'post', 'destinations'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function the_blog_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS
