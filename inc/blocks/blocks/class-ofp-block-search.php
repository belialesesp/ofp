<?php
/**
 * Search Block
 *
 * Location: /inc/blocks/blocks/class-ofp-block-search.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Search extends OFP_Block_Base {

    protected string $name        = 'search';
    protected string $title       = 'Search';
    protected string $description = 'Hero search block with trending searches.';
    protected string $icon        = 'search';
    protected array  $keywords    = [ 'search', 'hero', 'trending' ];
}