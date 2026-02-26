<?php
/**
 * Free Resources Block
 *
 * Migrated from: /custom-blocks/free-resources/free-resources.php
 * Location:      /inc/blocks/blocks/class-ofp-block-free-resources.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
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
}