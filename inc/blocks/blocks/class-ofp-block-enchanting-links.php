<?php
/**
 * Enchanting Links Block
 *
 * Migrated from: /custom-blocks/enchanting-links/enchanting-links.php
 * Location:      /inc/blocks/blocks/class-ofp-block-enchanting-links.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Enchanting_Links extends OFP_Block_Base {

    protected string $name        = 'enchanting-links';
    protected string $title       = 'Enchanting Links';
    protected string $description = 'Block to show a Enchanting Links.';
    protected string $icon        = 'heart';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}