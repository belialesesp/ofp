<?php
/**
 * Guides Block
 *
 * Migrated from: /custom-blocks/guides/guides.php
 * Location:      /inc/blocks/blocks/class-ofp-block-guides.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Guides extends OFP_Block_Base {

    protected string $name        = 'guides';
    protected string $title       = 'Guides';
    protected string $description = 'Guides section.';
    protected string $icon        = 'format-image';
    protected array  $keywords    = [ 'guides', 'cards', 'links' ];
    protected array  $supports    = [ 'align' => false, 'jsx' => true ];
    protected string $css_file    = '/custom-blocks/guides/guides.css';
}