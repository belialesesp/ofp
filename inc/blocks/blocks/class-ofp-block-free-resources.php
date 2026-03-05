<?php
/**
 * Free Resources Block
 *
 * Location: /inc/blocks/blocks/class-ofp-block-free-resources.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Resources extends OFP_Block_Base {

    protected string $name        = 'free-resources';
    protected string $title       = 'Free Resources';
    protected string $description = 'Block to show Free Resources.';
    protected string $icon        = 'welcome-learn-more';
    protected array  $keywords    = [ 'resources', 'free', 'banner' ];

    public function init(): void {
        parent::init();
        add_action( 'acf/include_fields', [ $this, 'register_fields' ] );
    }

    public function register_fields(): void {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key'   => 'group_66da8c7345342',
            'title' => 'Free Resources',
            'fields' => array(

                // Title (always visible)
                array(
                    'key'           => 'field_frb_block_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'instructions'  => 'Section title',
                    'default_value' => 'FREE RESOURCES',
                ),

                // Widget Mode toggle (always visible)
                array(
                    'key'           => 'field_frb_is_widget',
                    'label'         => 'Widget Mode',
                    'name'          => 'is_widget',
                    'type'          => 'true_false',
                    'instructions'  => 'Use settings from Theme Options > Free Resources',
                    'ui'            => 1,
                    'ui_on_text'    => 'Widget',
                    'ui_off_text'   => 'Block',
                    'default_value' => 1,
                ),

                // Widget Mode Message
                array(
                    'key'       => 'field_frb_widget_message',
                    'label'     => 'Widget Settings Active',
                    'name'      => '',
                    'type'      => 'message',
                    'message'   => 'This block is using global settings from <strong>Theme Options > Free Resources</strong>.<br>Switch to Block mode to set unique content for this block.',
                    'new_lines' => 'wpautop',
                    'esc_html'  => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '==',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                // Accordion (only in Block mode)
                array(
                    'key'          => 'field_frb_accordion',
                    'label'        => 'Free Resources',
                    'name'         => '',
                    'type'         => 'accordion',
                    'open'         => 0,
                    'multi_expand' => 0,
                    'endpoint'     => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),



                array(
                    'key'          => 'field_frb_description',
                    'label'        => 'Description',
                    'name'         => 'description',
                    'type'         => 'wysiwyg',
                    'tabs'         => 'all',
                    'toolbar'      => 'full',
                    'media_upload' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'            => 'field_frb_title_color',
                    'label'          => 'Title Color',
                    'name'           => 'title_color',
                    'type'           => 'color_picker',
                    'enable_opacity' => false,
                    'return_format'  => 'string',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'            => 'field_frb_description_color',
                    'label'          => 'Description Color',
                    'name'           => 'description_color',
                    'type'           => 'color_picker',
                    'enable_opacity' => false,
                    'return_format'  => 'string',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_frb_images_position',
                    'label'         => 'Images Position',
                    'name'          => 'images_position',
                    'type'          => 'select',
                    'choices'       => array(
                        'alternating' => 'Alternating',
                        'left'        => 'Left',
                        'right'       => 'Right',
                    ),
                    'default_value' => 'alternating',
                    'allow_null'    => 0,
                    'multiple'      => 0,
                    'ui'            => 0,
                    'return_format' => 'value',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_frb_space_between_resources',
                    'label'         => 'Space Between Resources [px]',
                    'name'          => 'space_between_resources',
                    'type'          => 'number',
                    'default_value' => 0,
                    'min'           => 0,
                    'step'          => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'          => 'field_frb_resources',
                    'label'        => 'Resources',
                    'name'         => 'resources',
                    'type'         => 'repeater',
                    'layout'       => 'block',
                    'min'          => 0,
                    'max'          => 0,
                    'button_label' => 'Add Resource',
                    'sub_fields'   => array(

                        array(
                            'key'           => 'field_frb_resource_image',
                            'label'         => 'Image',
                            'name'          => 'image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'medium',
                            'library'       => 'all',
                        ),

                        array(
                            'key'   => 'field_frb_resource_title',
                            'label' => 'Title',
                            'name'  => 'title',
                            'type'  => 'text',
                        ),

                        array(
                            'key'          => 'field_frb_resource_description',
                            'label'        => 'Description',
                            'name'         => 'description',
                            'type'         => 'wysiwyg',
                            'tabs'         => 'all',
                            'toolbar'      => 'full',
                            'media_upload' => 1,
                        ),

                        array(
                            'key'           => 'field_frb_resource_badge_image',
                            'label'         => 'Badge Image',
                            'name'          => 'badge_image',
                            'type'          => 'image',
                            'return_format' => 'array',
                            'preview_size'  => 'thumbnail',
                            'library'       => 'all',
                        ),

                        array(
                            'key'   => 'field_frb_resource_badge_label',
                            'label' => 'Badge Label',
                            'name'  => 'badge_label',
                            'type'  => 'text',
                        ),

                        array(
                            'key'   => 'field_frb_resource_cta_label',
                            'label' => 'CTA Label',
                            'name'  => 'cta_label',
                            'type'  => 'text',
                        ),

                        array(
                            'key'  => 'field_frb_resource_cta_url',
                            'label'=> 'CTA Url',
                            'name' => 'cta_url',
                            'type' => 'url',
                        ),

                        array(
                            'key'            => 'field_frb_resource_cta_color',
                            'label'          => 'CTA Color',
                            'name'           => 'cta_color',
                            'type'           => 'color_picker',
                            'enable_opacity' => false,
                            'return_format'  => 'string',
                        ),

                    ),
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                // Accordion endpoint
                array(
                    'key'      => 'field_frb_accordion_end',
                    'label'    => 'Free Resources End',
                    'name'     => '',
                    'type'     => 'accordion',
                    'endpoint' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_frb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

            ),
            'location' => array(
                array(
                    array(
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => 'acf/free-resources',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'left',
            'instruction_placement' => 'field',
            'active'                => true,
            'show_in_rest'          => 0,
        ) );
    }
}