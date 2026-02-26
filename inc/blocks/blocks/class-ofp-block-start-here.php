<?php
/**
 * Start Here Block
 *
 * Migrated from: /custom-blocks/start-here/start-here.php
 * Location:      /inc/blocks/blocks/class-ofp-block-start-here.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Start_Here extends OFP_Block_Base {

    protected string $name        = 'start-here';
    protected string $title       = 'Start Here';
    protected string $description = 'Block to show a Start Here.';
    protected string $icon        = 'editor-spellcheck';
    protected array  $keywords    = [ 'start', 'here', 'content' ];
}