<?php
/**
 * Heading Block
 *
 * A heading with OFP typography presets — font family, size token, and color.
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Heading extends OFP_Block_Base {

	protected string $name        = 'heading';
	protected string $title       = 'OFP Heading';
	protected string $description = 'Heading with OFP typography presets (font, size, color, alignment).';
	protected string $icon        = 'heading';
	protected array  $keywords    = [ 'heading', 'title', 'typography', 'h1', 'h2', 'h3' ];

	public function register(): void {
		parent::register();
		$this->register_fields();
	}

	protected function register_fields(): void {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( [
			'key'    => 'group_heading',
			'title'  => 'OFP Heading',
			'fields' => [
				[
					'key'   => 'field_heading_text',
					'label' => 'Text',
					'name'  => 'text',
					'type'  => 'text',
				],
				[
					'key'           => 'field_heading_level',
					'label'         => 'HTML Tag',
					'name'          => 'level',
					'type'          => 'select',
					'choices'       => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
					],
					'default_value' => 'h2',
					'allow_null'    => 0,
				],
				[
					'key'           => 'field_heading_font',
					'label'         => 'Font Family',
					'name'          => 'font_family',
					'type'          => 'select',
					'choices'       => [
						'versailles' => 'Versailles (headings)',
						'gothic'     => 'League Gothic (display)',
						'glacial'    => 'Glacial Indifference (body)',
						'moontime'   => 'Net MoonTime (decorative)',
					],
					'default_value' => 'versailles',
					'allow_null'    => 0,
				],
				[
					'key'           => 'field_heading_size',
					'label'         => 'Size',
					'name'          => 'size',
					'type'          => 'select',
					'choices'       => [
						'display' => 'Display (5rem)',
						'h1'      => 'H1 (4rem)',
						'h2'      => 'H2 (3rem)',
						'h3'      => 'H3 (2rem)',
						'h4'      => 'H4 (1.5rem)',
						'h5'      => 'H5 (1.25rem)',
						'h6'      => 'H6 (1rem)',
					],
					'default_value' => 'h2',
					'allow_null'    => 0,
				],
				[
					'key'           => 'field_heading_align',
					'label'         => 'Alignment',
					'name'          => 'alignment',
					'type'          => 'select',
					'choices'       => [
						'left'   => 'Left',
						'center' => 'Center',
						'right'  => 'Right',
					],
					'default_value' => 'left',
					'allow_null'    => 0,
				],
				[
					'key'           => 'field_heading_color',
					'label'         => 'Color',
					'name'          => 'color',
					'type'          => 'color_picker',
					'default_value' => '#222222',
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/heading',
					],
				],
			],
		] );
	}
}
