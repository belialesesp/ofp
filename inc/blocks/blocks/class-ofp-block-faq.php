<?php
/**
 * FAQ / Accordion Block
 *
 * Renders a list of question/answer items with smooth expand/collapse.
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Faq extends OFP_Block_Base {

	protected string $name        = 'faq';
	protected string $title       = 'FAQ / Accordion';
	protected string $description = 'Expandable question and answer items.';
	protected string $icon        = 'editor-ul';
	protected array  $keywords    = [ 'faq', 'accordion', 'question', 'answer', 'collapse' ];

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
			'key'    => 'group_faq',
			'title'  => 'FAQ / Accordion',
			'fields' => [
				[
					'key'   => 'field_faq_section_title',
					'label' => 'Section Title',
					'name'  => 'section_title',
					'type'  => 'text',
					'instructions' => 'Optional heading displayed above the accordion items.',
				],
				[
					'key'        => 'field_faq_items',
					'label'      => 'Items',
					'name'       => 'items',
					'type'       => 'repeater',
					'min'        => 1,
					'layout'     => 'block',
					'button_label' => 'Add Item',
					'sub_fields' => [
						[
							'key'   => 'field_faq_question',
							'label' => 'Question',
							'name'  => 'question',
							'type'  => 'text',
						],
						[
							'key'          => 'field_faq_answer',
							'label'        => 'Answer',
							'name'         => 'answer',
							'type'         => 'wysiwyg',
							'toolbar'      => 'basic',
							'media_upload' => 0,
						],
					],
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/faq',
					],
				],
			],
		] );
	}
}
