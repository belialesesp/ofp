<?php
/**
 * Destinations Map Block
 *
 * Migrated from: /custom-blocks/destinations-map/destinations-map.php
 * Location:      /inc/blocks/blocks/class-ofp-block-destinations-map.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Destinations_Map extends OFP_Block_Base {

    protected string $name        = 'destinations-map';
    protected string $title       = 'Destinations Map';
    protected string $description = 'Block to show Destinations Map.';
    protected string $icon        = 'admin-site';
    protected array  $keywords    = [ 'destinations', 'destination', 'map' ];
    protected string $js_file     = '/custom-blocks/destinations-map/destinations-map.js';
}