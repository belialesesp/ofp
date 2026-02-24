<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'sidebar_block_register_block');
function sidebar_block_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'sidebar-block',
      'title'             => __('Custom Sidebar'),
      'description'       => __('Add a custom sidebar to individual posts.'),
      'render_callback'   => 'sidebar_block_render',
      'category'          => 'formatting',
      'icon'              => 'admin-comments',
      'keywords'          => array('sidebar', 'widget', 'custom'),
    ));
  }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function sidebar_block_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS
add_action('acf/include_fields', function () {
  if (! function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_sidebar_block',
    'title' => 'Sidebar Block Fields',
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
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/sidebar-block',
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

// Function to fill select with credit card info
function load_credit_cards_options_sidebar_block($field)
{
  // Reset choices
  $field['choices'] = array();
  
  // Get all Credit Card posts
  $cards = get_posts(array(
    'post_type' => 'credit_cards',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post_status' => 'publish'
  ));
  
  if($cards) {
    foreach($cards as $card) {
      $field['choices'][$card->ID] = $card->post_title;
    }
  }
  
  return $field;
}
add_filter('acf/load_field/name=card_option', 'load_credit_cards_options_sidebar_block');