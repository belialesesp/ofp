<?php
/**
 * CTA Block
 *
 * A reusable Call-to-Action block with eyebrow, title, description, button,
 * and configurable background (color, image, gradient).
 *
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Cta extends OFP_Block_Base {

	protected string $name        = 'cta';
	protected string $title       = 'CTA';
	protected string $description = 'Call-to-Action block with title, description, and button.';
	protected string $icon        = 'megaphone';
	protected array  $keywords    = [ 'cta', 'call to action', 'button', 'promo' ];

	/**
	 * Register block and its fields.
	 */
	public function register(): void {
		parent::register();
		$this->register_fields();
	}

	/**
	 * Register ACF field group programmatically.
	 */
	protected function register_fields(): void {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( [
			'key'    => 'group_cta',
			'title'  => 'CTA',
			'fields' => [
				// Content
				[
					'key'   => 'field_cta_eyebrow',
					'label' => 'Eyebrow',
					'name'  => 'eyebrow',
					'type'  => 'text',
					'instructions' => 'Small text displayed above the title.',
				],
				[
					'key'   => 'field_cta_title',
					'label' => 'Title',
					'name'  => 'title',
					'type'  => 'text',
				],
				[
					'key'          => 'field_cta_description',
					'label'        => 'Description',
					'name'         => 'description',
					'type'         => 'wysiwyg',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				],
				// Button
				[
					'key'   => 'field_cta_button_label',
					'label' => 'Button Label',
					'name'  => 'button_label',
					'type'  => 'text',
				],
				[
					'key'  => 'field_cta_button_url',
					'label' => 'Button URL',
					'name'  => 'button_url',
					'type'  => 'url',
				],
				[
					'key'           => 'field_cta_button_new_tab',
					'label'         => 'Open in new tab',
					'name'          => 'button_new_tab',
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 1,
				],
				// Colors
				[
					'key'           => 'field_cta_text_color',
					'label'         => 'Text Color',
					'name'          => 'text_color',
					'type'          => 'color_picker',
					'default_value' => '#2b2b2b',
				],
				[
					'key'           => 'field_cta_button_color',
					'label'         => 'Button Color',
					'name'          => 'button_color',
					'type'          => 'color_picker',
					'default_value' => '#BED8BA',
				],
				[
					'key'           => 'field_cta_button_text_color',
					'label'         => 'Button Text Color',
					'name'          => 'button_text_color',
					'type'          => 'color_picker',
					'default_value' => '#2b2b2b',
				],
				// Background
				[
					'key'           => 'field_cta_background_type',
					'label'         => 'Background Type',
					'name'          => 'background_type',
					'type'          => 'select',
					'choices'       => [
						'color'    => 'Solid Color',
						'image'    => 'Image',
						'gradient' => 'Gradient',
					],
					'default_value' => 'color',
					'allow_null'    => 0,
				],
				[
					'key'               => 'field_cta_background_color',
					'label'             => 'Background Color',
					'name'              => 'background_color',
					'type'              => 'color_picker',
					'default_value'     => '#F7F0E5',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_cta_background_type',
								'operator' => '==',
								'value'    => 'color',
							],
						],
					],
				],
				[
					'key'               => 'field_cta_background_image',
					'label'             => 'Background Image',
					'name'              => 'background_image',
					'type'              => 'image',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_cta_background_type',
								'operator' => '==',
								'value'    => 'image',
							],
						],
					],
				],
				[
					'key'               => 'field_cta_gradient_start',
					'label'             => 'Gradient Start Color',
					'name'              => 'gradient_start',
					'type'              => 'color_picker',
					'default_value'     => '#F9C9B4',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_cta_background_type',
								'operator' => '==',
								'value'    => 'gradient',
							],
						],
					],
				],
				[
					'key'               => 'field_cta_gradient_end',
					'label'             => 'Gradient End Color',
					'name'              => 'gradient_end',
					'type'              => 'color_picker',
					'default_value'     => '#FDD7D4',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_cta_background_type',
								'operator' => '==',
								'value'    => 'gradient',
							],
						],
					],
				],
				[
					'key'               => 'field_cta_rotation_deg',
					'label'             => 'Gradient Angle (degrees)',
					'name'              => 'rotation_deg',
					'type'              => 'number',
					'default_value'     => 127,
					'min'               => 0,
					'max'               => 360,
					'conditional_logic' => [
						[
							[
								'field'    => 'field_cta_background_type',
								'operator' => '==',
								'value'    => 'gradient',
							],
						],
					],
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/cta',
					],
				],
			],
		] );
	}
}
