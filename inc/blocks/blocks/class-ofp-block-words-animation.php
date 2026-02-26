<?php
/**
 * Words Animation Block
 *
 * Migrated from: /custom-blocks/words-animation/words-animation.php
 * Location:      /inc/blocks/blocks/class-ofp-block-words-animation.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Words_Animation extends OFP_Block_Base {

    protected string $name        = 'words-animation';
    protected string $title       = 'Words Animation';
    protected string $description = 'Words Animation section.';
    protected string $icon        = 'move';
    protected array  $keywords    = [ 'words-animation', 'animation', 'text', 'scroll' ];
    protected array  $supports    = [ 'align' => false, 'jsx' => true ];
    protected string $css_file    = '/custom-blocks/words-animation/words-animation.css';
}