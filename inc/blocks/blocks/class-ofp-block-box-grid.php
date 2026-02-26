<?php
/**
 * Box Grid Block
 *
 * Migrated from: /custom-blocks/box-grid/box-grid.php
 * Location:      /inc/blocks/blocks/class-ofp-block-box-grid.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Box_Grid extends OFP_Block_Base {

    protected string $name        = 'box-grid';
    protected string $title       = 'Box Grid';
    protected string $description = 'Block to show a Box Grid.';
    protected string $icon        = 'editor-kitchensink';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}