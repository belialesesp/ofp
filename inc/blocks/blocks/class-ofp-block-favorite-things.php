<?php
/**
 * Favorite Things Block
 *
 * Migrated from: /custom-blocks/favorite-things/favorite-things.php
 * Location:      /inc/blocks/blocks/class-ofp-block-favorite-things.php
 *
 * Note: ACF fields are managed via the ACF UI, not registered locally.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Favorite_Things extends OFP_Block_Base {

    protected string $name        = 'favorite-things';
    protected string $title       = 'Favorite Things';
    protected string $description = 'Block to show a Favorite Things.';
    protected string $icon        = 'heart';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}