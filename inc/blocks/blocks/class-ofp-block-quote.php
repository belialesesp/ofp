<?php
/**
 * Quote / Testimonial Block
 *
 * Styled pull quote or testimonial with author name, role, and optional photo.
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Quote extends OFP_Block_Base {

	protected string $name        = 'quote';
	protected string $title       = 'Quote / Testimonial';
	protected string $description = 'Styled pull quote or testimonial with optional author photo.';
	protected string $icon        = 'format-quote';
	protected array  $keywords    = [ 'quote', 'testimonial', 'pullquote', 'review' ];

	public function register(): void {
		parent::register();
		$this->register_fields();
	}

	protected function register_fields(): void {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group( [
			'key'    => 'group_quote',
			'title'  => 'Quote / Testimonial',
			'fields' => [
				[
					'key'   => 'field_quote_text',
					'label' => 'Quote',
					'name'  => 'quote_text',
					'type'  => 'textarea',
					'rows'  => 4,
				],
				[
					'key'   => 'field_quote_author',
					'label' => 'Author Name',
					'name'  => 'author_name',
					'type'  => 'text',
				],
				[
					'key'   => 'field_quote_role',
					'label' => 'Author Role / Context',
					'name'  => 'author_role',
					'type'  => 'text',
					'instructions' => 'e.g. "Travel blogger" or "OFP community member"',
				],
				[
					'key'           => 'field_quote_photo',
					'label'         => 'Author Photo',
					'name'          => 'author_photo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'thumbnail',
				],
				[
					'key'           => 'field_quote_style',
					'label'         => 'Style',
					'name'          => 'style',
					'type'          => 'select',
					'choices'       => [
						'pullquote'    => 'Pull Quote (large, centered)',
						'testimonial'  => 'Testimonial (card with author)',
					],
					'default_value' => 'testimonial',
					'allow_null'    => 0,
				],
				[
					'key'           => 'field_quote_color',
					'label'         => 'Accent Color',
					'name'          => 'accent_color',
					'type'          => 'color_picker',
					'default_value' => '#67B1BB',
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/quote',
					],
				],
			],
		] );
	}
}
