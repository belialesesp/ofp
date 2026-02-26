<?php
/**
 * Hero Content Block
 *
 * Migrated from: /custom-blocks/hero-content/hero-content.php
 * Location:      /inc/blocks/blocks/class-ofp-block-hero-content.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Hero_Content extends OFP_Block_Base {

    protected string $name        = 'hero-content';
    protected string $title       = 'Hero Content';
    protected string $description = 'Block to show a Hero Content.';
    protected string $icon        = 'schedule';
    protected array  $keywords    = [ 'hero', 'image', 'banner' ];
}