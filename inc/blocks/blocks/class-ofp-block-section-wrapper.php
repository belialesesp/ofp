<?php
/**
 * Section Wrapper Block
 *
 * A generic container block with configurable background options (color, image,
 * gradient). Inner blocks are placed inside via the Gutenberg InnerBlocks API.
 *
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Section_Wrapper extends OFP_Block_Base {

	protected string $name        = 'section-wrapper';
	protected string $title       = 'Section Wrapper';
	protected string $description = 'A section container with configurable background (color, image, or gradient).';
	protected string $icon        = 'layout';
	protected array  $keywords    = [ 'section', 'wrapper', 'container', 'background', 'layout' ];

	/**
	 * Override render to capture $content (rendered inner blocks).
	 *
	 * @param array  $block   ACF block data.
	 * @param string $content Rendered inner blocks HTML.
	 */
	public function render( array $block, string $content = '' ): void {
		$template = get_theme_file_path( "/custom-blocks/{$this->name}/{$this->name}-template.php" );

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Register block after registering fields.
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
			'key'    => 'group_section_wrapper',
			'title'  => 'Section Wrapper',
			'fields' => [
				[
					'key'           => 'field_sw_background_type',
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
					'key'               => 'field_sw_background_color',
					'label'             => 'Background Color',
					'name'              => 'background_color',
					'type'              => 'color_picker',
					'default_value'     => '#ffffff',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_sw_background_type',
								'operator' => '==',
								'value'    => 'color',
							],
						],
					],
				],
				[
					'key'               => 'field_sw_background_image',
					'label'             => 'Background Image',
					'name'              => 'background_image',
					'type'              => 'image',
					'return_format'     => 'array',
					'preview_size'      => 'medium',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_sw_background_type',
								'operator' => '==',
								'value'    => 'image',
							],
						],
					],
				],
				[
					'key'               => 'field_sw_gradient_start',
					'label'             => 'Gradient Start Color',
					'name'              => 'gradient_start',
					'type'              => 'color_picker',
					'default_value'     => '#ffffff',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_sw_background_type',
								'operator' => '==',
								'value'    => 'gradient',
							],
						],
					],
				],
				[
					'key'               => 'field_sw_gradient_end',
					'label'             => 'Gradient End Color',
					'name'              => 'gradient_end',
					'type'              => 'color_picker',
					'default_value'     => '#ffffff',
					'conditional_logic' => [
						[
							[
								'field'    => 'field_sw_background_type',
								'operator' => '==',
								'value'    => 'gradient',
							],
						],
					],
				],
				[
					'key'               => 'field_sw_rotation_deg',
					'label'             => 'Gradient Angle (degrees)',
					'name'              => 'rotation_deg',
					'type'              => 'number',
					'default_value'     => 135,
					'min'               => 0,
					'max'               => 360,
					'conditional_logic' => [
						[
							[
								'field'    => 'field_sw_background_type',
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
						'value'    => 'acf/section-wrapper',
					],
				],
			],
		] );
	}
}
