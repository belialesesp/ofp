<?php
/**
 * Must Read Block
 *
 * Migrated from: /custom-blocks/must-read/must-read.php
 * Location:      /inc/blocks/blocks/class-ofp-block-must-read.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Must_Read extends OFP_Block_Base {

    protected string $name        = 'must-read';
    protected string $title       = 'Must Read';
    protected string $description = 'Block to show a Must Read.';
    protected string $icon        = 'admin-post';
    protected array  $keywords    = [ 'must', 'read', 'blog' ];
}