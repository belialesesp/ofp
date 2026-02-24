<?php
// SUCCESS STORIES OPTIONS PAGE FIELDS AND FUNCTIONS

// FUNCTION TO FILL SELECT WITH SUCCESS STORY INFO
function load_success_stories_options($field)
{
  // Reset choices
  $field['choices'] = array();
  
  // Add empty option for single select
  if ($field['name'] === 'ssb_success_story') {
      $field['choices'][''] = '-- Select Success Story --';
  }
  
  // Check to see if Repeater has rows of data to loop over
  if (have_rows('success_stories', 'option')) {
    // Execute repeatedly as long as the below statement is true
    $index = 0;
    while (have_rows('success_stories', 'option')) {
      // Return an array with all values after the loop is complete
      the_row();
      // Variables
      $value = $index;
      $author = get_sub_field('ssi_author');
      $preview = substr(get_sub_field('ssi_story'), 0, 50) . '...';
      $label = $author . ' - ' . $preview;
      // Append to choices
      $field['choices'][$value] = $label;
      $index++;
    }
  }
  // Return the field
  return $field;
}
add_filter('acf/load_field/name=ssb_success_story', 'load_success_stories_options');
add_filter('acf/load_field/name=ssb_success_stories_multiple', 'load_success_stories_options');


// SHOWING CUSTOM FORM FIELDS
function show_import_success_stories_metabox()
{
  global $post;

  if (!function_exists('get_current_screen')) return false;

  // vars
  $current_screen = get_current_screen();
  $current_screen_id = $current_screen->id;
?>
  
<?php
}



// SUCCESS STORIES OPTIONS PAGE FIELDS
add_action('acf/include_fields', function () {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(array(
    'key' => 'group_success_stories_settings',
    'title' => 'Success Stories Settings',
    'fields' => array(
      array(
        'key' => 'field_success_stories_info',
        'label' => 'Success Stories Information',
        'name' => '',
        'type' => 'message',
        'message' => 'Add success stories here that can be used throughout the site.',
        'new_lines' => 'wpautop',
        'esc_html' => 0,
      ),
      array(
        'key' => 'field_success_stories',
        'label' => 'Success Stories',
        'name' => 'success_stories',
        'type' => 'repeater',
        'instructions' => 'Add success stories that can be displayed in any Success Stories block',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_ssi_author',
        'min' => 0,
        'max' => 0,
        'layout' => 'block',
        'button_label' => 'Add Success Story',
        'sub_fields' => array(
          array(
            'key' => 'field_ssi_author',
            'label' => 'Author Name',
            'name' => 'ssi_author',
            'type' => 'text',
            'instructions' => 'Name of the person giving the testimonial',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
          ),
          array(
            'key' => 'field_ssi_author_color',
            'label' => 'Author Color / Border Color',
            'name' => 'ssi_author_color',
            'type' => 'color_picker',
            'instructions' => 'Color for the author text and image border',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '50',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#61a7af',
          ),
          array(
            'key' => 'field_ssi_image',
            'label' => 'Author Image',
            'name' => 'ssi_image',
            'type' => 'image',
            'instructions' => 'Photo of the testimonial author',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
          ),
          array(
            'key' => 'field_ssi_story',
            'label' => 'Success Story',
            'name' => 'ssi_story',
            'type' => 'textarea',
            'instructions' => 'The testimonial or success story content',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '67',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => 4,
            'new_lines' => 'br',
          ),
          array(
            'key' => 'field_ssi_date',
            'label' => 'Date',
            'name' => 'ssi_date',
            'type' => 'date_picker',
            'instructions' => 'When was this testimonial given?',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'display_format' => 'F j, Y',
            'return_format' => 'Y-m-d',
            'first_day' => 0,
          ),
          array(
            'key' => 'field_ssi_featured',
            'label' => 'Featured Story',
            'name' => 'ssi_featured',
            'type' => 'true_false',
            'instructions' => 'Mark as featured to prioritize in displays',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '33',
              'class' => '',
              'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 1,
            'ui_on_text' => 'Featured',
            'ui_off_text' => 'Standard',
          ),
          array(
            'key' => 'field_ssi_position',
            'label' => 'Author Position/Company',
            'name' => 'ssi_position',
            'type' => 'text',
            'instructions' => 'Optional: Job title or company',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '34',
              'class' => '',
              'id' => '',
            ),
          ),
        ),
      ),
      array(
        'key' => 'field_ss_widget_settings',
        'label' => 'Widget Default Settings',
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
        'key' => 'field_widget_title',
        'label' => 'Widget Default Title',
        'name' => 'widget_title',
        'type' => 'text',
        'instructions' => 'Default title when used as a widget',
        'default_value' => 'Success Stories',
      ),
      array(
        'key' => 'field_widget_stories',
        'label' => 'Widget Stories Selection',
        'name' => 'widget_stories',
        'type' => 'select',
        'instructions' => 'Which stories to show in widget mode',
        'choices' => array(
          'all' => 'All Stories',
          'featured' => 'Featured Only',
          'recent' => 'Most Recent (5)',
          'random' => 'Random (3)',
        ),
        'default_value' => 'featured',
        'allow_null' => 0,
        'multiple' => 0,
        'ui' => 0,
        'ajax' => 0,
      ),
      array(
        'key' => 'field_widget_background_type',
        'label' => 'Widget Background Type',
        'name' => 'widget_background_type',
        'type' => 'radio',
        'choices' => array(
          'gradient' => 'Gradient',
          'solid' => 'Solid Color',
        ),
        'default_value' => 'gradient',
        'layout' => 'horizontal',
      ),
      array(
        'key' => 'field_widget_rotation_deg',
        'label' => 'Widget Gradient Rotation',
        'name' => 'widget_rotation_deg',
        'type' => 'range',
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_widget_background_type',
              'operator' => '==',
              'value' => 'gradient',
            ),
          ),
        ),
        'default_value' => 0,
        'min' => 0,
        'max' => 360,
        'step' => 1,
        'append' => 'deg',
      ),
      array(
        'key' => 'field_widget_background_color_start',
        'label' => 'Widget Gradient Start Color',
        'name' => 'widget_background_color_start',
        'type' => 'color_picker',
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_widget_background_type',
              'operator' => '==',
              'value' => 'gradient',
            ),
          ),
        ),
        'default_value' => '#f1f1f1',
      ),
      array(
        'key' => 'field_widget_background_color_end',
        'label' => 'Widget Gradient End Color',
        'name' => 'widget_background_color_end',
        'type' => 'color_picker',
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_widget_background_type',
              'operator' => '==',
              'value' => 'gradient',
            ),
          ),
        ),
        'default_value' => '#ffffff',
      ),
      array(
        'key' => 'field_widget_background_color',
        'label' => 'Widget Background Color',
        'name' => 'widget_background_color',
        'type' => 'color_picker',
        'conditional_logic' => array(
          array(
            array(
              'field' => 'field_widget_background_type',
              'operator' => '==',
              'value' => 'solid',
            ),
          ),
        ),
        'default_value' => '#f1f1f1',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'success-stories',
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



// Helper function to get success stories for widget mode
function get_widget_success_stories() {
  $widget_stories_mode = get_field('widget_stories', 'option');
  $all_stories = get_field('success_stories', 'option');
  
  if (!$all_stories) return array();
  
  switch ($widget_stories_mode) {
    case 'featured':
      return array_filter($all_stories, function($story) {
        return !empty($story['ssi_featured']);
      });
      
    case 'recent':
      // Sort by date and return 5 most recent
      usort($all_stories, function($a, $b) {
        $date_a = !empty($a['ssi_date']) ? strtotime($a['ssi_date']) : 0;
        $date_b = !empty($b['ssi_date']) ? strtotime($b['ssi_date']) : 0;
        return $date_b - $date_a;
      });
      return array_slice($all_stories, 0, 5);
      
    case 'random':
      shuffle($all_stories);
      return array_slice($all_stories, 0, 3);
      
    case 'all':
    default:
      return $all_stories;
  }
}