<?php
/**
 * Hero Image Block
 *
 * Migrated from: /custom-blocks/hero-image/hero-image.php
 * Location:      /inc/blocks/blocks/class-ofp-block-hero-image.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Hero_Image extends OFP_Block_Base {

    protected string $name        = 'hero-image';
    protected string $title       = 'Hero Image';
    protected string $description = 'Block to show a hero image.';
    protected string $icon        = 'format-image';
    protected array  $keywords    = [ 'hero', 'image', 'banner' ];
}