<?php
/**
 * About Kam Block
 *
 * Migrated from: /custom-blocks/about-kam/about-kam.php
 * Location:      /inc/blocks/blocks/class-ofp-block-about-kam.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_About_Kam extends OFP_Block_Base {

    protected string $name        = 'about-kam';
    protected string $title       = 'About Kam';
    protected string $description = 'Block to show a About Kam.';
    protected string $icon        = 'smiley';
    protected array  $keywords    = [ 'social', 'about', 'links' ];
}