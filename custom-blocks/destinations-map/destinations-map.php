<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'destinations_map_register_block');
function destinations_map_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'destinations-map',
      'title'             => __('Destinations Map'),
      'description'       => __('Block to show Destinations Map.'),
      'render_callback'   => 'destinations_map_render',
      'category'          => 'formatting',
      'icon'              => 'admin-site',
      'keywords'          => array('destinations', 'destination', 'map'),
    ));
  }
}

// CUSTOM BLOCK FIELDS
add_action('acf/include_fields', function () {
  if (! function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_66c430cac3313',
    'title' => 'Destinations Map [Custom Block]',
    'fields' => array(
      array(
        'key' => 'field_66c430ea16014',
        'label' => 'Map Config',
        'name' => '',
        'aria-label' => '',
        'type' => 'accordion',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'open' => 0,
        'multi_expand' => 0,
        'endpoint' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/destinations-map',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
  ));
});

// RENDER FUNCTION FOR CUSTOM BLOCK
function destinations_map_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// REGISTER SCRIPTS FOR DESTINATIONS MAP
function destinations_map() {
	wp_enqueue_script( 'destinations-map-block-style', esc_url( get_stylesheet_directory_uri() . '/custom-blocks/destinations-map/destinations-map.js' ), array('jquery'), ofp_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'destinations_map' );