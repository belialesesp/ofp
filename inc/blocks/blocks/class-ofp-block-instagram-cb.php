<?php
/**
 * Instagram Block
 *
 * Migrated from: /custom-blocks/instagram-cb/instagram-cb.php
 * Location:      /inc/blocks/blocks/class-ofp-block-instagram-cb.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Instagram_Cb extends OFP_Block_Base {

    protected string $name        = 'instagram-cb';
    protected string $title       = 'Instagram';
    protected string $description = 'Block to show a Instagram.';
    protected string $icon        = 'instagram';
    protected array  $keywords    = [ 'cards', 'favorite', 'banner' ];
}