<?php
/**
 * Let's Connect Block Registration
 * Location: /custom-blocks/lets-connect/lets-connect.php
 */

// Prevent duplicate loading of this specific file
if (defined('LETS_CONNECT_BLOCK_FIELDS_LOADED')) {
    return;
}
define('LETS_CONNECT_BLOCK_FIELDS_LOADED', true);

// REGISTER CUSTOM BLOCK
add_action('acf/init', 'lets_connect_register_block', 10);
function lets_connect_register_block()
{
  // Check if block is already registered
  if (acf_get_block_type('acf/lets-connect')) {
    return;
  }
  
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'lets-connect',
      'title'             => __('Lets Connect'),
      'description'       => __('Block to show a Lets Connect.'),
      'render_callback'   => 'lets_connect_render',
      'category'          => 'formatting',
      'icon'              => 'share',
      'keywords'          => array('social', 'connect', 'links'),
      'supports'          => array(
        'align' => true,
        'mode' => false,
        'jsx' => true
      ),
    ));
  }
}

// ADD ADMIN CSS TO HIDE THE ACCORDION
add_action('admin_head', 'lets_connect_admin_css');
function lets_connect_admin_css() {
    // Only load on block editor pages
    $screen = get_current_screen();
    if ($screen && ($screen->is_block_editor() || $screen->base === 'post')) {
        ?>
        <style type="text/css">
        /* Hide the unwanted accordion in Let's Connect block */
        div.acf-field.acf-field-accordion[data-key="field_lcb_accordion"] {
            display: none !important;
        }
        
        /* Alternative targeting if needed */
        .acf-field[data-key="field_lcb_accordion"] {
            display: none !important;
        }
        </style>
        <?php
    }
}

// RENDER FUNCTION FOR CUSTOM BLOCK
function lets_connect_render($block)
{
  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}

// CUSTOM BLOCK FIELDS - Use unique action name to prevent duplicates
add_action('acf/include_fields', 'lets_connect_block_include_fields', 20);
function lets_connect_block_include_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Check if field group already exists
    if (acf_get_local_field_group('group_lets_connect_block')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_lets_connect_block',
        'title' => 'Let\'s Connect Block',
        'fields' => array(
            // Title field (always visible)
            array(
                'key' => 'field_lcb_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => 'Section title',
                'default_value' => 'Let\'s Connect',
            ),
            
            // Widget Mode toggle
            array(
                'key' => 'field_lcb_use_global',
                'label' => 'Widget Mode',
                'name' => 'use_global',
                'type' => 'true_false',
                'instructions' => 'Use settings from Theme Options > Let\'s Connect',
                'ui' => 1,
                'ui_on_text' => 'Widget',
                'ui_off_text' => 'Block',
                'default_value' => 0,
            ),
            
            // Lets Connect accordion (shows when use_global is OFF)
            array(
                'key' => 'field_lcb_accordion',
                'label' => 'Lets Connect',
                'name' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_lcb_use_global',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            
            array(
                'key' => 'field_lcb_background_color',
                'label' => 'Background Color',
                'name' => 'background_color',
                'type' => 'color_picker',
                'instructions' => 'Background color for the section',
                'default_value' => '#FFF4E6',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_lcb_use_global',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
            ),
            
            array(
                'key' => 'field_lcb_image',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'instructions' => 'Image to display alongside the content',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_lcb_use_global',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            
            array(
                'key' => 'field_lcb_description',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'wysiwyg',
                'instructions' => 'Description text',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_lcb_use_global',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ),
            
            array(
                'key' => 'field_lcb_social_medias',
                'label' => 'Social Media Links',
                'name' => 'social_medias',
                'type' => 'repeater',
                'instructions' => 'Add social media links',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_lcb_use_global',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'collapsed' => 'field_lcb_social_label',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Social Link',
                'sub_fields' => array(
                    array(
                        'key' => 'field_lcb_social_label',
                        'label' => 'Social Label',
                        'name' => 'social_label',
                        'type' => 'text',
                        'instructions' => 'Label for the social link',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_lcb_social_url',
                        'label' => 'Social URL',
                        'name' => 'social_url',
                        'type' => 'url',
                        'instructions' => 'URL for the social media profile',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_lcb_social_icon',
                        'label' => 'Social Icon',
                        'name' => 'social_icon',
                        'type' => 'icon_picker',
                        'instructions' => 'Select an icon or paste an SVG URL/code in the URL field for custom icons (e.g., TikTok)',
                        'required' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'icon_sets' => array(
                            'dashicons',
                        ),
                        'default_value' => array(
                            'type' => 'dashicons',
                            'value' => 'dashicons-share',
                        ),
                        'return_format' => 'array', // Ensure array format
                    ),
                    array(
                        'key' => 'field_lcb_color_icon',
                        'label' => 'Icon Color',
                        'name' => 'color_icon',
                        'type' => 'color_picker',
                        'instructions' => 'Color for the icon',
                        'required' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#333333',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/lets-connect',
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
    ));
}

// Add debugging function to check icon picker values
add_action('admin_footer', 'lets_connect_debug_script');
function lets_connect_debug_script() {
    $screen = get_current_screen();
    if ($screen && $screen->is_block_editor()) {
        ?>
        <script type="text/javascript">
        (function($) {
            // Debug icon picker changes
            $(document).on('change', '[data-key="field_lcb_social_icon"] input', function() {
                console.log('Icon picker value changed:', $(this).val());
            });
        })(jQuery);
        </script>
        <?php
    }
}