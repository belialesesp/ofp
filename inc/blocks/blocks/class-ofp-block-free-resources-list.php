<?php
/**
 * Free Resources List Block
 *
 * Migrated from: /custom-blocks/free-resources-list/free-resources-list.php
 * Location:      /inc/blocks/blocks/class-ofp-block-free-resources-list.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class OFP_Block_Free_Resources_List extends OFP_Block_Base {

    protected string $name        = 'free-resources-list';
    protected string $title       = 'Free Resources List';
    protected string $description = 'Block to show a Free Resources List.';
    protected string $icon        = 'welcome-learn-more';
    protected array  $keywords    = [ 'resources', 'free', 'banner' ];
}