<?php
// REGISTER CUSTOM BLOCK
add_action('acf/init', 'credit_cards_register_block');
function credit_cards_register_block()
{
  if (function_exists('acf_register_block')) {
    acf_register_block(array(
      'name'              => 'credit-cards',
      'title'             => __('Credit Cards'),
      'description'       => __('Block to show credit cards referals.'),
      'render_callback'   => 'credit_cards_render',
      'category'          => 'formatting',
      'icon'              => 'money-alt',
      'keywords'          => array('credit', 'cards', 'quote'),
    ));
  }
}

// CUSTOM BLOCK FIELDS
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_66b8447f1fb12',
	'title' => 'Credit Cards - Custom Block',
	'fields' => array(
		array(
			'key' => 'field_66b8486e82b2b',
			'label' => 'Credit Card Config',
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
			'open' => 1,
			'multi_expand' => 0,
			'endpoint' => 0,
		),
		array(
			'key' => 'field_66b8447fa0590',
			'label' => 'Card Stye',
			'name' => 'ccb_card_stye',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'large' => 'Large',
				'medium' => 'Medium',
				'small' => 'Small',
			),
			'default_value' => 'Large',
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
		),
		array(
			'key' => 'field_66b8480ffefd7',
			'label' => 'Credit Card',
			'name' => 'ccb_credit_card',
			'aria-label' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(),
			'default_value' => false,
			'return_format' => 'value',
			'multiple' => 0,
			'allow_null' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/credit-cards',
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
) );
} );


// RENDER FUNCTION FOR CUSTOM BLOCK
function credit_cards_render($block)
{

  // convert name ("acf/block") into path friendly slug ("block")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from folder
  if (file_exists(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"))) {
    include(get_theme_file_path("/custom-blocks/{$slug}/{$slug}-template.php"));
  }
}