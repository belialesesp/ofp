<?php
/**
 * Unique Card Block
 *
 * Migrated from: /custom-blocks/unique-card/unique-card.php
 * Location:      /inc/blocks/blocks/class-ofp-block-unique-card.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Unique_Card extends OFP_Block_Base {

    protected string $name        = 'unique-card';
    protected string $title       = 'Unique Card';
    protected string $description = 'Block to show a Unique Card.';
    protected string $icon        = 'money-alt';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
    protected string $css_file    = '/custom-blocks/unique-card/unique-card.css';
}