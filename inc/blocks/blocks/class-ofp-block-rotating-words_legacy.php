<?php
/**
 * Rotating Words Block
 *
 * Migrated from: /custom-blocks/rotating-words/rotating-words.php
 * Location:      /inc/blocks/blocks/class-ofp-block-rotating-words.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Rotating_Words extends OFP_Block_Base {

    protected string $name        = 'rotating-words';
    protected string $title       = 'Rotating Words';
    protected string $description = 'Block to show a Rotating Words.';
    protected string $icon        = 'heart';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}