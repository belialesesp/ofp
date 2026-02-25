<?php
/**
 * OFP Calculator — block registration is handled by index.php via register_custom_block().
 * This file defines the ACF field group and enqueues block-specific assets.
 */

// ACF FIELDS
add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_ofp_calculator',
    'title' => 'Points Calculator [Custom Block]',
    'fields' => array(
      array(
        'key'          => 'field_ofp_calculator_accordion',
        'label'        => 'Points Calculator',
        'name'         => '',
        'aria-label'   => '',
        'type'         => 'accordion',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'open'         => 0,
        'multi_expand' => 0,
        'endpoint'     => 0,
      ),
      array(
        'key'          => 'field_ofp_calculator_content_tab',
        'label'        => 'Content',
        'name'         => '',
        'aria-label'   => '',
        'type'         => 'tab',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'placement'    => 'top',
        'endpoint'     => 0,
        'selected'     => 0,
      ),
      array(
        'key'          => 'field_ofp_calculator_show_logo',
        'label'        => 'Display Logo',
        'name'         => 'show_logo',
        'aria-label'   => '',
        'type'         => 'true_false',
        'instructions' => 'Show the OFP logo above the calculator',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'message'      => '',
        'default_value' => 1,
        'ui_on_text'   => 'Yes',
        'ui_off_text'  => 'No',
        'ui'           => 1,
      ),
      array(
        'key'          => 'field_ofp_calculator_logo',
        'label'        => 'Custom Logo',
        'name'         => 'custom_logo',
        'aria-label'   => '',
        'type'         => 'image',
        'instructions' => 'Upload a custom logo (leave empty to use default site logo)',
        'required'     => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_ofp_calculator_show_logo',
              'operator' => '==',
              'value'    => 1,
            ),
          ),
        ),
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'return_format' => 'array',
        'library'      => 'all',
        'min_width'    => '',
        'min_height'   => '',
        'min_size'     => '',
        'max_width'    => '',
        'max_height'   => '',
        'max_size'     => '',
        'mime_types'   => '',
        'preview_size' => 'medium',
      ),
      array(
        'key'          => 'field_ofp_calculator_settings_tab',
        'label'        => 'Settings',
        'name'         => '',
        'aria-label'   => '',
        'type'         => 'tab',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'placement'    => 'top',
        'endpoint'     => 0,
        'selected'     => 0,
      ),
      array(
        'key'          => 'field_ofp_calculator_background_type',
        'label'        => 'Background Type',
        'name'         => 'background_type',
        'aria-label'   => '',
        'type'         => 'select',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => 0,
        'wrapper'      => array( 'width' => '', 'class' => '', 'id' => '' ),
        'choices'      => array(
          'color'    => 'Color',
          'gradient' => 'Gradient',
        ),
        'default_value' => 'gradient',
        'return_format' => 'value',
        'multiple'     => 0,
        'allow_null'   => 0,
        'ui'           => 0,
      ),
      array(
        'key'          => 'field_ofp_calculator_background_color',
        'label'        => 'Background Color',
        'name'         => 'background_color',
        'aria-label'   => '',
        'type'         => 'color_picker',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_ofp_calculator_background_type',
              'operator' => '==',
              'value'    => 'color',
            ),
          ),
        ),
        'wrapper'        => array( 'width' => '', 'class' => '', 'id' => '' ),
        'default_value'  => '#6496c8',
        'enable_opacity' => 0,
        'return_format'  => 'string',
      ),
      array(
        'key'          => 'field_ofp_calculator_background_color_start',
        'label'        => 'Background Color Start',
        'name'         => 'background_color_start',
        'aria-label'   => '',
        'type'         => 'color_picker',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_ofp_calculator_background_type',
              'operator' => '==',
              'value'    => 'gradient',
            ),
          ),
        ),
        'wrapper'        => array( 'width' => '33.333', 'class' => '', 'id' => '' ),
        'default_value'  => '#9abfcc',
        'enable_opacity' => 0,
        'return_format'  => 'string',
      ),
      array(
        'key'          => 'field_ofp_calculator_background_color_end',
        'label'        => 'Background Color End',
        'name'         => 'background_color_end',
        'aria-label'   => '',
        'type'         => 'color_picker',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_ofp_calculator_background_type',
              'operator' => '==',
              'value'    => 'gradient',
            ),
          ),
        ),
        'wrapper'        => array( 'width' => '33.333', 'class' => '', 'id' => '' ),
        'default_value'  => '#d3eff4',
        'enable_opacity' => 0,
        'return_format'  => 'string',
      ),
      array(
        'key'          => 'field_ofp_calculator_rotation_deg',
        'label'        => 'Rotation (Deg) (0-360)',
        'name'         => 'rotation_deg',
        'aria-label'   => '',
        'type'         => 'number',
        'instructions' => '',
        'required'     => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_ofp_calculator_background_type',
              'operator' => '==',
              'value'    => 'gradient',
            ),
          ),
        ),
        'wrapper'       => array( 'width' => '33.333', 'class' => '', 'id' => '' ),
        'default_value' => 135,
        'min'           => 0,
        'max'           => 360,
        'step'          => 1,
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/ofp-calculator',
        ),
      ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => '',
    'show_in_rest'          => 0,
  ) );
} );

// ENQUEUE BOOTSTRAP (only if not already loaded)
add_action( 'wp_enqueue_scripts', function () {
  global $wp_styles;
  $bootstrap_loaded = false;
  foreach ( $wp_styles->registered as $style ) {
    if ( strpos( $style->src, 'bootstrap' ) !== false ) {
      $bootstrap_loaded = true;
      break;
    }
  }
  if ( ! $bootstrap_loaded ) {
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3.0' );
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true );
  }
} );

// ENQUEUE FONT AWESOME (only if not already loaded)
add_action( 'wp_enqueue_scripts', function () {
  global $wp_styles;
  $fa_loaded = false;
  foreach ( $wp_styles->registered as $style ) {
    if ( strpos( $style->src, 'font-awesome' ) !== false || strpos( $style->src, 'fontawesome' ) !== false ) {
      $fa_loaded = true;
      break;
    }
  }
  if ( ! $fa_loaded ) {
    wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
  }
} );