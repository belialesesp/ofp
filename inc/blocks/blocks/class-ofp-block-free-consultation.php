<?php
/**
 * Free Consultation Block
 *
 * Migrated from: /custom-blocks/free-consultation/free-consultation.php
 * Location:      /inc/blocks/blocks/class-ofp-block-free-consultation.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
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
}