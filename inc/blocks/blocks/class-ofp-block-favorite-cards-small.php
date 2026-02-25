<?php
/**
 * Favorite Cards Small Block
 *
 * Migrated from: /custom-blocks/favorite-cards-small/favorite-cards-small.php
 * Location:      /inc/blocks/blocks/class-ofp-block-favorite-cards-small.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Favorite_Cards_Small extends OFP_Block_Base {

    protected string $name        = 'favorite-cards-small';
    protected string $title       = 'Favorite Cards Small';
    protected string $description = 'Section to display favorite cards.';
    protected string $icon        = 'star-filled';
    protected array  $keywords    = [ 'favorite', 'cards', 'small', 'favorites', 'list' ];
    protected array  $supports    = [ 'align' => false, 'jsx' => true ];
    protected string $css_file    = '/custom-blocks/favorite-cards-small/favorite-cards-small.css';
}