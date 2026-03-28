<?php
/**
 * Tabs Block
 *
 * Renders a tabbed interface where each tab has a label and wysiwyg content.
 * Fields are registered programmatically via register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class OFP_Block_Tabs extends OFP_Block_Base {

	protected string $name        = 'tabs';
	protected string $title       = 'Tabs';
	protected string $description = 'Tabbed content panels with a clickable tab navigation.';
	protected string $icon        = 'table-col-before';
	protected array  $keywords    = [ 'tabs', 'tabbed', 'panels', 'content' ];

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
			'key'    => 'group_tabs',
			'title'  => 'Tabs',
			'fields' => [
				[
					'key'          => 'field_tabs_items',
					'label'        => 'Tabs',
					'name'         => 'items',
					'type'         => 'repeater',
					'min'          => 2,
					'layout'       => 'block',
					'button_label' => 'Add Tab',
					'sub_fields'   => [
						[
							'key'   => 'field_tabs_label',
							'label' => 'Tab Label',
							'name'  => 'tab_label',
							'type'  => 'text',
						],
						[
							'key'          => 'field_tabs_content',
							'label'        => 'Content',
							'name'         => 'tab_content',
							'type'         => 'wysiwyg',
							'toolbar'      => 'full',
							'media_upload' => 1,
						],
					],
				],
			],
			'location' => [
				[
					[
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/tabs',
					],
				],
			],
		] );
	}
}
