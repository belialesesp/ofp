<?php
/**
 * My Favorite Cards Block
 *
 * Migrated from: /custom-blocks/favorite-cards/favorite-cards.php
 * Location:      /inc/blocks/blocks/class-ofp-block-favorite-cards.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Favorite_Cards extends OFP_Block_Base {

    protected string $name        = 'favorite-cards';
    protected string $title       = 'Favorite Cards';
    protected string $description = 'Block to show a Favorite Cards.';
    protected string $icon        = 'awards';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}