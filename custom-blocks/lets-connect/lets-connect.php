<?php
// Prevent duplicate loading
if ( defined( 'LETS_CONNECT_BLOCK_FIELDS_LOADED' ) ) {
  return;
}
define( 'LETS_CONNECT_BLOCK_FIELDS_LOADED', true );

// HIDE ACCORDION IN BLOCK EDITOR
add_action( 'admin_head', 'lets_connect_admin_css' );
function lets_connect_admin_css() {
  $screen = get_current_screen();
  if ( $screen && ( $screen->is_block_editor() || $screen->base === 'post' ) ) {
    ?>
    <style>
      div.acf-field.acf-field-accordion[data-key="field_lcb_accordion"],
      .acf-field[data-key="field_lcb_accordion"] {
        display: none !important;
      }
    </style>
    <?php
  }
}

// CUSTOM BLOCK FIELDS
add_action( 'acf/include_fields', 'lets_connect_block_include_fields', 20 );
function lets_connect_block_include_fields() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  if ( acf_get_local_field_group( 'group_lets_connect_block' ) ) {
    return;
  }

  acf_add_local_field_group( array(
    'key'   => 'group_lets_connect_block',
    'title' => "Let's Connect Block",
    'fields' => array(
      array(
        'key'   => 'field_lcb_title',
        'label' => 'Title',
        'name'  => 'title',
        'type'  => 'text',
      ),
      array(
        'key'   => 'field_lcb_use_global',
        'label' => 'Use Global Settings',
        'name'  => 'use_global',
        'type'  => 'true_false',
        'ui'    => 1,
      ),
      array(
        'key'           => 'field_lcb_image',
        'label'         => 'Image',
        'name'          => 'image',
        'type'          => 'image',
        'return_format' => 'array',
        'preview_size'  => 'medium',
        'library'       => 'all',
        'wrapper'       => array( 'width' => '50' ),
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_lcb_use_global',
              'operator' => '!=',
              'value'    => '1',
            ),
          ),
        ),
      ),
      array(
        'key'          => 'field_lcb_description',
        'label'        => 'Description',
        'name'         => 'description',
        'type'         => 'wysiwyg',
        'toolbar'      => 'basic',
        'media_upload' => 0,
        'conditional_logic' => array(
          array(
            array(
              'field'    => 'field_lcb_use_global',
              'operator' => '!=',
              'value'    => '1',
            ),
          ),
        ),
      ),
      array(
        'key'          => 'field_lcb_social_medias',
        'label'        => 'Social Media Links',
        'name'         => 'social_medias',
        'type'         => 'repeater',
        'button_label' => 'Add Social Media',
        'sub_fields'   => array(), // preserved from original
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/lets-connect',
        ),
      ),
    ),
  ) );
}