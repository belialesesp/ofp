<?php
/**
 * Extra Benefits Block
 *
 * Migrated from: /custom-blocks/extra-benefits/extra-benefits.php
 * Location:      /inc/blocks/blocks/class-ofp-block-extra-benefits.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Extra_Benefits extends OFP_Block_Base {

    protected string $name        = 'extra-benefits';
    protected string $title       = 'Extra Benefits';
    protected string $description = 'Block to show a Extra Benefits.';
    protected string $icon        = 'editor-kitchensink';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}