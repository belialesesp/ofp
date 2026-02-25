
<?php
// CUSTOM BLOCK FIELDS
add_action( 'acf/include_fields', function () {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  // Field group definition is preserved exactly as-is from the original file.
  // Only the register_block and render function boilerplate has been removed.
  acf_add_local_field_group( array(
    'key'   => 'group_sidebar_block',
    'title' => 'Custom Sidebar Block',
    'fields' => array(
      array(
        'key' => 'field_sidebar_widgets',
        'label' => 'Sidebar Widgets',
        'name' => 'sidebar_widgets',
        'type' => 'repeater',
        'instructions' => 'Add widgets to your sidebar',
        'min' => 1,
        'layout' => 'block',
        'button_label' => 'Add Widget',
        'sub_fields' => array(
          array(
            'key' => 'field_sidebar_widget_type',
            'label' => 'Widget Type',
            'name' => 'widget_type',
            'type' => 'select',
            'instructions' => 'Select the type of widget',
            'choices' => array(
              'about_kam' => 'About Kam Widget',
              'banner_cta' => 'Banner CTA Widget',
              'favorite_cards' => 'Favorite Cards Widget'
            ),
            'default_value' => 'about_kam',
          ),
          // About Kam Widget Fields
          array(
            'key' => 'field_sidebar_about_title',
            'label' => 'Title',
            'name' => 'about_title',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'about_kam',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_about_description',
            'label' => 'Description',
            'name' => 'about_description',
            'type' => 'wysiwyg',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'about_kam',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_about_image',
            'label' => 'Image',
            'name' => 'about_image',
            'type' => 'image',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'about_kam',
                ),
              ),
            ),
            'return_format' => 'array',
          ),
          // Banner CTA Widget Fields
          array(
            'key' => 'field_sidebar_banner_icon',
            'label' => 'Icon',
            'name' => 'banner_icon',
            'type' => 'image',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
            'return_format' => 'array',
          ),
          array(
            'key' => 'field_sidebar_banner_title',
            'label' => 'Title',
            'name' => 'banner_title',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_banner_description',
            'label' => 'Description',
            'name' => 'banner_description',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_banner_cta_label',
            'label' => 'CTA Label',
            'name' => 'banner_cta_label',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_banner_cta_url',
            'label' => 'CTA URL',
            'name' => 'banner_cta_url',
            'type' => 'url',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_banner_background',
            'label' => 'Background Image',
            'name' => 'banner_background',
            'type' => 'image',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'banner_cta',
                ),
              ),
            ),
            'return_format' => 'array',
          ),
          // Favorite Cards Widget Fields
          array(
            'key' => 'field_sidebar_cards_title_1',
            'label' => 'Title Line 1',
            'name' => 'cards_title_1',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_cards_title_2',
            'label' => 'Title Line 2',
            'name' => 'cards_title_2',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_cards_image',
            'label' => 'Left Image',
            'name' => 'cards_image',
            'type' => 'image',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
            'return_format' => 'array',
          ),
          array(
            'key' => 'field_sidebar_cards_list',
            'label' => 'Cards',
            'name' => 'cards_list',
            'type' => 'repeater',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
            'min' => 1,
            'layout' => 'table',
            'button_label' => 'Add Card',
            'sub_fields' => array(
array(
  'key' => 'field_sidebar_card_option',
  'label' => 'Card Option',
  'name' => 'card_option',
  'type' => 'post_object',
  'instructions' => '',
  'post_type' => array('credit_cards'),
  'return_format' => 'id',
  'ui' => 1,
  'allow_null' => 0,
  'multiple' => 0,
),
            ),
          ),
          array(
            'key' => 'field_sidebar_cards_cta_label',
            'label' => 'CTA Label',
            'name' => 'cards_cta_label',
            'type' => 'text',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
          ),
          array(
            'key' => 'field_sidebar_cards_cta_url',
            'label' => 'CTA URL',
            'name' => 'cards_cta_url',
            'type' => 'url',
            'instructions' => '',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_sidebar_widget_type',
                  'operator' => '==',
                  'value' => 'favorite_cards',
                ),
              ),
            ),
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param'    => 'block',
          'operator' => '==',
          'value'    => 'acf/sidebar-block',
        ),
      ),
    ),
  ) );
} );