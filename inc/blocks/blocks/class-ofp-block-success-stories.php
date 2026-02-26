<?php
/**
 * Success Stories Block
 *
 * Migrated from: /custom-blocks/success-stories/success-stories.php
 * Location:      /inc/blocks/blocks/class-ofp-block-success-stories.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Success_Stories extends OFP_Block_Base {

    protected string $name        = 'success-stories';
    protected string $title       = 'Success Stories';
    protected string $description = 'Block to show a Success Stories.';
    protected string $icon        = 'format-quote';
    protected array  $keywords    = [ 'success', 'stories', 'testimonials' ];
}