<?php
/**
 * Credit Cards Block
 *
 * Migrated from: /custom-blocks/credit-cards/credit-cards.php
 * Location:      /inc/blocks/blocks/class-ofp-block-credit-cards.php
 *
 * @todo Review: block had inline ACF fields.
 *       Move acf_add_local_field_group() into register_fields()
 *       and override init() to call parent::init() + $this->register_fields().
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Credit_Cards extends OFP_Block_Base {

    protected string $name        = 'credit-cards';
    protected string $title       = 'Credit Cards';
    protected string $description = 'Block to show credit cards referals.';
    protected string $icon        = 'money-alt';
    protected array  $keywords    = [ 'credit', 'cards', 'quote' ];
}