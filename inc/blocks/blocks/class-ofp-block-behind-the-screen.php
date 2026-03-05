<?php
/**
 * Behind The Screen Block
 *
 * Migrated from: /custom-blocks/behind-the-screen/behind-the-screen.php
 * Location:      /inc/blocks/blocks/class-ofp-block-behind-the-screen.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Behind_The_Screen extends OFP_Block_Base {

    protected string $name        = 'behind-the-screen';
    protected string $title       = 'Behind The Screen';
    protected string $description = 'Block to show a Behind The Screen.';
    protected string $icon        = 'heart';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}