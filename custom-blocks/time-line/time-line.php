<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'time_line_register_block');
function time_line_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'time-line',
      'title'             => __('Time Line'),
      'description'       => __('Block to show a Time Line.'),
      'render_callback'   => 'time_line_render',
      'category'          => 'formatting',
      'icon'              => 'chart-line',
      'keywords'          => array('course', 'library', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function time_line_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// REGISTER SCRIPTS
function time_line_scripts() {
	wp_enqueue_script( 'time-line-block-style', esc_url( get_stylesheet_directory_uri() . '/custom-blocks/time-line/time-line.js' ), array('jquery'), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'time_line_scripts' );