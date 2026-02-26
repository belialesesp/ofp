<?php
/**
 * Free Consultation Block
 * Location: /inc/blocks/blocks/class-ofp-block-free-consultation.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Consultation extends OFP_Block_Base {

    protected string $name        = 'free-consultation';
    protected string $title       = 'Free Consultation';
    protected string $description = 'Block to show a Free Consultation.';
    protected string $icon        = 'welcome-learn-more';
    protected array  $keywords    = [ 'consultation', 'free', 'banner' ];

    public function init(): void {
        parent::init();
        add_action( 'acf/include_fields', [ $this, 'register_fields' ] );
    }

    public function register_fields(): void {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group( array(
            'key'   => 'group_free_consultation_block',
            'title' => 'Free Consultation Block',
            'fields' => array(

                // Title field (always visible)
                array(
                    'key'           => 'field_ssb_title',
                    'label'         => 'Title',
                    'name'          => 'title',
                    'type'          => 'text',
                    'instructions'  => 'Section title',
                    'default_value' => 'Free Consultation',
                ),

                // Widget Mode toggle
                array(
                    'key'           => 'field_fcb_is_widget',
                    'label'         => 'Widget Mode',
                    'name'          => 'is_widget',
                    'type'          => 'true_false',
                    'instructions'  => 'Use default settings from Theme Options > Free Consultation',
                    'ui'            => 1,
                    'ui_on_text'    => 'Widget',
                    'ui_off_text'   => 'Block',
                    'default_value' => 1,
                ),

                // Widget Mode Message
                array(
                    'key'       => 'field_fcb_widget_message',
                    'label'     => 'Widget Settings Active',
                    'name'      => '',
                    'type'      => 'message',
                    'message'   => 'This block is using global settings from <strong>Theme Options > Free Consultation</strong>.<br>Switch to Block mode to set unique content for this block.',
                    'new_lines' => 'wpautop',
                    'esc_html'  => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '==',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                // Tab: Content
                array(
                    'key'       => 'field_fcb_content_tab',
                    'label'     => 'Content',
                    'name'      => '',
                    'type'      => 'tab',
                    'placement' => 'top',
                    'endpoint'  => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_sub_title_left',
                    'label'         => 'Sub Title [Left]',
                    'name'          => 'sub_title_left',
                    'type'          => 'text',
                    'default_value' => 'NEED HELP?',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_title_left',
                    'label'         => 'Title [Left]',
                    'name'          => 'title_left',
                    'type'          => 'text',
                    'default_value' => 'Get Expert Financial Guidance Today',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_title_right',
                    'label'         => 'Title [Right]',
                    'name'          => 'title_right',
                    'type'          => 'text',
                    'default_value' => 'Free Consultation',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_description_right',
                    'label'         => 'Description [Right]',
                    'name'          => 'description_right',
                    'type'          => 'wysiwyg',
                    'default_value' => 'Take the first step towards financial freedom.',
                    'tabs'          => 'all',
                    'toolbar'       => 'full',
                    'media_upload'  => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_cta_label_right',
                    'label'         => 'CTA Label [Right]',
                    'name'          => 'cta_label_right',
                    'type'          => 'text',
                    'default_value' => 'SCHEDULE NOW',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_cta_url_right',
                    'label'         => 'CTA URL [Right]',
                    'name'          => 'cta_url_right',
                    'type'          => 'url',
                    'default_value' => '/contact',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                // Tab: Setting
                array(
                    'key'       => 'field_fcb_setting_tab',
                    'label'     => 'Setting',
                    'name'      => '',
                    'type'      => 'tab',
                    'placement' => 'top',
                    'endpoint'  => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_background_color',
                    'label'         => 'Background Color',
                    'name'          => 'background_color',
                    'type'          => 'color_picker',
                    'default_value' => '#f7f7f7',
                    'enable_opacity'=> true,
                    'return_format' => 'string',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_box_background_color',
                    'label'         => 'Box Background Color',
                    'name'          => 'box_background_color',
                    'type'          => 'color_picker',
                    'default_value' => '#ffffff',
                    'enable_opacity'=> true,
                    'return_format' => 'string',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
                                'operator' => '!=',
                                'value'    => '1',
                            ),
                        ),
                    ),
                ),

                array(
                    'key'           => 'field_fcb_text_color',
                    'label'         => 'Text Color',
                    'name'          => 'text_color',
                    'type'          => 'color_picker',
                    'default_value' => '#222222',
                    'enable_opacity'=> false,
                    'return_format' => 'string',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field'    => 'field_fcb_is_widget',
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
                        'value'    => 'acf/free-consultation',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'left',
            'instruction_placement' => 'field',
            'hide_on_screen'        => '',
            'active'                => true,
            'description'           => '',
            'show_in_rest'          => 0,
        ) );
    }
}