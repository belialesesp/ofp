<?php
/**
 * Related Posts Block
 *
 * Migrated from: /custom-blocks/related-posts/related-posts.php
 * Location:      /inc/blocks/blocks/class-ofp-block-related-posts.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Related_Posts extends OFP_Block_Base {

    protected string $name        = 'related-posts';
    protected string $title       = 'Related Posts';
    protected string $description = 'Block to show Related Posts.';
    protected string $icon        = 'layout';
    protected array  $keywords    = [];
}