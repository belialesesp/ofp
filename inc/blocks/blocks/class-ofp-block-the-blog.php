<?php
/**
 * The Blog Block
 *
 * Migrated from: /custom-blocks/the-blog/the-blog.php
 * Location:      /inc/blocks/blocks/class-ofp-block-the-blog.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_The_Blog extends OFP_Block_Base {

    protected string $name        = 'the-blog';
    protected string $title       = 'The Blog';
    protected string $description = 'Block to show a The Blog.';
    protected string $icon        = 'format-quote';
    protected array  $keywords    = [ 'blog', 'post', 'destinations' ];
}