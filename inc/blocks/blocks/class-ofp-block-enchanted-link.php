<?php
/**
 * Enchanted Link Block
 *
 * Migrated from: /custom-blocks/enchanted-link/enchanted-link.php
 * Location:      /inc/blocks/blocks/class-ofp-block-enchanted-link.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Enchanted_Link extends OFP_Block_Base {

    protected string $name        = 'enchanted-link';
    protected string $title       = 'Enchanted Link';
    protected string $description = 'Enchanted Link section.';
    protected string $icon        = 'move';
    protected array  $keywords    = [ 'enchanted-link', 'animation', 'text', 'scroll' ];
    protected array  $supports    = [ 'align' => false, 'jsx' => true ];
    protected string $css_file    = '/custom-blocks/enchanted-link/enchanted-link.css';
}