<?php
/**
 * About Kam widget Block
 *
 * Migrated from: /custom-blocks/about-kam-widget/about-kam-widget.php
 * Location:      /inc/blocks/blocks/class-ofp-block-about-kam-widget.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_About_Kam_Widget extends OFP_Block_Base {

    protected string $name        = 'about-kam-widget';
    protected string $title       = 'About Kam widget';
    protected string $description = 'Block to show a About Kam widget.';
    protected string $icon        = 'format-image';
    protected array  $keywords    = [ 'hero', 'image', 'banner' ];
}