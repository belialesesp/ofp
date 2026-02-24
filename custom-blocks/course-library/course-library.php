<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'course_library_register_block');
function course_library_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'course-library',
      'title'             => __('Course Library'),
      'description'       => __('Block to show a Course Library.'),
      'render_callback'   => 'course_library_render',
      'category'          => 'formatting',
      'icon'              => 'category',
      'keywords'          => array('course', 'library', 'banner'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function course_library_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// REGISTER SCRIPTS
function course_library_scripts() {
	wp_enqueue_script( 'course-library-block-style', esc_url( get_stylesheet_directory_uri() . '/custom-blocks/course-library/course-library.js' ), array('jquery'), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'course_library_scripts' );