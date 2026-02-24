<?php
// LETS CONNECT OPTIONS PAGE FIELDS AND FUNCTIONS

// LETS CONNECT OPTIONS PAGE FIELDS
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_lets_connect_settings',
    'title' => 'Let\'s Connect Settings',
    'fields' => array(
      array(
        'key' => 'field_lets_connect_info',
        'label' => 'Let\'s Connect Information',
        'name' => '',
        'type' => 'message',
        'message' => 'Configure the global settings for Let\'s Connect blocks. These settings will be used when the block is set to use global settings.',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array(
        'key' => 'field_lc_default_settings',
        'label' => 'Default Settings',
        'name' => '',
        'type' => 'accordion',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'open' => 1,
        'multi_expand' => 0,
        'endpoint' => 0,
      ),
      array(
        'key' => 'field_lc_title',
        'label' => 'Default Title',
        'name' => 'lc_title',
        'type' => 'text',
        'instructions' => 'Default title for Let\'s Connect blocks',
        'default_value' => 'Let\'s Connect',
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
      ),
      array(
        'key' => 'field_lc_background_color',
        'label' => 'Background Color',
        'name' => 'lc_background_color',
        'type' => 'color_picker',
        'instructions' => 'Background color for the section',
        'default_value' => '#FFF4E6',
        'wrapper' => array(
          'width' => '50',
          'class' => '',
          'id' => '',
        ),
      ),
      array(
        'key' => 'field_lc_image',
        'label' => 'Image',
        'name' => 'lc_image',
        'type' => 'image',
        'instructions' => 'Image to display in the section',
        'required' => 0,
        'conditional_logic' => 0,
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
        'key' => 'field_lc_description',
        'label' => 'Description',
        'name' => 'lc_description',
        'type' => 'wysiwyg',
        'instructions' => 'Description text',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '50',
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
        'key' => 'field_lc_social_medias',
        'label' => 'Social Media Links',
        'name' => 'lc_social_medias',
        'type' => 'repeater',
        'instructions' => 'Add social media links',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_lc_social_label',
        'min' => 0,
        'max' => 0,
        'layout' => 'block',
        'button_label' => 'Add Social Link',
        'sub_fields' => array(
          array(
            'key' => 'field_lc_social_label',
            'label' => 'Social Label',
            'name' => 'social_label',
            'type' => 'text',
            'instructions' => 'Label for the social link (e.g., "Follow us on Instagram")',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_lc_social_url',
            'label' => 'Social URL',
            'name' => 'social_url',
            'type' => 'url',
            'instructions' => 'URL for the social media profile',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_lc_social_icon',
            'label' => 'Social Icon',
            'name' => 'social_icon',
            'type' => 'icon_picker',
            'instructions' => 'Select an icon for this social link',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
            'icon_sets' => array(
              0 => 'dashicons',
            ),
            'default_value' => array(
              'type' => 'dashicons',
              'value' => 'dashicons-share',
            ),
          ),
          array(
            'key' => 'field_lc_color_icon',
            'label' => 'Icon Color',
            'name' => 'color_icon',
            'type' => 'color_picker',
            'instructions' => 'Color for the icon',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#333333',
          ),
        ),
      ),
      array(
        'key' => 'field_lc_predefined_socials',
        'label' => 'Predefined Social Networks',
        'name' => '',
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
      array(
        'key' => 'field_lc_quick_add_info',
        'label' => '',
        'name' => '',
        'type' => 'message',
        'message' => 'Use these predefined social networks for quick setup. You can customize the label, URL, and colors after adding.',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array(
        'key' => 'field_lc_predefined_list',
        'label' => 'Quick Add Social Networks',
        'name' => 'predefined_socials',
        'type' => 'checkbox',
        'instructions' => 'Check the social networks you want to add to the widget',
        'choices' => array(
          'facebook' => 'Facebook',
          'instagram' => 'Instagram',
          'twitter' => 'Twitter/X',
          'linkedin' => 'LinkedIn',
          'youtube' => 'YouTube',
          'pinterest' => 'Pinterest',
          'tiktok' => 'TikTok',
          'email' => 'Email',
        ),
        'allow_custom' => 0,
        'save_custom' => 0,
        'default_value' => array(),
        'layout' => 'horizontal',
        'toggle' => 0,
        'return_format' => 'value',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'lets-connect',
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
});

// JavaScript for Quick Add functionality
add_action('admin_footer', function() {
  $screen = get_current_screen();
  if ($screen && strpos($screen->id, 'lets-connect') !== false) {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
      // Predefined social network data
      var socialDefaults = {
        'facebook': {
          label: 'Follow us on Facebook',
          icon: 'dashicons-facebook',
          color: '#1877f2'
        },
        'instagram': {
          label: 'Follow us on Instagram',
          icon: 'dashicons-instagram',
          color: '#E4405F'
        },
        'twitter': {
          label: 'Follow us on X',
          icon: 'dashicons-twitter',
          color: '#000000'
        },
        'linkedin': {
          label: 'Connect on LinkedIn',
          icon: 'dashicons-linkedin',
          color: '#0077b5'
        },
        'youtube': {
          label: 'Subscribe on YouTube',
          icon: 'dashicons-youtube',
          color: '#FF0000'
        },
        'pinterest': {
          label: 'Follow us on Pinterest',
          icon: 'dashicons-pinterest',
          color: '#E60023'
        },
        'tiktok': {
          label: 'Follow us on TikTok',
          icon: 'dashicons-video-alt3',
          color: '#000000'
        },
        'email': {
          label: 'Email us',
          icon: 'dashicons-email',
          color: '#333333'
        }
      };

      // Handle checkbox changes
      $('input[name="predefined_socials[]"]').on('change', function() {
        var $this = $(this);
        var social = $this.val();
        
        if ($this.is(':checked') && socialDefaults[social]) {
          // Add new row to repeater
          $('.acf-field[data-name="lc_social_medias"] .acf-button').click();
          
          // Wait for new row to be added
          setTimeout(function() {
            var $newRow = $('.acf-field[data-name="lc_social_medias"] .acf-row:not(.acf-clone)').last();
            
            // Fill in the fields
            $newRow.find('[data-name="social_label"] input').val(socialDefaults[social].label);
            $newRow.find('[data-name="color_icon"] input').val(socialDefaults[social].color).trigger('change');
            
            // Note: Icon picker and URL will need to be set manually
            // Show a notice
            $newRow.css('background-color', '#fffbcc');
            setTimeout(function() {
              $newRow.css('background-color', '');
            }, 2000);
          }, 500);
          
          // Uncheck the checkbox
          $this.prop('checked', false);
        }
      });
    });
    </script>
    <?php
  }
});

// Helper function to get lets connect data
function get_lets_connect_data() {
  return array(
    'title' => get_field('lc_title', 'option') ?: 'Let\'s Connect',
    'background_color' => get_field('lc_background_color', 'option') ?: '#FFF4E6',
    'image' => get_field('lc_image', 'option'),
    'description' => get_field('lc_description', 'option'),
    'social_medias' => get_field('lc_social_medias', 'option') ?: array(),
  );
}